<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * Copyright © 2011 - 2014 Modernized Media, LLC.
 * All Rights Reserved. No part of this code may be reproduced without Modernized Media's express consent.
 * http://www.modernizedmedia.com
 */

/**
 * This overrides Core_User to replace stupid users with smart ones
 *
 * @author Lea
 */
class Local_User extends Core_User {
    
	private $_user_timezone = null;
	
	/**
	 * Need to precache anything when instantiating the user?
	 */
    public function __construct($user_id = NULL) {
        parent::__construct($user_id);
    }
    
    /**
	 * Need to do anything when you save?
	 */
	public function save() {
		$saved = parent::save();
		if($saved) {
			//$this->update_caches();
		}
		
		return $saved;
	}
	
	
	/** 
	 * Returns a DateTimeZone object for the user
	 * @author Lea
	 */
	public function timezone() {
		if($this->_user_timezone == null) {
			$this->_user_timezone = new DateTimeZone($this->timezone);
		}
			
		return $this->_user_timezone;
	}
}
