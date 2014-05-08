<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * Copyright © 2011 - 2014 Modernized Media, LLC.
 * All Rights Reserved. No part of this code may be reproduced without Modernized Media's express consent.
 * http://www.modernizedmedia.com
 */

$navigation = array();

if(!ci()->user->active) {
	// no menu for inactive users
    return;
}

if(ci()->user->in_role('admin') || ci()->user->in_role('superadmin')) {
    
} else {
	
}
