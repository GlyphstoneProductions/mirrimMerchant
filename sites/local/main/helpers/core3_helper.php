<?php

/*
 * Copyright © 2011 - 2013 Modernized Media, LLC.
 * All Rights Reserved. No part of this code may be reproduced without Modernized Media's express consent.
 * http://www.modernizedmedia.com
 */


if(!function_exists('is_guid')) {
    // brennan said this exists in the core now, but it doesn't... 
    // so just define it until the core does
    function is_guid($number) {
        
        return is_scalar($number) && strlen($number) == 36;
    }
}

function is_core_id($number) {
    return is_guid($number);
}
