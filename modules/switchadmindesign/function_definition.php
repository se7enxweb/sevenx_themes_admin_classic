<?php
/**
 * File containing the switchadmindesign module fetch function definitions.
 *
 * @copyright Copyright (C) 1999 - 2026 se7enx.com. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2.0
 * @version 0.1.0
 * @package sevenx_themes_admin_classic
 */

$FunctionList = array();

$FunctionList['current_design'] = array(
    'name'            => 'current_design',
    'call_method'     => array(
        'include_file' => 'extension/sevenx_themes_admin_classic/classes/switchadmindesignfunctioncollection.php',
        'class'        => 'SwitchAdminDesignFunctionCollection',
        'method'       => 'fetchCurrentDesign'
    ),
    'parameter_type'  => 'standard',
    'parameters'      => array()
);
?>
