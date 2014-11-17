<div class="latest_posts_display">
  <div class="col-xs-12 col-md-12"> 
  <?php 
  $this->load->model('user_model');
  ?>
  <?php
  $post_table_template = array(
    'table_open' => '<table class="table table-bordered tablesorter" id="latestPostTable">',
    'heading_row_start' => '<tr class="wordwrap1">',
    'heading_row_end' => '</tr>',
    'heading_cell_start' => '<th class="success wordwrap1">',
    'heading_cell_end' => '</th>',
    'row_start' => '<tr class="">',
    'row_end' => '</tr>',
    'cell_start' => '<td class="wordwrap1">',
    'cell_end' => '</td>',
    'row_alt_start' => '<tr class="wordwrap1">',
    'row_alt_end' => '</tr>',
    'cell_alt_start' => '<td class="wordwrap1">',
    'cell_alt_end' => '</td>',
    'table_close' => '</table>',
  );
  $this->table->set_heading(
      array('data' => ' Date Posted '),
      array('data' => ' Post Title '),
      array('data' => ' Content') 
  );
  $user_id = $this->session->userdata['user_id'];
  $my_posts = $this->post_model->read_for_user($user_id);
  
  foreach ($my_posts as $post) {
    $this->table->add_row(
        array('data' => $post['date_posted'], 'class' => 'highlight col-xs-2 col-md-2 wordwrap1'),
        array('data' => $post['title'], 'class' => 'highlight col-xs-2 col-md-2'),
        array('data' => $post['content'], 'class' => 'col-xs-8 col-md-8 ')
        
    );
  }
  $this->table->set_template($post_table_template);
  echo $this->table->generate();
  ?>
</div>
</div>


