<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * Copyright © 2011 - 2014 Modernized Media, LLC.
 * All Rights Reserved. No part of this code may be reproduced without Modernized Media's express consent.
 * http://www.modernizedmedia.com
 */

/**
 * Front end main controller
 * also the catch all for missing pages
 *
 * @author Lea
 */
include 'Public_controller.php';
class Main_controller extends Public_controller {
    
    public function __construct() {
        parent::__construct();
        
    }
    
    public function index() {
        $this->template
				->title('Your Site')
                ->set_layout('home')
                ->build('main/index');
    }
	
	public function page1() {
        $this->template
				->title('Your Site')
                ->set_layout('default')
                ->build('main/page1');
    }
}
