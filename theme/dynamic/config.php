<?php
// This file is part of Moodle - http://moodle.org/
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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.
/**
 * Config for the dynamic theme
 *
 * @package   theme_dynamic
 * @copyright � 2012 - 2013 | 3i Logic (Pvt) Ltd.
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
$THEME->name = 'dynamic';
// Name of the theme.

//$THEME->parents = array('clean', 'bootstrapbase');

$THEME->parents = array( 'clean',  'bootstrapbase' );
// Which existing theme(s) in the /theme/ directory
// do you want this theme to extend. A theme can
// extend any number of themes. Rather than
// creating an entirely new theme and copying all
// of the CSS, you can simply create a new theme,
// extend the theme you like and just add the
// changes you want to your theme.
$THEME->sheets = array('core', 'settings');
// List exsisting theme(s) to use as parents.

$THEME->sheets = array(
    'baseadmin',
    'baseautocomplete',
    'baseblocks',
    'basecalendar',
    'basecore',
    'basecourse',
    'basedock',
    'baseeditor',
    'basefilemanager',
    'basegrade',
    'basemessage',
    'basepagelayout',
    'basequestion',
    'basesearch',
    'basetabs',
    'basetemplates',
    'baseuser',
    'canvasadmin',
    'canvasblocks',
    'canvascore',
    'canvascourse',
    'canvaseditor',
    'canvasmods',
    'canvaspagelayout',
    'canvaspopups',
    'canvastables',
    'canvastabs',
    'canvastext',
    'settings',
    'bootstrap',
    'sl',
    'green',
    'blue',
    'orange',
    'ie',
);
// Name of the stylesheet(s) you are including in
// this new theme's /styles/ directory.
$THEME->enable_dock = true;
// Do you want to use the new navigation dock?

$THEME->layouts = array(
    // The pagelayout used when a redirection is occuring.
    'redirect' => array(
        'file' => 'embedded.php',
        'regions' => array(),
        'options' => array('nofooter'=>true, 'nonavbar'=>true, 'nocourseheaderfooter'=>true),
    ),
    'report' => array(
        'file' => 'general.php',
        'regions' => array('side-pre'),
        'defaultregion' => 'side-pre',
    ),
    // The pagelayout used for safebrowser and securewindow.
    'secure' => array(
        'file' => 'general.php',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-pre',
        'options' => array('nofooter'=>true, 'nonavbar'=>true, 'nocustommenu'=>true, 'nologinlinks'=>true, 'nocourseheaderfooter'=>true),
    ),

    // Most pages - if we encounter an unknown or a missing page type, this one is used.
    'base' => array(
        'file' => 'general.php',
        'regions' => array()
    ),
    'standard' => array(
        'file' => 'general.php',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-post'
    ),
    // Course page.
    'course' => array(
        'file' => 'general.php',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-post'
    ),
    // Course page.
    'coursecategory' => array(
        'file' => 'general.php',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-post'
    ),
    'incourse' => array(
        'file' => 'general.php',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-post'
    ),
    'frontpage' => array(
        'file' => 'general.php',
        'regions' => array('side-pre'),
        'defaultregion' => 'side-pre'
    ),
    'admin' => array(
        'file' => 'general.php',
        'regions' => array('side-pre'),
        'defaultregion' => 'side-pre'
    ),
    'mydashboard' => array(
        'file' => 'general.php',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-post'
    ),
    'mypublic' => array(
        'file' => 'general.php',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-post'
    ),
    'login' => array(
        'file' => 'login.php',
        'regions' => array()
    ),
    // Pages that appear in pop-up windows - no navigation, no blocks, no header.
    'popup' => array(
        'file' => 'general.php',
        'regions' => array(),
        'options' => array('nofooter' => true, 'nonavbar' => true, 'noblocks' => true),
    ),
    // No blocks and minimal footer - used for legacy frame layouts only!
    'frametop' => array(
        'file' => 'general.php',
        'regions' => array(),
        'options' => array('nofooter', 'noblocks' => true),
    ),
    // Embeded pages, like iframe embeded in moodleform
    'embedded' => array(
       // 'theme' => 'canvas',
        'file' => 'embedded.php',
        'regions' => array(),
        'options' => array('nofooter' => true, 'nonavbar' => true),
    ),
    // Used during upgrade and install, and for the 'This site is undergoing maintenance' message.
    // This must not have any blocks, and it is good idea if it does not have links to.
    // other places - for example there should not be a home link in the footer.
    'maintenance' => array(
        'file' => 'general.php',
        'regions' => array(),
        'options' => array('nofooter' => true, 'nonavbar' => true, 'noblocks' => true),
    ),
    // Should display the content and basic headers only.
    'print' => array(
        'file' => 'general.php',
        'regions' => array(),
        'options' => array('nofooter' => true, 'nonavbar' => false, 'noblocks' => true),
    ),

);

$THEME->enable_dock = true;
$THEME->csspostprocess = 'dynamic_process_css';

// Dynamic Theme Specific settings for Administrators to customise
// css.

$THEME->editor_sheets = array('editor');
