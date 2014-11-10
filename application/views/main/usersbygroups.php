<div class="container-fluid">
  <h4>Users by group</h4>
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
    $groups = $this->group_model->grab_all_group_ids();
    foreach ($groups as $group_id) {
      $table_data = array(
        array(
          $this->group_model->get_group_name_by_group_id($group_id) . '\'s',
          'User ID',
        ),
      );
      $userids_array = $this->user_model->get_userids_for_a_group($group_id);
      foreach ($userids_array as $key => $value) {
        $table_data[] = array(
          $this->user_model->get_user_name_by_user_id($value),
          $value,
        );
      }
      $this->table->set_template($table_template);
      echo $this->table->generate($table_data);
    }
    ?>