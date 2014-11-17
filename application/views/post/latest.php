<div class="row">
  <div class="col-xs-12 col-md-2"></div>
  <div class="col-xs-12 col-md-8"> 
    <?php
    $this->load->model('user_model');
    ?>
    <?php
    $post_table_template = array(
      'table_open' => '<table class="table tablesorter" id="latestPostTable">',
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
        array('data' => ' Post Content '), array('data' => 'By'), array('data' => 'Date')
    );

    $post_array = $this->post_model->read();
    foreach ($post_array as $post) {
      // THE POST (USER ID SHOULD BE CONVERTED TO GRAB THE USERNAME);
      $post_image = $this->post_model->print_poster_thumbnail($post['user_id']);
      $username = $this->user_model->get_user_name_by_user_id($post['user_id']);
      $div_data = '<div class="user"><a href="' . base_url() . 'site/view_user?username=' . $username . '">
        <img class="logo" src="' . $post_image . '"></img>
        <p class="name">' . $username . '</p>
        </a></div>    ';
      $this->table->add_row(
          array('data' => $post['content'], 'class' => 'col-xs-9 col-md-9 align_left'), array('data' => $div_data, 'class' => 'highlight col-xs-1 col-md-1'), array('data' => $post['date_posted'], 'class' => 'highlight col-xs-2 col-md-2 wordwrap1')
      );
    }
    $this->table->set_template($post_table_template);
    echo $this->table->generate();
    ?>

    <div id="pagerLatest" class="tablesorterPager">
      <form>
        <select class="form-control-static pagesize">
          <option selected="selected" value="5">5 / Page</option>
          <option value="10">10 / Page</option>
          <option value="20">20 / Page</option>
          <option value="200">200 / Page</option>
        </select>
        <img src="<?php echo base_url() . 'assets/tablesorter/themes/blue/' ?>first.png" class="first"/>
        <img src="<?php echo base_url() . 'assets/tablesorter/themes/blue/' ?>prev.png" class="prev"/>
        <input type="text" class="pagedisplay"> <!-- this can be any element, including an input -->
        <img src="<?php echo base_url() . 'assets/tablesorter/themes/blue/' ?>next.png" class="next"/>
        <img src="<?php echo base_url() . 'assets/tablesorter/themes/blue/' ?>last.png" class="last"/>
      </form>
    </div>


  </div>
  <div class="col-xs-12 col-md-2"></div>
</div>

