<?php

/*
 * Copyright © 2011 - 2013 Modernized Media, LLC.
 * All Rights Reserved. No part of this code may be reproduced without Modernized Media's express consent.
 * http://www.modernizedmedia.com
 */

?>

<div class="profile-info-big">
	<?php $profile_img_id = $this->user->get_meta('profile_img'); ?>
	<?php if(!empty($profile_img_id)): ?>
		<a href="/admin">
			<img src="/files/thumb/<?php echo $profile_img_id; ?>/198/auto/fit" class="img-rounded sidebar-profile-picture" title="<?php echo $this->user->first_name.' '.$this->user->last_name; ?>"/>
		</a>
		<br/><br/>
	<?php endif; ?>
	<p><strong><?php echo $this->user->first_name.' '.$this->user->last_name; ?></strong></p>
</div>
<?php if(!empty($profile_img_id)): ?>
	<a href="/admin" class="profile-info-small">
		<img src="/files/thumb/<?php echo $this->user->get_meta('profile_img'); ?>/25/auto/fit" title="<?php echo $this->user->first_name.' '.$this->user->last_name; ?>"/>
	</a>
<?php endif; ?>

