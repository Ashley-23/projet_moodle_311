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
 * Code to be executed after the plugin's database scheme has been installed is defined here.
 *
 * @package     local_moodlepe
 * @category    upgrade
 * @copyright   2022 SATCHIVI Kokoè Yasmine Ashley <ashleysatchivi92@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


/**
 * Allows you to edit a users profile
 *
 * @copyright 1999 Martin Dougiamas http://dougiamas.com
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @package core_user
 */
defined('MOODLE_INTERNAL') || die();

/**
 * Custom code to be run on installing the plugin.
 */
function xmldb_local_moodlepe_install()
{
    global $DB;
    $role_name = "Administrateur pour les entreprises";
    $role_shortname = "administrateur_entreprise";
    $role_description = "role du plugin moodlepe";
    $role_archetype = "manager";

    $role = new stdClass();

    $role->name = $role_name;
    $role->shortname = $role_shortname;
    $role->description = $role_description;
    $role->archetype = $role_archetype;

    // CREATION DU ROLE DANS LA BASE DE DONNEES 
    $mysql = new mysqli("", "root", "", "moodle", 3306);
    $DB->insert_record('user', $role);
    mysqli_close($mysql);

    // 

    // CONTEXT LEVEL CREATION 
    $contextlevels       = array('cl10', 'cl30', 'cl40', 'cl50');
    $allowassign         = array(2, 3, 4, 5); // BON
    $allowoverride       = array(2, 3, 4, 5, 6, 7, 8); //bon
    $allowswitch         = array(2, 3, 4, 5, 6); //bon
    $allowview           = array(2, 3, 4, 5, 6, 7, 8); //bon

    mdl_role_context_levels`
    return true;
}
