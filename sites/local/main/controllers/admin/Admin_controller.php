<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * Copyright © 2011 - 2014 Modernized Media, LLC.
 * All Rights Reserved. No part of this code may be reproduced without Modernized Media's express consent.
 * http://www.modernizedmedia.com
 */

class Admin_Controller extends Core_Admin_Controller {
    
    protected $us = null;
    protected $zones = null;
    protected $timezones = null;
    
    public function __construct() {
        parent::__construct();
        
		// the admin panel already loads jquery, bootstrap, fontawesome, and Core.js library.
		$this->load->helper('inflector'); // provides singular(), plural(), humanize()
		
		// keep ajax lean
        if(!IS_AJAX) { 
			
			// easter egg?
			Asset::js('tabby_cats.js','admin.head');
			Asset::css('tabby_cats.css','admin.head');
		
		
			// just make this available to the view
            $this->us = new Country('US');
            $this->zones = $this->us->get_zones();
            $this->timezones = timezones();

            $this->template->set('zones', $this->zones)
							->set('country', $this->us)
                            ->set('timezones', $this->timezones);
        }
    }
}