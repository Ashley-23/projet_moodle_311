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
 * Settings for the dynamic theme
 *
 * @package   theme_dynamic
 * @copyright � 2012 - 2013 | 3i Logic (Pvt) Ltd.
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die;
if ($ADMIN->fulltree) {
// Logo file setting.

	$name = 'theme_dynamic/logo';
    $title = get_string('logo', 'theme_dynamic');
    $description = get_string('logodesc', 'theme_dynamic');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'logo');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);


// Tagline setting.
    $name = 'theme_dynamic/tagline';
    $title = get_string('tagline', 'theme_dynamic');
    $description = get_string('taglinedesc', 'theme_dynamic');
    $setting = new admin_setting_configtextarea($name, $title, $description, get_string('defaulttagline', 'theme_dynamic'));
    $settings->add($setting);
    $name = 'theme_dynamic/hide_tagline';
    $title = get_string('hide_tagline', 'theme_dynamic');
    $description = get_string('hide_taglinedesc', 'theme_dynamic');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $settings->add($setting);
    /*
      // Block region width.
      $name = 'theme_dynamic/regionwidth';
      $title = get_string('regionwidth','theme_dynamic');
      $description = get_string('regionwidthdesc', 'theme_dynamic');
      $default = 240;
      $choices = array(200=>'200px', 240=>'240px', 290=>'290px', 350=>'350px', 420=>'420px');
      $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
      $temp->add($setting); */

// Foot note setting.
    $name = 'theme_dynamic/footnote';
    $title = get_string('footnote', 'theme_dynamic');
    $description = get_string('footnotedesc', 'theme_dynamic');
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');
    $settings->add($setting);
// Custom CSS file.
    $name = 'theme_dynamic/customcss';
    $title = get_string('customcss', 'theme_dynamic');
    $description = get_string('customcssdesc', 'theme_dynamic');
    $setting = new admin_setting_configtextarea($name, $title, $description, '');
    $settings->add($setting);
    // Link color setting.
    $name = 'theme_dynamic/linkcolor';
    $title = get_string('linkcolor', 'theme_dynamic');
    $description = get_string('linkcolordesc', 'theme_dynamic');
    $default = '#999999';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);
    // Link color: hover setting.
    $name = 'theme_dynamic/linkhovercolor';
    $title = get_string('linkhovercolor', 'theme_dynamic');
    $description = get_string('linkhovercolordesc', 'theme_dynamic');
    $default = '#605f5f';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);

    // Menu Link Color.
    $name = 'theme_dynamic/menucolor';
    $title = get_string('menucolor', 'theme_dynamic');
    $description = get_string('menucolordesc', 'theme_dynamic');
    $default = '#000000';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);

    // Menu Link Hover Color.
    $name = 'theme_dynamic/menucolorhover';
    $title = get_string('menucolorhover', 'theme_dynamic');
    $description = get_string('menucolorhoverdesc', 'theme_dynamic');
    $default = '#ffffff';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);
    // Menu Background.
    $name = 'theme_dynamic/blockbordercolor';
    $title = get_string('blockbordercolor', 'theme_dynamic');
    $description = get_string('blockbordercolordesc', 'theme_dynamic');
    $default = '#CCCCCC';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);

    // Menu Hover Background.
    $name = 'theme_dynamic/menulinkhover';
    $title = get_string('menulinkhover', 'theme_dynamic');
    $description = get_string('menulinkhoverdesc', 'theme_dynamic');
    $default = '#605f5f';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);

    // Block Header setting.
    $name = 'theme_dynamic/blockheaderbg';
    $title = get_string('blockheaderbg', 'theme_dynamic');
    $description = get_string('blockheaderbgdesc', 'theme_dynamic');
    $default = '#5b0f01';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);
    // Block Header Fonts setting.
    $name = 'theme_dynamic/blockheadercolor';
    $title = get_string('blockheadercolor', 'theme_dynamic');
    $description = get_string('blockheadercolordesc', 'theme_dynamic');
    $default = '#ffffff';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);

    // Block Header Fonts setting.
    $name = 'theme_dynamic/footerbg';
    $title = get_string('footerbg', 'theme_dynamic');
    $description = get_string('footerbgdesc', 'theme_dynamic');
    $default = '#5b0f01';
    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $settings->add($setting);
}