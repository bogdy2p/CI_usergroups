Create Post Form (view)

  
<?php echo validation_errors('<p class="error">'); ?>
<?php

echo form_open('post/validate_add_new_post');
echo form_label('Post title');
echo'<br />';
echo form_input('post_title');
echo'<br />';
echo form_label('Post Content');
echo'<br />';
echo form_textarea('post_content');
echo'<br />';
echo form_submit('submit', 'Post new content' ,'class="btn btn-success"');
echo form_close();



?>