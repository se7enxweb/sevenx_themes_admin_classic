<?php
/**
 * File containing the switchadmindesign module configuration.
 *
 * @copyright Copyright (C) 1999 - 2026 se7enx.com. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2.0
 * @version 0.1.0
 * @package sevenx_themes_admin_classic
 */

$Module = array( 'name' => 'SevenX Switch Admin Design' );

$ViewList = array();

$ViewList['switch'] = array(
    'script'                    => 'switch.php',
    'ui_context'                => 'administration',
    'functions'                 => array( 'switch' ),
    'default_navigation_part'   => 'sevenxswitchadmindesignnavigationpart',
    'post_actions'              => array(),
    'single_post_actions'       => array(
        'SwitchAdminDesignButton' => 'SwitchAdminDesign'
    ),
    'post_action_parameters'    => array(
        'SwitchAdminDesign' => array(
            'SwitchAdminDesignSetDesign' => 'Design',
            'SwitchAdminDesignRedirectURI' => 'RedirectURI'
        )
    ),
    'params'                    => array()
);

$ViewList['reset'] = array(
    'script'                    => 'reset.php',
    'ui_context'                => 'administration',
    'functions'                 => array( 'switch' ),
    'default_navigation_part'   => 'sevenxswitchadmindesignnavigationpart',
    'params'                    => array()
);

$FunctionList = array();

$FunctionList['switch'] = array();

$FunctionList['current_design'] = array();
?>
