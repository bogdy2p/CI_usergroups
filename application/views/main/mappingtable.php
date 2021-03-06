<div class="row">
  <div class="col-xs-12 col-md-12">
    <h4>Mapping Table</h4>
    <?php
    $table_template = array(
      'table_open' => '<table class="table table-bordered col-xs-12 col-md-3 tablesorter" id="mappingTable">',
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

    $this->table->set_heading(' Map ID ', ' User ID ', ' Group ID ', 'Delete');
    $maps_id_array = $this->main_model->read();
    foreach ($maps_id_array as $map) {
      $this->table->add_row(
          array('data' =>  $map['id'], 'class' => 'highlight col-xs-1 col-md-1'),
          array('data' => $this->user_model->get_user_name_by_user_id($map['user_id']), 'class' => 'highlight col-xs-5 col-md-5 wordwrap1'),
          array('data' => $map['group_id'] . ' - ' . $this->group_model->get_group_name_by_group_id($map['group_id']), 'class' => 'highlight col-xs-5 col-md-5'),
          array('data' => '<a><span onclick="confirm_delete_mapping(' . $map['id'] . ')" class="glyphicon glyphicon-remove spanred pointer"></span></a>', 'class' => 'highlight col-xs-1 col-md-1',)   
      );
    }
    $this->table->set_template($table_template);
    echo $this->table->generate();
    ?>

    <div id="pagerMapping" class="tablesorterPager">
      <form>
        <select class="form-control-static pagesize">
          <option selected="selected" value="2">2 / Page</option>
          <option value="3">3 / Page</option>
          <option value="4">4 / Page</option>
          <option value="100">100 / Page</option>
        </select>
        <img src="<?php echo base_url() . 'assets/tablesorter/themes/blue/' ?>first.png" class="first"/>
        <img src="<?php echo base_url() . 'assets/tablesorter/themes/blue/' ?>prev.png" class="prev"/>
        <input type="text" class="pagedisplay"> <!-- this can be any element, including an input -->
        <img src="<?php echo base_url() . 'assets/tablesorter/themes/blue/' ?>next.png" class="next"/>
        <img src="<?php echo base_url() . 'assets/tablesorter/themes/blue/' ?>last.png" class="last"/>
      </form>
    </div>
  </div>
</div>