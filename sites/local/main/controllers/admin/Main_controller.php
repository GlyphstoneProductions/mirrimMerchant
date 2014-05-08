<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once 'Admin_controller.php';

/*
 * Copyright © 2011 - 2014 Modernized Media, LLC.
 * All Rights Reserved. No part of this code may be reproduced without Modernized Media's express consent.
 * http://www.modernizedmedia.com
 */

/**
 * Main admin controller, mostly holds the dashboards
 *
 * @author Lea
 */
class Main_controller extends Admin_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        echo "here";
    }

	/** 
	 * Required for smart-user-picker 
	 */
    public function fetch_users() {
        if (!IS_AJAX) $this->access_denied();

        if ($this->input->get('id') != FALSE) {
            $user = new User($this->input->get('id'));
            unset($user->password);
            unset($user->salt);
            unset($user->last_ip);
            unset($user->new_password);
            unset($user->activation_code);
            unset($user->forgotten_password_code);
            unset($user->forgotten_password_time);
            unset($user->remember_code);
            unset($user->created);
            unset($user->last_login);
            unset($user->banned);
            unset($user->active);
            unset($user->company);
            unset($user->phone);
            unset($user->timezone);
            unset($user->role);
            unset($user->banned_reason);
            unset($user->new_password_key);
            unset($user->new_password_requested);
            unset($user->new_email);
            unset($user->new_email_key);
            unset($user->modified);
            die(json_encode($user));
        }

        $this->load->model('main/user_search_model');
        $results = $this->user_search_model->smart_user_search($this->input->get('q'), $this->input->get('limit'), $this->input->get('offset'));
        die(json_encode($results));
    }

	// Profile img uploader
    public function profile_img() {
		// Ajax upload isn't real ajax.  It posts the image from an iframe.
		//if (!IS_AJAX) $this->access_denied();

        $to_return = array();
        $to_return['success'] = false;

        $user = new User($this->input->post('user_id'));
        if ($user->id != $this->input->post('user_id')) {
            $to_return['success'] = false;
            $to_return['message'] = "There was a problem uploading your file.";
            die(json_encode($to_return));
        }

        $file_name = 'profile_img';

        $replace_file = Files::get_file($user->get_meta('profile_img'));
        if ($replace_file['success'] == false)
            $replace_file = false;
        else
            $replace_file = $replace_file['data'];

        $all_types = ci()->config->item('files.allowed_file_ext', 'files');
        $image_types = implode('|', $all_types[FileTypes::image]);
        $details = Files::upload('file', $user->get_meta(FILES_FOLDER_METAKEY), $user->id, 'users', $file_name, false, false, false, $image_types, $replace_file);

        $to_return['success'] = $details['success'];
        $to_return['message'] = $details['message'];

        if ($details['success'] && $details['data']['type'] == FileTypes::image) {
            // comment this if it should save when they save the entire form, and remove the replacement above^
            $user->set_meta('profile_img', $details['data']['id']); // should this save here, or when they save the form?  
            $to_return['file_id'] = $details['data']['id'];
            $to_return['file_name'] = $details['data']['name'];
        }

        die(json_encode($to_return));
    }

	/**
	 * Catch all function for all user's dashboards
	 */
    public function dashboard() {
		
        $this->template
				->title(Settings::get('site_name'), 'Dashboard')
                ->pagename('Dashboard');

        if ($this->user->active) {
            $dashboard_function = $this->user->role->name . '_dashboard';
        } else {
            $dashboard_function = 'disabled_dashboard';
        }

        if (method_exists($this, $dashboard_function)) {
            $this->$dashboard_function();
        } else {
            $this->default_dashboard();
        }
    }

    protected function superadmin_dashboard() {
        
        $this->template
                ->build('main/admin/dashboards/superadmin_dashboard');
    }

    protected function admin_dashboard() {
        
        $this->template
                ->build('main/admin/dashboards/admin_dashboard');
    }

    protected function disabled_dashboard() {
	
        $this->template
                ->build('main/admin/dashboards/disabled_dashboard');
    }

    protected function default_dashboard() {
	
        $this->template
                ->build('main/admin/dashboards/dashboard');
    }	
}
