<div class="col-xs-12 col-md-12">
  <h4>Groups Table</h4>
  <?php
  $table_template = array(
    'table_open' => '<table class="table table-bordered col-xs-12 col-md-3 tablesorter" id="groupsTable">',
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

  $this->table->set_heading(' Group ID ', ' Group Name ', ' Special Key ', 'Edit', 'Delete');

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

  <div id="pagerGroup" class="tablesorterPager">
    <form>
      <label>GroupTablePager</label>
      <select class="pagesize">
        <option selected="selected" value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="100">100</option>
      </select>
      <img src="<?php echo base_url() . 'assets/tablesorter/themes/blue/' ?>first.png" class="first"/>
      <img src="<?php echo base_url() . 'assets/tablesorter/themes/blue/' ?>prev.png" class="prev"/>
      <input type="text" class="pagedisplay"> <!-- this can be any element, including an input -->
      <img src="<?php echo base_url() . 'assets/tablesorter/themes/blue/' ?>next.png" class="next"/>
      <img src="<?php echo base_url() . 'assets/tablesorter/themes/blue/' ?>last.png" class="last"/>
    </form>
  </div>  
</div>

