<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Plugin strings are defined here.
 *
 * @package     local_padme
 * @category    string
 * @copyright   2022 SATCHIVI Kokoè Yasmine Ashley <ashleysatchivi92@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


/**
 * Lets the user edit role definitions. 
 *
 * Responds to actions:
 *   add       - add a new role (allows import, duplicate, archetype)
 *   export    - save xml role definition
 *   edit      - edit the definition of a role
 *   view      - view the definition of a role
 *
 * @package    core_role
 * @copyright  1999 onwards Martin Dougiamas (http://dougiamas.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


require_once('../../config.php');
require_once($CFG->dirroot . '/local/padme/rolechange/classes/define_role.php');



// $context = context_system::instance();
// $PAGE->set_context($context);
// $PAGE->set_url(new moodle_url('/local/padme/index.php'));
// $PAGE->set_pagelayout('standard');




$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_url(new moodle_url('/local/padme/index.php'));
$PAGE->set_pagelayout('standard');
$PAGE->set_title($SITE->fullname);
$PAGE->set_heading(get_string('pluginname', 'local_padme'));


require_login();

// $roleid = 1;

$shortname           = 'padme'; //bon
$name                = 'padme hum'; //bon
$description         = 'ceci estun test de création de rôle automatique'; //bon 
$permissions         = ''; // IL VA PRENDRE $DEFINITION...TABLE QUI VIENT A EC TOUTES LES CAPACITES DE L'ADMIN
$archetype           = 'manager';
$contextlevels       = array('cl10', 'cl30', 'cl40', 'cl50');
$allowassign         = array(2, 3, 4, 5); // BON
$allowoverride       = array(2, 3, 4, 5, 6, 7, 8); //bon
$allowswitch         = array(2, 3, 4, 5, 6); //bon
$allowview           = array(2, 3, 4, 5, 6, 7, 8); //bon


$options = array(
    'shortname'     => $shortname,
    'name'          => $name,
    'description'   => $description,
    'archetype'     => $archetype,
    'contextlevels' => $contextlevels,
    'allowassign'   => $allowassign,
    'allowoverride' => $allowoverride,
    'allowswitch'   => $allowswitch,
    'allowview'     => $allowview,
);

 // $definitiontable = new core_role_define_role_table_advanced($context, 0);
// $definitiontable = new core_role_define_role_table_basic($context, 0);

 // $definitiontable->force_archetype($archetype, $options);

 // $definitiontable->force_duplicate($roleid, $options);
 // $definitiontable->save_changes();

 $definitiontable = new core_role_define_role($context, 0);
 $definitiontable->yasmine_role($archetype, $options);

 // $s = $definitiontable->read_submitted_permissions();
// $definitiontable->kokoe_role();

$allowassign -> save_allow('assign');




//AFFICHAGE 


echo $OUTPUT->header();



print_r(" j'existe ");




echo $OUTPUT->footer();