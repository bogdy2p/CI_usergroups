<div class="col-xs-12 col-md-2"></div>
<div class="col-xs-12 col-md-8">
  <?php echo validation_errors('<p class="error">'); ?>
  <?php
  echo form_open('post/validate_add_new_post');
  echo form_label('Post title');
  echo'<br />';
  echo form_input('post_title',set_value('post_title'),'placeholder="Any Title" class="post_title"');
  echo'<br />';
  echo form_label('Post Content');
  echo'<br />';
  echo form_textarea('post_content',set_value('post_content'),'placeholder="The content of the post message"');
  echo'<br />';
  echo form_submit('submit', 'Post new content', 'class="btn btn-success"');
  echo form_close();
  ?>
</div>
<div class="col-xs-12 col-md-2"></div>