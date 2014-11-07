<div class="row">
  <div class="col-xs-12 col-md-4"></div>
  <div class="col-xs-12 col-md-4">
    <?php
    $task = new Task_model();
    $task->generate_todo_add_new_form();
    ?>
  </div>
  <div class="col-xs-12 col-md-4"></div>
</div>


<div class="row">
  
   <?php
    //<option selected="null" value="spanred">Red (hard)</option>
      //            <option value="spanyel">Yellow (normal)</option>
        //          <option value="spangre">Green (easy)</option>
  $size_options = array(
    'h1'=>'H1',
    'h2'=>'H2',
    'h3'=>'H3',
    'h4'=>'H4',
    'h5'=>'H5',
    'h6'=>'H6',
    );
  $color_options = array(
    'spanred'=>'Red (hard task)',
    'spanyel'=>'Yellow (normal task)',
    'spangre'=>'Green (easy task)',);
      
   
   
  echo form_open('task/create_task');
  echo form_label('Add New Task');echo '<br />';
  echo form_input('todo_text','','placeholder ="Task Text"');echo '<br /><br />';
  echo form_dropdown('colour', $color_options, $selected=('spanyel'));echo '<br /><br />';
  echo form_dropdown('size', $size_options , $selected=('h5'));
  
  echo '<br /><br />';
  echo form_submit('submit', 'Add New Task_FH','class="btn btn-success"');
  echo '<br /><br />';
  echo form_close();
  ?>
  
  
  
</div>
