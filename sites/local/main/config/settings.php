<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * Copyright © 2011 - 2014 Modernized Media, LLC.
 * All Rights Reserved. No part of this code may be reproduced without Modernized Media's express consent.
 * http://www.modernizedmedia.com
 */

$settings = array();

//$settings['auto_username'] = array(
//    'name' => 'Edit Modules', 
//    'description' => 'Create the username automatically, meaning users can skip making one on registration.',
//    'type' => 'radio',
//    'default' => true,
//    'options' => '1=Enabled|0=Disabled',
//    'is_required' => 0,
//    'is_gui' => 1,
//    'order' => 100
//);
//
//$settings['site_name'] = array(
//    'title' => 'Site Name',
//    'description' => 'The name of the website for page titles and for use around the site.',
//    'type' => 'text',
//    'default' => 'Un-named Website',
//    'value' => '',
//    'options' => '',
//    'is_required' => 1,
//    'is_gui' => 1,
//    'module' => '',
//    'order' => 1000,
//);
//$settings['site_slogan'] = array(
//    'title' => 'Site Slogan',
//    'description' => 'The slogan of the website for page titles and for use around the site',
//    'type' => 'text',
//    'default' => '',
//    'value' => 'Add your slogan here',
//    'options' => '',
//    'is_required' => 0,
//    'is_gui' => 1,
//    'module' => '',
//    'order' => 999,
//);
//$settings['contact_email'] = array(
//    'title' => 'Contact Email',
//    'description' => 'The "Contact Us" email used around the site.',
//    'type' => 'text',
//    'default' => 'support@modernizedmedia.com',
//    'value' => '',
//    'options' => '',
//    'is_required' => 0,
//    'is_gui' => 1,
//    'module' => '',
//    'order' => 998,
//);
//$settings['contact_phone'] = array(
//    'title' => 'Contact Phone',
//    'description' => 'The "Contact" phone number used around the site.',
//    'type' => 'text',
//    'default' => '555-555-5555',
//    'value' => '',
//    'options' => '',
//    'is_required' => 0,
//    'is_gui' => 1,
//    'module' => '',
//    'order' => 998,
//);
//$settings['site_lang'] = array(
//    'title' => 'Site Language',
//    'description' => 'The native language of the website, used to choose templates of e-mail notifications, contact form, and other features that should not depend on the language of a user.',
//    'type' => 'select',
//    'default' => AUTO_LANGUAGE,
//    'value' => AUTO_LANGUAGE,
//    'options' => 'func:get_supported_lang',
//    'is_required' => 1,
//    'is_gui' => 1,
//    'module' => '',
//    'order' => 997,
//);
//$settings['site_public_lang'] = array(
//    'title' => 'Public Languages',
//    'description' => 'Which are the languages really supported and offered on the front-end of your website?',
//    'type' => 'checkbox',
//    'default' => AUTO_LANGUAGE,
//    'value' => AUTO_LANGUAGE,
//    'options' => 'func:get_supported_lang',
//    'is_required' => 1,
//    'is_gui' => 1,
//    'module' => '',
//    'order' => 996,
//);
//$settings['date_format'] = array(
//    'title' => 'Date Format',
//    'description' => 'How should dates be displayed across the website and control panel? Using the <a target=\"_blank\" href=\"http://php.net/manual/en/function.date.php\">date format</a> from PHP - OR - Using the format of <a target=\"_blank\" href=\"http://php.net/manual/en/function.strftime.php\">strings formatted as date</a> from PHP.',
//    'type' => 'text',
//    'default' => 'Y-m-d',
//    'value' => '',
//    'options' => '',
//    'is_required' => 1,
//    'is_gui' => 1,
//    'module' => '',
//    'order' => 995,
//);
//$settings['time_format'] = array(
//    'title' => 'Time Format',
//    'description' => 'How should times be displayed across the website and control panel? Using the <a target=\"_blank\" href=\"http://php.net/manual/en/function.date.php\">date format</a> from PHP - OR - Using the format of <a target=\"_blank\" href=\"http://php.net/manual/en/function.strftime.php\">strings formatted as date</a> from PHP.',
//    'type' => 'text',
//    'default' => 'H:i:s',
//    'value' => '',
//    'options' => '',
//    'is_required' => 1,
//    'is_gui' => 1,
//    'module' => '',
//    'order' => 994,
//);
//$settings['datetime_format'] = array(
//    'title' => 'Time Format',
//    'description' => 'How should datetimes be displayed across the website and control panel? Using the <a target=\"_blank\" href=\"http://php.net/manual/en/function.date.php\">date format</a> from PHP - OR - Using the format of <a target=\"_blank\" href=\"http://php.net/manual/en/function.strftime.php\">strings formatted as date</a> from PHP.',
//    'type' => 'text',
//    'default' => 'Y-m-d H:i:s',
//    'value' => '',
//    'options' => '',
//    'is_required' => 1,
//    'is_gui' => 1,
//    'module' => '',
//    'order' => 993,
//);
//$settings['default_timezone'] = array(
//    'title' => 'Default Timezone',
//    'description' => 'The site\'s default timezone',
//    'type' => 'select',
//    'default' => 'America/Denver',
//    'value' => 'America/Denver',
//    'options' => 'func:setting_timezones',
//    'is_required' => 1,
//    'is_gui' => 0,
//    'module' => '',
//    'order' => 993,
//);
//$settings['frontend_enabled'] = array(
//    'title' => 'Site Status',
//    'description' => 'Use this option to the user-facing part of the site on or off. Useful when you want to take the site down for maintenance.',
//    'type' => 'radio',
//    'default' => true,
//    'value' => '',
//    'options' => '1=Open|0=Closed',
//    'is_required' => 1,
//    'is_gui' => 1,
//    'module' => '',
//    'order' => 988,
//);
//$settings['unavailable_message'] = array(
//    'title' => 'Unavailable Message',
//    'description' => 'When the site is turned off or there is a major problem, this message will show to users.',
//    'type' => 'textarea',
//    'default' => 'Sorry, this website is currently unavailable.',
//    'value' => '',
//    'options' => '',
//    'is_required' => 0,
//    'is_gui' => 1,
//    'module' => '',
//    'order' => 987,
//);
//$settings['admin_force_https'] = array(
//    'title' => 'Force HTTPS for Control Panel?',
//    'description' => 'Allow only the HTTPS protocol when using the Control Panel?',
//    'type' => 'radio',
//    'default' => false,
//    'value' => '',
//    'options' => '1=Yes|0=No',
//    'is_required' => 1,
//    'is_gui' => 1,
//    'module' => '',
//    'order' => 0,
//);