<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * Copyright © 2011 - 2014 Modernized Media, LLC.
 * All Rights Reserved. No part of this code may be reproduced without Modernized Media's express consent.
 * http://www.modernizedmedia.com
 */

/**
 * Cron jobs should go here
 *
 * @author Lea
 */
class Cron_controller extends MY_Controller {
    public function __construct() {
        parent::__construct();
        
//        if(ENVIRONMENT == 'production') {
//            if(!$this->input->is_cli_request()) show404();
//        }
    }
    
	// put you shtuff here.
	
}
    

