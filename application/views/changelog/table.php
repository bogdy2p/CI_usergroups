<?php if (!isset($_POST['day']))
  $_POST['day'] = '100';
?>
<h4>Changes for last <?php echo $_POST['day'] - 1; ?> days</h4>
<div class="row"> 
  <?php
  $table_template = array(
    'table_open' => '<table class="table table-bordered">',
    'heading_row_start' => '<tr class="wordwrap1">',
    'heading_row_end' => '</tr>',
    'heading_cell_start' => '<th class="success col-xs-11 col-md-11">',
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
    array('Name',
      'Created',
    ),
  );

  $changelogs = $this->changelog_model->read_for_last_x_days($_POST['day']);
  foreach ($changelogs as $changelog) {
    $table_data[] = array(
      '<' . $changelog['colour'] . '>' . $changelog['name'] . '</' . $changelog['colour'] . '>',
      $changelog['date'],
    );
  }
  $this->table->set_template($table_template);
  echo $this->table->generate($table_data);
  ?>
</div>