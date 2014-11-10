<div class="container-fluid">
  <h4>Groups Table</h4>
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
      array('Group ID',
        'Group Name',
        'Special Key',
        'Edit',
        'Delete',
      ),
    );

    $group_id_array = $this->group_model->grab_all_group_ids();
    foreach ($group_id_array as $group_id) {
      $temp = $this->group_model->get_group_object_by_id($group_id);
      $table_data[] = array(
        $temp->id,
        $temp->name,
        $temp->special_key,
        '<a href="' . base_url() . 'group/edit?id=' . $group_id . '"><span class="glyphicon glyphicon-edit spangre">',
        '<a><span onclick="confirm_delete_group(' . $group_id . ')" class="glyphicon glyphicon-remove spanred pointer"></span></a>',
      );
    }
    $this->table->set_template($table_template);
    echo $this->table->generate($table_data);
    ?>
  </div>
</div>