<?php
/**
 * File containing the switchadmindesign/switch module view.
 *
 * Handles session-based switching of the admin design between admin3 (default)
 * and admin_classic. Sets a session variable that the kernel override reads on
 * each request to modify AdditionalSiteDesignList accordingly.
 *
 * @copyright Copyright (C) 1999 - 2026 se7enx.com. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2.0
 * @version 0.1.0
 * @package sevenx_themes_admin_classic
 */

$Module = $Params['Module'];

$http  = eZHTTPTool::instance();
$ini   = eZINI::instance();

$fallbackRedirectURI = '/';

/**
 * Converts user-provided redirect targets to local-safe URIs.
 *
 * redirectTo() forbids absolute URLs on unknown hosts. In proxied/multi-host
 * setups the posted RedirectURI may occasionally contain an absolute URL with
 * a host not present in AllowedRedirectHosts, causing intermittent 403 errors.
 * We intentionally strip scheme/host and keep only path+query+fragment.
 *
 * @param string|null $uri
 * @param string $fallback
 * @return string
 */
function sevenxSwitchAdminDesignNormalizeRedirectURI( $uri, $fallback )
{
    if ( $uri === null )
    {
        return $fallback;
    }

    $uri = trim( $uri );
    if ( $uri === '' )
    {
        return $fallback;
    }

    // Strip control characters defensively.
    $uri = preg_replace( '/[\x00-\x1F\x7F]/', '', $uri );

    $parts = @parse_url( $uri );
    if ( $parts !== false && isset( $parts['host'] ) )
    {
        $path = isset( $parts['path'] ) ? $parts['path'] : '/';
        $query = isset( $parts['query'] ) ? '?' . $parts['query'] : '';
        $fragment = isset( $parts['fragment'] ) ? '#' . $parts['fragment'] : '';
        $uri = $path . $query . $fragment;
    }

    // Prevent protocol-relative redirects.
    if ( strpos( $uri, '//' ) === 0 )
    {
        $uri = ltrim( $uri, '/' );
    }

    // redirectTo() accepts relative module URIs; normalize to that form.
    $uri = ltrim( $uri, '/' );
    if ( $uri === '' )
    {
        return $fallback;
    }

    return $uri;
}

// Fetch the configured session variable name from extension settings
$sevenxINI = eZINI::instance( 'sevenxthemesadminclassic.ini' );
$sessionVarName = $sevenxINI->variable(
    'SevenXThemesAdminClassicSettings',
    'SwitchAdminDesignSessionVariableName'
);
$designListSessionVarName = 'SevenXThemesAdminClassicAdditionalSiteDesignList';

// Prefer direct POST values to avoid dependency on module post-action parsing
// inside toolbar contexts. Fall back to action parameters for compatibility.
$requestedDesign = null;
$userRedirectURI = null;

if ( $http->hasPostVariable( 'Design' ) )
{
    $requestedDesign = trim( $http->postVariable( 'Design' ) );
}
else if ( $Module->isCurrentAction( 'SwitchAdminDesign' )
          && $Module->hasActionParameter( 'SwitchAdminDesignSetDesign' ) )
{
    $requestedDesign = trim( $Module->actionParameter( 'SwitchAdminDesignSetDesign' ) );
}

if ( $http->hasPostVariable( 'RedirectURI' ) )
{
    $userRedirectURI = trim( $http->postVariable( 'RedirectURI' ) );
}
else if ( $Module->isCurrentAction( 'SwitchAdminDesign' )
          && $Module->hasActionParameter( 'SwitchAdminDesignRedirectURI' ) )
{
    $userRedirectURI = trim( $Module->actionParameter( 'SwitchAdminDesignRedirectURI' ) );
}

if ( $requestedDesign !== null )
{
    // Whitelist allowed design values for security
    $allowedDesigns = array( 'admin_classic', 'admin3' );

    if ( in_array( $requestedDesign, $allowedDesigns, true ) )
    {
        if ( $requestedDesign === 'admin_classic' )
        {
            $http->setSessionVariable( $sessionVarName, 'enabled' );
            $http->setSessionVariable(
                $designListSessionVarName,
                array( 'admin3', 'admin_classic', 'admin' )
            );
        }
        else
        {
            // Explicitly mark classic mode disabled and set admin3-only fallback order.
            $http->setSessionVariable( $sessionVarName, 'disabled' );
            $http->setSessionVariable(
                $designListSessionVarName,
                array( 'admin3', 'admin' )
            );
        }

        // Ensure template selection reflects the new design mode immediately.
        eZCache::clearByTag( 'template' );
        eZCache::clearByTag( 'template-block' );
    }

    if ( $userRedirectURI === null || trim( $userRedirectURI ) === '' )
    {
        if ( $http->hasSessionVariable( 'LastAccessesURI' ) )
        {
            $userRedirectURI = $http->sessionVariable( 'LastAccessesURI' );
        }
        else if ( isset( $_SERVER['HTTP_REFERER'] ) && trim( $_SERVER['HTTP_REFERER'] ) !== '' )
        {
            $userRedirectURI = $_SERVER['HTTP_REFERER'];
        }
    }

    $safeRedirectURI = sevenxSwitchAdminDesignNormalizeRedirectURI( $userRedirectURI, $fallbackRedirectURI );
    return $Module->redirectTo( $safeRedirectURI );
}

// No valid design action submitted; redirect back to where user came from.
$defaultRedirectURI = null;
if ( $http->hasSessionVariable( 'LastAccessesURI' ) )
{
    $defaultRedirectURI = $http->sessionVariable( 'LastAccessesURI' );
}
else if ( isset( $_SERVER['HTTP_REFERER'] ) && trim( $_SERVER['HTTP_REFERER'] ) !== '' )
{
    $defaultRedirectURI = $_SERVER['HTTP_REFERER'];
}

$safeDefaultRedirectURI = sevenxSwitchAdminDesignNormalizeRedirectURI( $defaultRedirectURI, $fallbackRedirectURI );
return $Module->redirectTo( $safeDefaultRedirectURI );

?>