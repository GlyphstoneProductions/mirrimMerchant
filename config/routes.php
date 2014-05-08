<?php

/*
 * Copyright © 2011 - 2013 Modernized Media, LLC.
 * All Rights Reserved. No part of this code may be reproduced without Modernized Media's express consent.
 * http://www.modernizedmedia.com
 */

/**
 * I wish this worked, but at this point the 
 * db isn't loaded so I can't check...
 */
$main_installed = true;

if($main_installed) {
    $route['admin'] = 'main/admin/dashboard';
} else {
    $route['admin'] = 'modules/admin/modules';
}
    
