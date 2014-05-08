<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * Copyright © 2011 - 2014 Modernized Media, LLC.
 * All Rights Reserved. No part of this code may be reproduced without Modernized Media's express consent.
 * http://www.modernizedmedia.com
 */

/**
 * Any quickie utilities you might need to run manually should go here
 *
 * @author Lea
 */
class Util_controller extends MY_Controller {
    public function __construct() {
        parent::__construct();
        
//        if(ENVIRONMENT == 'production') {
//            if(!$this->input->is_cli_request()) show404();
//        }
    }
	
	// put you shtuff here.
}
    
