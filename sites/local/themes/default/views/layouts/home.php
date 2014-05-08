<?php

/* 
  *  Copyright © 2011 - 2014 Modernized Media, LLC.
  *  All Rights Reserved. No part of this code may be reproduced without Modernized Media's express consent.
  *  http://www.modernizedmedia.com
 */

?>
<!DOCTYPE html>
<html>
    <head>
        <title><?=$template['title'];?></title>
        <?=$template['metadata'];?>
        <?=Asset::render_js('head.core');?>
        <?=Asset::render_css('head.core');?>
    </head>
    <body class="page-home">
        <div id="container">
            <?=file_partial('navigation');?>
            <?=file_partial('banners');?>
            <?=$template['body'];?>
            <?=file_partial('footer');?>
        </div>
        <?=Asset::render_js('foot.core');?>
    </body>
</html>