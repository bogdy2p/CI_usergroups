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
  $fa = 'VASILEEE';
  $id_ascending = '<a href="tables?sortby=id&mode=normal"><span class="glyphicon glyphicon-sort-by-alphabet spanred"></span></a>';
  $id_descending = '<a href="tables?sortby=id&mode=reversed"><span class="glyphicon glyphicon-sort-by-alphabet-alt spanred"></span></a>';
  $user_alfabetical = '<a href="tables?sortby=username&mode=normal"><span class="glyphicon glyphicon-sort-by-alphabet spanred"></span></a>';
  $user_reversealfabetic = '<a href="tables?sortby=username&mode=reversed"><span class="glyphicon glyphicon-sort-by-alphabet-alt spanred"></span></a>';
  $this->table->set_heading($id_ascending.' User Id '.$id_descending, $user_alfabetical.' Username '.$user_reversealfabetic, 'Full Name', 'View', 'Edit', 'Delete');


  $user_id_array = $this->user_model->grab_all_user_ids();
  foreach ($user_id_array as $user_id) {
    $temp = $this->user_model->get_user_object($user_id);
    $this->table->add_row(
        array('data' => $temp->id, 'class' => 'highlight col-xs-1 col-md-1'), array('data' => $temp->username, 'class' => 'highlight col-xs-4 col-md-3 wordwrap1'), array('data' => $temp->first_name . ' ' . $temp->last_name, 'class' => 'highlight col-xs-4 col-md-3 wordwrap1'), array('data' => '<a href="' . base_url() . 'user/view_user?id=' . $user_id . '"><span class="glyphicon glyphicon-eye-open"></span>', 'class' => 'highlight col-xs-1 col-md-1'), array('data' => '<a href="' . base_url() . 'user/edit?id=' . $user_id . '"><span class="glyphicon glyphicon-edit spangre"></span>', 'class' => 'highlight col-xs-1 col-md-1', 'colspan' => 1), array('data' => '<a><span class="glyphicon glyphicon-remove spanred pointer" onclick=confirm_delete_user(' . $user_id . ');></span>', 'class' => 'highlight col-xs-1 col-md-1')
    );
  }
  $this->table->set_template($table_template);
  echo $this->table->generate();
  ?>
</div>