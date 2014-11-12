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
  $sort_column = 'id';
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
  $id_asc = '<a href="?table=users&sortby=id&mode=asc">' . $model1 . '</a>';
  $id_desc = '<a href="?table=users&sortby=id&mode=desc">' . $model2 . '</a>';
  $name_asc = '<a href="?table=users&sortby=username&mode=asc">' . $model1 . '</a>';
  $name_desc = '<a href="?table=users&sortby=username&mode=desc">' . $model2 . '</a>';
  $creation_date_asc = '<a href="?table=users&sortby=creation_date&mode=asc">' . $model1 . '</a>';
  $creation_date_desc = '<a href="?table=users&sortby=creation_date&mode=desc">' . $model2 . '</a>';
  $number_of_logins_asc = '<a href="?table=users&sortby=total_logins&mode=asc">' . $model1 . '</a>';
  $number_of_logins_desc = '<a href="?table=users&sortby=total_logins&mode=desc">' . $model2 . '</a>';


  $this->table->set_heading(
      array('data' => $id_asc . ' User Id ' . $id_desc ,'id'=>'user_id'),
      array('data' => $name_asc . ' Username ' . $name_desc,'id' => 'username'),
      array('data' => $creation_date_asc . ' Created ' . $creation_date_desc, 'id' => 'created'),
      array('data'=> $number_of_logins_asc . ' Logins ' . $number_of_logins_desc,'id'=>'logins'),
      'View',
      'Edit',
      'Delete');

  $user_id_array = $this->user_model->read_sorted($sort_column, $sort_order);
  foreach ($user_id_array as $user) {
    $this->table->add_row(
        array('data' => $user['id'], 'class' => 'highlight col-xs-1 col-md-1'), array('data' => $user['username'], 'class' => 'highlight col-xs-4 col-md-3 wordwrap1'), array('data' => $user['creation_date'], 'class' => 'highlight col-xs-4 col-md-3 wordwrap1'), array('data' => $user['total_logins'], 'class' => 'highlight col-xs-1 col-md-1 wordwrap1'), array('data' => '<a href="' . base_url() . 'user/view_user?id=' . $user['id'] . '"><span class="glyphicon glyphicon-eye-open"></span>', 'class' => 'highlight col-xs-1 col-md-1'), array('data' => '<a href="' . base_url() . 'user/edit?id=' . $user['id'] . '"><span class="glyphicon glyphicon-edit spangre"></span>', 'class' => 'highlight col-xs-1 col-md-1', 'colspan' => 1), array('data' => '<a><span class="glyphicon glyphicon-remove spanred pointer" onclick=confirm_delete_user(' . $user['id'] . ');></span>', 'class' => 'highlight col-xs-1 col-md-1')
    );
  }
  $this->table->set_template($table_template);
  echo $this->table->generate();
  ?>
</div>

