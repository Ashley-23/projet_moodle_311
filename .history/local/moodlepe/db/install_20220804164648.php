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
    $mysql = new mysqli("", "root", "", "moodle", 3306);
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

    $DB->insert_record('role', $role);


    // recupération de l'id du rôle qu'on vient de créer

    $check_role_id = $mysql->query("SELECT * FROM mdl_role WHERE name='$role_name' AND shortname='$role_shortname' AND description ='$role_description'", MYSQLI_USE_RESULT);

    while ($row = mysqli_fetch_assoc($check_role_id)) {
        $verify_role_id = $row['id'];
    }

    // *******************************************************************CONTEXT LEVEL CREATION************************************* 

    $contextlevel1 = "cl10";
    $contextlevel2 = "cl30";
    $contextlevel3 = "cl40";
    $contextlevel4 = "cl50";

    // cl10
    $context_level1 = new stdClass();

    $context_level1->roleid = $verify_role_id;
    $context_level1->contextlevel = $contextlevel1;
    $DB->insert_record('role_context_levels', $context_level1);

    // cl30   
    $context_level2 = new stdClass();

    $context_level2->roleid = $verify_role_id;
    $context_level2->contextlevel = $contextlevel2;
    $DB->insert_record('role_context_levels', $context_level2);

    // cl40
    $context_level3 = new stdClass();

    $context_level3->roleid = $verify_role_id;
    $context_level3->contextlevel = $contextlevel3;
    $DB->insert_record('role_context_levels', $context_level3);

    // cl50
    $context_level4 = new stdClass();

    $context_level4->roleid = $verify_role_id;
    $context_level4->contextlevel = $contextlevel4;
    $DB->insert_record('role_context_levels', $context_level4);





    // ******************************************************************* ALLOW ASSIGN CREATION*************************************
    // mdl_role_allow_assign

    $allowassign1 = 2;
    $allowassign2 = 3;
    $allowassign3 = 4;
    $allowassign4 = 5;
    //

    // allow_assign1
    $allow_assign1 = new stdClass();

    $allow_assign1->roleid = $verify_role_id;
    $allow_assign1->allowassign = $allowassign1;
    $DB->insert_record('role_allow_assign', $allow_assign1);


    // allow_assign2
    $allow_assign2 = new stdClass();

    $allow_assign2->roleid = $verify_role_id;
    $allow_assign2->allowassign = $allowassign2;
    $DB->insert_record('role_allow_assign', $allow_assign2);

    // allow_assign3
    $allow_assign3 = new stdClass();

    $allow_assign3->roleid = $verify_role_id;
    $allow_assign3->allowassign = $allowassign3;
    $DB->insert_record('role_allow_assign', $allow_assign3);

    // allow_assign4
    $allow_assign4 = new stdClass();

    $allow_assign4->roleid = $verify_role_id;
    $allow_assign4->allowassign = $allowassign4;
    $DB->insert_record('role_allow_assign', $allow_assign4);

    // ******************************************************************* ALLOW OVERRIDE CREATION*************************************

    // mdl_role_allow_override
    $allowoverride1 = 2;
    $allowoverride2 = 3;
    $allowoverride3 = 4;
    $allowoverride4 = 5;
    $allowoverride5 = 6;
    $allowoverride6 = 7;
    $allowoverride7 = 8;

    // allow_override1
    $allow_override1 = new stdClass();

    $allow_override1->roleid = $verify_role_id;
    $allow_override1->allowoverride = $allowoverride1;
    $DB->insert_record('role_allow_override', $allowoverride1);






    $allowswitch         = array(2, 3, 4, 5, 6); //bon
    $allowview           = array(2, 3, 4, 5, 6, 7, 8); //bon

    // mdl_role_context_levels
    mysqli_close($mysql);
    return true;
}
