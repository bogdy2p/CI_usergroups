<?php
if ((isset($_GET['table'])) && ($_GET['table'] == 'mapping')) {
  if ((isset($_GET['sortby'])) && isset($_GET['mode'])) {
    $sort_column = $_GET['sortby'];
    $sort_order = $_GET['mode'];
    $table_name = $_GET['table'];
  }
  else {
    $table_name = 'mapping';
    $sort_column = 'id';
    $sort_order = 'asc';
  }
}
else {
  $sort_order = 'asc';
  $sort_column = 'id';
}
?>

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

  $model1 = '<span class="glyphicon glyphicon-sort-by-alphabet spanred"></span>';
  $model2 = '<span class="glyphicon glyphicon-sort-by-alphabet-alt spanred"></span>';
  $id_asc = '<a href="?table=mapping&sortby=id&mode=asc">' . $model1 . '</a>';
  $id_desc = '<a href="?table=mapping&sortby=id&mode=desc">' . $model2 . '</a>';
  $uid_asc = '<a href="?table=mapping&sortby=user_id&mode=asc">' . $model1 . '</a>';
  $uid_desc = '<a href="?table=mapping&sortby=user_id&mode=desc">' . $model2 . '</a>';
  $gid_asc = '<a href="?table=mapping&sortby=group_id&mode=asc">' . $model1 . '</a>';
  $gid_desc = '<a href="?table=mapping&sortby=group_id&mode=desc">' . $model2 . '</a>';
  $this->table->set_heading($id_asc . ' Map ID ' . $id_desc, $uid_asc . ' User ID ' . $uid_desc, $gid_asc . ' Group ID ' . $gid_desc, 'Delete');

  $maps_id_array = $this->main_model->read_sorted($sort_column, $sort_order);
  foreach ($maps_id_array as $map) {
    $table_data[] = array(
      $map['id'],
      $map['user_id'] . ' - ' . $this->user_model->get_user_name_by_user_id($map['user_id']),
      $map['group_id'] . ' - ' . $this->group_model->get_group_name_by_group_id($map['group_id']),
      '<a><span onclick="confirm_delete_mapping(' . $map['id'] . ')" class="glyphicon glyphicon-remove spanred pointer"></span></a>',
    );
  }
  $this->table->set_template($table_template);
  echo $this->table->generate($table_data);
  ?>
</div>