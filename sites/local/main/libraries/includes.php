<?php

/*
 * Copyright © 2011 - 2013 Modernized Media, LLC.
 * All Rights Reserved. No part of this code may be reproduced without Modernized Media's express consent.
 * http://www.modernizedmedia.com
 */

/**
 * Exception Types
 */
class RecordNotFoundException extends RuntimeException {};
class InvalidObjectException extends RuntimeException {};
class FormValidationException extends RuntimeException {};

ci()->load->helper('main/core3');
ci()->load->helper('form'); // this should be autoloaded, srsly

require_once FCPATH.'/sites/local/main/libraries/ChromePhp.php';
require_once FCPATH.'/sites/local/main/libraries/Validateable.php';

/** Enums **/
require_once FCPATH.'/sites/local/main/libraries/Enums.php'; // base class

