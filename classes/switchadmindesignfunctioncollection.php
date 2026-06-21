<?php
/**
 * File containing the SwitchAdminDesignFunctionCollection class.
 *
 * Provides template fetch functions for the switchadmindesign module.
 *
 * @copyright Copyright (C) 1999 - 2026 se7enx.com. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2.0
 * @version 0.1.0
 * @package sevenx_themes_admin_classic
 */

class SwitchAdminDesignFunctionCollection
{
    /**
     * Returns the current admin design state for use in templates.
     *
     * @return array result hash with 'is_classic' (bool) key
     */
    function fetchCurrentDesign()
    {
        $http = eZHTTPTool::instance();
        $sevenxINI = eZINI::instance( 'sevenxthemesadminclassic.ini' );
        $sessionVarName = $sevenxINI->variable(
            'SevenXThemesAdminClassicSettings',
            'SwitchAdminDesignSessionVariableName'
        );

        $isClassic = $http->hasSessionVariable( $sessionVarName )
                     && $http->sessionVariable( $sessionVarName ) === 'enabled';

        return array( 'result' => array( 'is_classic' => $isClassic ) );
    }
}

?>