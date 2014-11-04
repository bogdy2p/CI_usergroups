<div class="container">
  <div class="col-xs-12 col-md-4"></div>  
  <div class="col-xs-12 col-md-4">
    
    <a href="task/add">ADD NEW TASK</a>
    
  </div>
  <div class="col-xs-12 col-md-4"></div>
<?php $task = new Task_model();
      $task->validate_insert_new_task();
?>
  
</div>