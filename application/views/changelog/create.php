<div class="row">
  <div class="col-xs-12 col-md-4"></div>
  <div class="col-xs-12 col-md-4">
    <?php echo validation_errors('<p class="error">'); ?>
    <?php
    $size_options = array(
      'h1' => 'H1',
      'h2' => 'H2',
      'h3' => 'H3',
      'h4' => 'H4',
      'h5' => 'H5',
      'h6' => 'H6',
    );
    $color_options = array(
      'spanred' => 'Red (hard task)',
      'spanyel' => 'Yellow (normal task)',
      'spangre' => 'Green (easy task)',);

    echo form_open('changelog/validate_form_create_changelog');
    echo form_label('Add New Changelog');
    echo '<br />';
    echo form_input('changelog_text', '', 'placeholder ="Changelog Text"');
    echo '<br /><br />';
    echo form_dropdown('colour', $color_options, $selected = array('spanyel'));
    echo '<br /><br />';
    echo form_dropdown('size', $size_options, $selected = array('h5'));
    echo '<br /><br />';
    echo form_submit('submit', 'Add Changelog_FH', 'id="submit" class="btn btn-success"');
    echo '<br /><br />';
    echo form_close();
    ?>

  </div>
  <div class="col-xs-12 col-md-4"></div>
</div>