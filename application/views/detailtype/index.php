<div class="row"> <!--SECOND ROW -->
  <div class="col-xs-12 col-md-4"></div>
  <div class="col-xs-12 col-md-4"><h3>User Detail Types</h3></div>
  <div class="col-xs-12 col-md-4"></div>
</div> <!--END SECOND ROW -->
<div class='row'><!--THIRD ROW -->
  <div class="col-xs-12 col-md-4"></div>
  <div class="col-xs-12 col-md-4">
    <a href="detail_type/add" >ADD NEW DETAIL TYPE</a>
  </div>
  <div class="col-xs-12 col-md-4"></div>
</div><!--END THIRD ROW -->

<div class="row"> <!--FOURTH ROW -->
  <hr>
  <div class="col-xs-12 col-md-3"> <!--FIRST COLUMN -->
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
    $table_data = array(
      array('Current User Detail',
        'Edit Link',
        'Delete',
      ),
    );
    $detail_types = $this->detail_type_model->get_all_user_detail_types();
    foreach ($detail_types as $detail_type) {
      $table_data[] = array(
        $detail_type,
        '<a href="' . base_url() . 'detail_type/edit?name=' . $detail_type . '"><span class="glyphicon glyphicon-edit"></span></a>',
        '<a><span onclick="confirm_detail_type_delete(\'' . $detail_type . '\')" class="glyphicon glyphicon-remove spanred pointer"></span></a>',
      );
    }
    $this->table->set_template($table_template);
    echo $this->table->generate($table_data);
    ?>
  </div> <!-- END FIRST COLUMN -->
  <div class="col-xs-12 col-md-3"> <!--SECOND COLUMN -->
  </div> <!--END SECOND COLUMN -->
  <div class="col-xs-12 col-md-3"> <!--3rd COLUMN -->        
  </div> <!--END THIRD COLUMN -->
  <div class="col-xs-12 col-md-3"> <!--4th COLUMN -->
  </div> <!--END FOURTH COLUMN -->
</div><!--END FOURTH ROW -->
