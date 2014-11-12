<?php
if ((isset($_GET['table'])) && ($_GET['table'] == 'groups')) {
  if ((isset($_GET['sortby'])) && isset($_GET['mode'])) {
    $sort_column = $_GET['sortby'];
    $sort_order = $_GET['mode'];
    $table_name = $_GET['table'];
  }
  else {
    $table_name = 'groups';
    $sort_column = 'id';
    $sort_order = 'asc';
  }
}
else {
  $sort_order = 'asc';
}
?>

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
  //$table_data = array(array('Group ID','Group Name','Special Key','Edit','Delete',),);

  $model1 = '<span class="glyphicon glyphicon-sort-by-alphabet spanred"></span>';
  $model2 = '<span class="glyphicon glyphicon-sort-by-alphabet-alt spanred"></span>';

  $group_id_ascending = '<a href="?table=groups&sortby=id&mode=asc">' . $model1 . '</a>';
  $group_id_descending = '<a href="?table=groups&sortby=id&mode=desc">' . $model2 . '</a>';
  $group_alphabetical = '';
  $group_rev_alphabetical = '';
  $this->table->set_heading($group_id_ascending . ' Group ID ' . $group_id_descending, $group_alphabetical . ' Group Name ' . $group_rev_alphabetical, 'Special Key', 'Edit', 'Delete');

  $group_id_array = $this->group_model->grab_all_group_ids_sorted('id', $sort_order);
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