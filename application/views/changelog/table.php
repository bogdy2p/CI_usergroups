<?php if (!isset($_POST['day']))
  $_POST['day'] = '100';
?>
<h4>Changes for last <?php echo $_POST['day'] - 1; ?> days</h4>
<div class="row"> 
  <?php
  $table_template = array(
    'table_open' => '<table class="changelogtable table tablesorter" id="changelogTable">',
    'heading_row_start' => '<tr>',
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
  
  $this->table->set_heading(' Name ', ' Created ');
  $changelogs = $this->changelog_model->read_for_last_x_days($_POST['day']);
  foreach ($changelogs as $changelog) {
    $this->table->add_row(
          array('data' => '<' . $changelog['colour'] . '>' . $changelog['name'] . '</' . $changelog['colour'] . '>', 'class' => 'highlight col-xs-10 col-md-10 wordwrap1'),
          array('data' => $changelog['date'], 'class' => 'highlight col-xs-2 col-md-2 wordwrap1')
      );
  }
  $this->table->set_template($table_template);
  echo $this->table->generate();
  ?>
  <div id="pagerChangelog" class="tablesorterPager">
      <form>
        <select class="form-control-static pagesize">
          <option selected="selected" value="2">2 / Page</option>
          <option value="5">5 / Page</option>
          <option value="10">10 / Page</option>
          <option value="20">20 / Page</option>
          <option value="50">50 / Page</option>
          <option value="500">500 / Page</option>
        </select>
        <img src="<?php echo base_url() . 'assets/tablesorter/themes/blue/' ?>first.png" class="first"/>
        <img src="<?php echo base_url() . 'assets/tablesorter/themes/blue/' ?>prev.png" class="prev"/>
        <input type="text" class="pagedisplay"> <!-- this can be any element, including an input -->
        <img src="<?php echo base_url() . 'assets/tablesorter/themes/blue/' ?>next.png" class="next"/>
        <img src="<?php echo base_url() . 'assets/tablesorter/themes/blue/' ?>last.png" class="last"/>
      </form>
    </div>  
  
</div>