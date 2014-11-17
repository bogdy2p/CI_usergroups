<div class="latest_posts_display">
  <br />FLOW :
  <br />Display a table of 5 posts ordered by DATE.
  <br />Display : Post Content ,Post Author , and Posting Date.
  <br />Table should not be bordered inside , only coloured rows.


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
      array('data' => ' Poster Image'), array('data' => ' Content '), array('data' => ' Posted By'), array('data' => ' Date Posted ')
  );
  
  $post_array = $this->post_model->read();

  foreach ($post_array as $post) {
    // THE POST (USER ID SHOULD BE CONVERTED TO GRAB THE USERNAME);
    $this->table->add_row(
        array('data' => 'GRAB THUMBNAIL OF THE USER HERE', 'class' => ''), array('data' => $post['content'], 'class' => 'highlight col-xs-1 col-md-1'), array('data' => $post['user_id'], 'class' => 'highlight col-xs-3 col-md-3 wordwrap1'), array('data' => $post['date_posted'], 'class' => 'highlight col-xs-3 col-md-3 wordwrap1')
    );
  }
  $this->table->set_template($post_table_template);
  echo $this->table->generate();
  ?>




  Latest posts will be displayed here.  
</div>


