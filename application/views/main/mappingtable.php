<div class="container-fluid">
  <h4>Mapping Table</h4>
  <div class="row">
    <?php
    $table_template = array(
      'table_open' => '<table class="table table-bordered col-xs-12 col-md-3">',
      'heading_row_start' => '<tr>',
      'heading_row_end' => '</tr>',
      'heading_cell_start' => '<th class="success">',
      'heading_cell_end' => '</th>',
      'row_start' => '<tr class="">',
      'row_end' => '</tr>',
      'cell_start' => '<td class="wordwrap1">',
      'cell_end' => '</td>',
      'row_alt_start' => '<tr class="">',
      'row_alt_end' => '</tr>',
      'cell_alt_start' => '<td class="">',
      'cell_alt_end' => '</td>',
      'table_close' => '</table>',
    );
    $table_data = array(
      array('Map ID',
        'User ID',
        'Group ID',
        'Delete',
      ),
    );

    $maps_id_array = $this->main_model->read();
    foreach ($maps_id_array as $map) {
      $table_data[] = array(
        $map['id'],
        $this->user_model->get_user_name_by_user_id($map['user_id']),
        $map['group_id'] . ' - ' . $this->group_model->get_group_name_by_group_id($map['group_id']),
        '<a><span onclick="confirm_delete_mapping(' . $map['id'] . ')" class="glyphicon glyphicon-remove spanred pointer"></span></a>',
      );
    }
    $this->table->set_template($table_template);
    echo $this->table->generate($table_data);
    ?>
  </div>
</div>