<?php
/*
 * Copyright © 2011 - 2013 Modernized Media, LLC.
 * All Rights Reserved. No part of this code may be reproduced without Modernized Media's express consent.
 * http://www.modernizedmedia.com
 */
 
 /* This is loaded evertim */

include_once FCPATH.'/sites/local/main/libraries/includes.php';

class Actions_Main {
    
    public function __construct() {
		// global css loads
		Asset::css('main/text-color-fix.css', 'admin.head');
		Asset::css('main/admin-overrides.css', 'admin.head');
		
        //Actions::add('users.properties.init', array(&$this, 'user_init'), 1, 10); not useful now that we can override Core_User
        Actions::add('admin.logo', array(&$this, 'admin_logo'));
        Actions::add('admin.login.logo', array(&$this, 'admin_login_logo'));
        
		// edit user stuff
        Actions::add('admin.users.create.edit.superadmin', array(&$this, 'superadmin_view'), 1, 10);
        Actions::add('admin.users.write.edit.superadmin', array(&$this, 'superadmin_view'), 1, 10);
        Actions::add('admin.users.profile.edit.superadmin', array(&$this, 'superadmin_view'), 1, 10);
        Actions::add('admin.users.create.update.superadmin', array(&$this, 'superadmin_save'), 1, 10);
        Actions::add('admin.users.write.update.superadmin', array(&$this, 'superadmin_save'), 1, 10);
        Actions::add('admin.users.profile.update.superadmin', array(&$this, 'superadmin_save'), 1, 10);
		
		// profile sidebar partial
		ci()->template->set_menu_partial('profile', 'main/admin/profile_sidebar', array(), 'admin.sidebar', 0);
    }
 
    public function superadmin_view($user = null) {
		// get a local user...
        if(!is_a($user, 'Local_User')) {
            if(is_object($user) && property_exists($user, 'id') && is_guid($user->id)) {
                $user = new Local_User($user->id);
            } else {
                $user = new Local_User();
            }
        }
		
		// Admin_controller autoloads aren't done on core pages, so make sure to load what you need
        Asset::js('main/ajaxupload.js', 'admin.head');
        Asset::js('main/jquery.calculadora.js', 'admin.head');
        Asset::js('main/select2.js', 'admin.head');
        Asset::js('main/jquery.maskedinput.js', 'admin.head');
        Asset::css('main/select2.css', 'admin.head');
        Asset::css('main/select2-bootstrap.css', 'admin.head');

        $data = array(
            'user'=>$user,       
        );
                
        echo ci()->load->view('main/admin/users/superadmin_profile', $data, true);
    }
    
    public function superadmin_save($user_id) {
        // nothing special to do here
    }
	
    public function admin_logo($logo)
    {
        return Asset::img('main/logo.png', true);
    }
    
    public function admin_login_logo($logo)
    {
        return Asset::img('main/login-logo.png', true);
    }
}

// instantiate it to run the constructor
new Actions_Main();
