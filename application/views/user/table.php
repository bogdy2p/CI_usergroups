<div class="container-fluid">
  <h4>Users Table</h4>
  <div class="row">
    <?php
    $table_template = array(
      'table_open' => '<table class="table table-bordered col-xs-12 col-md-3">',
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
    $table_data = array(
      array('User ID',
        'Username',
        'Groups Of Belonging',
        'View',
        'Edit',
        'Delete',
      ),
    );
    $user_id_array = $this->user_model->grab_all_user_ids();
    foreach ($user_id_array as $user_id) {
      $temp = $this->user_model->get_user_object($user_id);
      $groups_array = $this->user_model->get_number_of_groups_for_a_user($user_id);
      $table_data[] = array(
        $temp->id,
        $temp->username,
        implode(" / ", $groups_array),
        '<a href="' . base_url() . 'user/view_user?id=' . $user_id . '"><span class="glyphicon glyphicon-eye-open"></span>',
        '<a href="' . base_url() . 'user/edit?id=' . $user_id . '"><span class="glyphicon glyphicon-edit spangre"></span>',
        '<a><span class="glyphicon glyphicon-remove spanred pointer" onclick=confirm_delete_user(' . $user_id . ');></span>',
      );
    }
    $this->table->set_template($table_template);
    echo $this->table->generate($table_data);
    ?>
  </div>
</div>