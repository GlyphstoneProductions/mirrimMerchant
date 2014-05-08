<?php

/*
 * Copyright © 2011 - 2014 Modernized Media, LLC.
 * All Rights Reserved. No part of this code may be reproduced without Modernized Media's express consent.
 * http://www.modernizedmedia.com
 */

?>

<?php echo Asset::render_css('user-edit'); ?>
<?php echo Asset::render_js('user-edit'); ?>

<div class="row">    
    <hr/>
    <div class='col-md-6'>
        <legend>Profile Settings</legend>
        <div class="form-group">
            <div class="preview" style="float:left;border:2px dotted #CCC;display:block;">
                <?php if($user->get_meta('profile_img')): ?>
                    <img id="profile_picture_preview" src="/files/thumb/<?php echo $user->get_meta('profile_img'); ?>/175/auto/fit?_=<?php echo time(); ?>">
                <?php else: ?> 
                    <img id="profile_picture_preview" src="<?php echo Asset::img('main/silhouette-dark.png'); ?>"/>
                <?php endif; ?>
            </div>
            <div class="well" style="margin-left:30px; padding:10px;display:inline-block;margin 0 0 14px; height:100px">
                <label>Upload a picture.</label>
                    <br/>
                <div class="btn btn-primary" id="upload_button"><i class="icon-upload"></i> Upload a File</div>
            </div>
            <input type="hidden" id="profile_img" name="profile_img" value="<?php echo set_value('profile_img', $user->get_meta('profile_img') ); ?>"/>
        </div>
    </div>
    <div class="col-md-6">
        <legend>&nbsp;</legend>
    </div>
</div>

<!-- make timezones way better, but limit it to American timezones -->
<script type="template" id="timezones-template">
    <label for="user_timezone" class="col-md-3 control-label">Timezone</label>
    <div class="col-md-9">
        <select name="user[timezone]" class="form-control">
            <?php foreach(timezones() as $tz=>$name): ?>
                <option value="<?php echo $tz; ?>" <?php echo set_select('user[timezone]', $tz, $tz == $user->timezone); ?>><?php echo $name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</script>

<script type="text/javascript">
$(function() {
    
    var tokens = new Object;
    tokens[Core.Security.getToken()] = Core.Security.getHash();
    tokens['user_id'] = '<?php echo $user->id; ?>';
    
    var btn;
    var profile_img = new AjaxUpload('upload_button', {
            action: '/admin/main/profile_img',
            name: 'file',
            data: tokens,
            onSubmit: function(file, extension) {
                    $('div.preview').addClass('loading');
                    btn = $('#upload_button');
                    btn.button('loading');
            },
            onComplete: function(file, response) {
                response = JSON.parse(response);
                btn.button('reset');
                if(response.success == true) {   
                    $('#profile_img').val(response.file_id);
                    $('#profile_picture_preview').attr('src','/files/thumb/'+response.file_id+'/175/auto/fit?_='+moment().format('X'));
                    notifications.success(response.message);
                } else {
                    notifications.error(response.message);
                }
            }
    });

});
</script>

<script type="text/javascript">
    $(function() {
        // make timezones better
		var timezones = $('#timezones-template').html();
        $('select[name="user[timezone]"]').closest('.form-group').html(timezones);
        
        $('.calculator').calculadora({});

        $('select').select2();
		$('#user_phone').mask('999-999-9999');
    })
</script>