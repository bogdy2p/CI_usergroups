<div class="row">
  <div class="col-xs-12 col-md-12">
    <h4>Users Table</h4>
    <?php
    $table_template = array(
      'table_open' => '<table class="table table-bordered tablesorter" id="usersTable">',
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
        array('data' => ' User Id '), array('data' => ' Username'), array('data' => ' Created '), array('data' => ' Logins '), 'View', 'Edit', 'Delete');

    $user_id_array = $this->user_model->read();
    foreach ($user_id_array as $user) {
      $this->table->add_row(
          array('data' => $user['id'], 'class' => 'highlight col-xs-1 col-md-1'), array('data' => $user['username'], 'class' => 'highlight col-xs-3 col-md-3 wordwrap1'), array('data' => $user['creation_date'], 'class' => 'highlight col-xs-3 col-md-3 wordwrap1'), array('data' => $user['total_logins'], 'class' => 'highlight col-xs-2 col-md-2 wordwrap1'), array('data' => '<a href="' . base_url() . 'user/view_user?id=' . $user['id'] . '"><span class="glyphicon glyphicon-eye-open"></span>', 'class' => 'highlight col-xs-1 col-md-1'), array('data' => '<a href="' . base_url() . 'user/edit?id=' . $user['id'] . '"><span class="glyphicon glyphicon-edit spangre"></span>', 'class' => 'highlight col-xs-1 col-md-1',), array('data' => '<a><span class="glyphicon glyphicon-remove spanred pointer" onclick=confirm_delete_user(' . $user['id'] . ');></span>', 'class' => 'highlight col-xs-1 col-md-1')
      );
    }
    $this->table->set_template($table_template);
    echo $this->table->generate();
    ?>

    <div id="pagerUser" class="tablesorterPager">
      <form>
        <select class="form-control-static pagesize">
          <option selected="selected" value="2">2 / Page</option>
          <option value="3">3 / Page</option>
          <option value="4">4 / Page</option>
          <option value="100">100 / Page</option>
        </select>
        <img src="<?php echo base_url() . 'assets/tablesorter/themes/blue/' ?>first.png" class="first"/>
        <img src="<?php echo base_url() . 'assets/tablesorter/themes/blue/' ?>prev.png" class="prev"/>
        <input type="text" class="pagedisplay"> <!-- this can be any element, including an input -->
        <img src="<?php echo base_url() . 'assets/tablesorter/themes/blue/' ?>next.png" class="next"/>
        <img src="<?php echo base_url() . 'assets/tablesorter/themes/blue/' ?>last.png" class="last"/>
      </form>
    </div>
  </div>
</div>