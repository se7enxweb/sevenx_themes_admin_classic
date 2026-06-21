<?php
/**
 * File containing the switchadmindesign/reset module view.
 *
 * Immediately clears the admin design session variable, reverting to the
 * default admin3 design, then redirects back to the referrer or dashboard.
 *
 * @copyright Copyright (C) 1999 - 2026 se7enx.com. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2.0
 * @version 0.1.0
 * @package sevenx_themes_admin_classic
 */

$Module = $Params['Module'];

$http = eZHTTPTool::instance();

$sevenxINI = eZINI::instance( 'sevenxthemesadminclassic.ini' );
$sessionVarName = $sevenxINI->variable(
    'SevenXThemesAdminClassicSettings',
    'SwitchAdminDesignSessionVariableName'
);
$designListSessionVarName = 'SevenXThemesAdminClassicAdditionalSiteDesignList';

$http->removeSessionVariable( $sessionVarName );
$http->setSessionVariable( $sessionVarName, 'disabled' );
$http->setSessionVariable( $designListSessionVarName, array( 'admin3', 'admin' ) );

// Ensure template selection reflects reset mode immediately.
eZCache::clearByTag( 'template' );
eZCache::clearByTag( 'template-block' );

$redirectURI = $http->hasSessionVariable( 'LastAccessesURI' )
    ? $http->sessionVariable( 'LastAccessesURI' )
    : 'content/dashboard';

return $Module->redirectTo( $redirectURI );
?>
