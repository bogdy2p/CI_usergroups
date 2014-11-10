<div class ="container">
 
  <div class="row">
    <div class="col-xs-4 col-md-4"></div>
    <div class="col-xs-4 col-md-4">

      <?php
      // GENERATE FORM OF SWITCHING USERS WITH CODEIGNITER FORM HELPER
      echo form_open('user/view_user');
      $id_array = $this->user_model->grab_all_user_ids();
      $data = array();
      foreach ($id_array as $id => $value) {
        $data[$value] = 'User ' . $value . ' - ' . $this->user_model->get_user_name_by_user_id($value);
      }
      echo form_dropdown('id', $data, 'ASD');
      echo '<br /><br />';
      echo form_submit('submit', 'Change User Account', 'class="btn btn-success"');
      echo form_close();
      ?>
    </div>
    <div class="col-xs-4 col-md-4"></div>
  </div>
  <div clas="row">
    <?php
    // GENERATE TABLES USING CODEIGNITER TABLE HELPER 

    $tmpl1 = array(
      'table_open' => '<table class="table table-bordered ">',
      'heading_row_start' => '<tr class="">',
      'heading_row_end' => '</tr>',
      'heading_cell_start' => '<th class="danger ">',
      'heading_cell_end' => '</th>',
      'row_start'           => '<tr class="">',
      'row_end'             => '</tr>',
      'cell_start'          => '<td class="">',
      'cell_end'            => '</td>',
      'row_alt_start'       => '<tr class="">',
      'row_alt_end'         => '</tr>',
      'cell_alt_start'      => '<td class="">',
      'cell_alt_end'        => '</td>',
      'table_close' => '</table>',
    );

    $this->table->set_template($tmpl1);
    if (isset($_POST['id'])) {
      $user_id = $_POST['id'];
    }
    else {
      $user_id = $_GET['id'];
    }
    // SPLIT THIS IN 2 TABLES
    $userdata = $this->user_model->get_user_object($user_id);
    $data_table_1 = array(
      array('User ID',
            'Username',
            'Email',
            ),
      array(
        $userdata->id,
        $userdata->username,
        $userdata->email,
        ),
    );
    $data_table_2 = array(
      array('First Name', 
            'Last Name',
            'Member Of'),
      array(
        $userdata->first_name,
        $userdata->last_name,
        'GROUPS HERE'),
    );
    
    
    ?>

<?php 
    $tmpl2 = array(
      'table_open' => '<table class="table table-bordered col-xs-12 col-md-3">',
      'heading_row_start' => '<tr>',
      'heading_row_end' => '</tr>',
      'heading_cell_start' => '<th class="success">',
      'heading_cell_end' => '</th>',
      'table_close' => '</table>',
    );

    $this->table->set_template($tmpl2);

    $user_details_ids = $this->user_model->get_user_details_array($user_id);

    foreach ($user_details_ids as $user_detail_id) {
      $detail = $this->user_model->get_detail_data_by_detail_id($user_detail_id);
      $data2 = array(
        array($detail['type'],),
        array($detail['value'],),
      );
     
    }
    
     
?>
    <div class="col-xs-12 col-md-4">
      <?php echo $this->table->generate($data_table_1); ?>
    </div>
    <div class="col-xs-12 col-md-4">
      <?php   echo $this->table->generate($data_table_2); ?>
    </div>
    <div class="col-xs-12 col-md-4">
      <?php echo $this->table->generate($data2); ?>
    </div>





<?php
if (isset($_GET['id']) && ($_GET['id'] > 0)) {
  $_POST['id'] = $_GET['id'];
}
if (isset($_POST['id']) && ($_POST['id'] > 0)) {
  //$this->user_model->print_user_information_table_html($_POST['id']);
  $this->user_model->print_user_details_information_table_html($_POST['id']);
}
?>
  </div>
</div>