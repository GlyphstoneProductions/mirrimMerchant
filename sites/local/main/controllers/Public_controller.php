<?php

/* 
  *  Copyright © 2011 - 2014 Modernized Media, LLC.
  *  All Rights Reserved. No part of this code may be reproduced without Modernized Media's express consent.
  *  http://www.modernizedmedia.com
 */

 /**
  * Public controller represents the front end of the website.
  * Any front end controllers should extend this!
  *
  * @author Lea
  */
class Public_controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        
		// This is for the front end of the website
		// you can preload some assets
        Asset::js('jquery.min.js', 'head.core');
        Asset::js('bootstrap.min.js', 'head.core');
        Asset::css('bootstrap.min.css', 'head.core');
        Asset::css('fontawesome.min.css', 'head.core');
        
		// recommend a theme file for front end css and js
		//Asset::css('themes/rsi.css', 'head.core');
		//Asset::js('themes/rsi.js', 'foot.core');
        
        $this->template
                ->set_theme('default')
                ->set_layout('default');
    }
}