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
    $DB->insert_record('role_allow_override', $allow_override1);

    // allow_override2
    $allow_override2 = new stdClass();

    $allow_override2->roleid = $verify_role_id;
    $allow_override2->allowoverride = $allowoverride2;
    $DB->insert_record('role_allow_override', $allow_override2);


    // allow_override3
    $allow_override3 = new stdClass();

    $allow_override3->roleid = $verify_role_id;
    $allow_override3->allowoverride = $allowoverride3;
    $DB->insert_record('role_allow_override', $allow_override3);


    // allow_override4
    $allow_override4 = new stdClass();

    $allow_override4->roleid = $verify_role_id;
    $allow_override4->allowoverride = $allowoverride4;
    $DB->insert_record('role_allow_override', $allow_override4);

    // allow_override5
    $allow_override5 = new stdClass();

    $allow_override5->roleid = $verify_role_id;
    $allow_override5->allowoverride = $allowoverride5;
    $DB->insert_record('role_allow_override', $allow_override5);

    // allow_override6
    $allow_override6 = new stdClass();

    $allow_override6->roleid = $verify_role_id;
    $allow_override6->allowoverride = $allowoverride6;
    $DB->insert_record('role_allow_override', $allow_override6);

    // allow_override7
    $allow_override7 = new stdClass();

    $allow_override7->roleid = $verify_role_id;
    $allow_override7->allowoverride = $allowoverride7;
    $DB->insert_record('role_allow_override', $allow_override7);




    // ******************************************************************* ALLOW SWITCH CREATION*************************************
    // mdl_role_allow_switch
    $allowswitch1 = 2;
    $allowswitch2 = 3;
    $allowswitch3 = 4;
    $allowswitch4 = 5;
    $allowswitch5 = 6;


    // allow_switch1
    $allow_switch1 = new stdClass();

    $allow_switch1->roleid = $verify_role_id;
    $allow_switch1->allowoverride = $allowswitch1;
    $DB->insert_record('role_allow_switch', $allow_switch1);

    // allow_switch2
    $allow_switch2 = new stdClass();

    $allow_switch2->roleid = $verify_role_id;
    $allow_switch2->allowoverride = $allowswitch2;
    $DB->insert_record('role_allow_switch', $allow_switch2);

    // allow_switch3
    $allow_switch3 = new stdClass();

    $allow_switch3->roleid = $verify_role_id;
    $allow_switch3->allowoverride = $allowswitch3;
    $DB->insert_record('role_allow_switch', $allow_switch3);

    // allow_switch4
    $allow_switch4 = new stdClass();

    $allow_switch4->roleid = $verify_role_id;
    $allow_switch4->allowoverride = $allowswitch4;
    $DB->insert_record('role_allow_switch', $allow_switch4);

    // allow_switch5
    $allow_switch5 = new stdClass();

    $allow_switch5->roleid = $verify_role_id;
    $allow_switch5->allowoverride = $allowswitch5;
    $DB->insert_record('role_allow_switch', $allow_switch5);


    // ******************************************************************* ALLOW VIEW CREATION*************************************

    // mdl_role_allow_view
    $allowview1 = 2;
    $allowview2 = 3;
    $allowview3 = 4;
    $allowview4 = 5;
    $allowview5 = 6;
    $allowview6 = 7;
    $allowview7 = 8;



    // allow_view1
    $allow_view1 = new stdClass();

    $allow_view1->roleid = $verify_role_id;
    $allow_view1->allowoverride = $allowview1;
    $DB->insert_record('role_allow_view', $allow_view1);


    // allow_view1
    $allow_view1 = new stdClass();

    $allow_view1->roleid = $verify_role_id;
    $allow_view1->allowoverride = $allowview1;
    $DB->insert_record('role_allow_view', $allow_view1);



    // mdl_role_context_levels
    mysqli_close($mysql);
    return true;
}
