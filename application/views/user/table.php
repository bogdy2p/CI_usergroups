<?php
if ((isset($_GET['table'])) && ($_GET['table'] == 'users')) {
  if ((isset($_GET['sortby'])) && isset($_GET['mode'])) {
    $sort_column = $_GET['sortby'];
    $sort_order = $_GET['mode'];
    $table_name = $_GET['table'];
  }
  else {
    $table_name = 'users';
    $sort_column = 'id';
    $sort_order = 'asc';
  }
}
else {
  $sort_order = 'asc';
}
?>
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

  $model1 = '<span class="glyphicon glyphicon-sort-by-alphabet spanred"></span>';
  $model2 = '<span class="glyphicon glyphicon-sort-by-alphabet-alt spanred"></span>';
  $id_ascending = '<a href="?table=users&sortby=id&mode=asc">' . $model1 . '</a>';
  $id_descending = '<a href="?table=users&sortby=id&mode=desc">' . $model2 . '</a>';
  //$user_alfabetical = '<a href="?table=users&sortby=username&mode=asc">'.$model1.'</a>';
  $user_alfabetical = '';
  //$user_reversealfabetic = '<a href="?table=users&sortby=username&mode=desc">'.$model2.'</a>';
  $user_reversealfabetic = '';
  $this->table->set_heading($id_ascending . ' User Id ' . $id_descending, $user_alfabetical . ' Username ' . $user_reversealfabetic, 'Full Name', 'View', 'Edit', 'Delete');

  $user_id_array = $this->user_model->get_all_user_ids_sorted_by_id($sort_order);
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

