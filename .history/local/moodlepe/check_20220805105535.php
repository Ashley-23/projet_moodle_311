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
 * Plugin version and other meta-data are defined here.
 *
 * @package     local_moodlepe
 * @copyright   2022 SATCHIVI Kokoè Yasmine Ashley <ashleysatchivi92@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


// require_once('config.php');

require_once('../../config.php');
require_once($CFG->dirroot . '/local/moodlepe/edit_database_name.php');

$dbname =  database_name();

$dbusername = database_username();

$dbhostname = database_hostname();

$dbpassword = database_password();

$dbport = database_port();

echo 'hostname = ' . $dbname . '</br>';
echo 'username = ' . $dbusername . '</br>';
echo 'password = ' . $dbme . '</br>';
echo 'hostname = ' . $dbname . '</br>';
echo 'hostname = ' . $dbname . '</br>';
