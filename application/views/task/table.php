<div class="row">
  <div class="col-xs-12 col-md-1"></div>
  <div class="col-xs-12 col-md-10">
    <?php
    $task = new Task_model();
    $task->generate_todo_list_html_admin();
    ?>
  </div>
  <div class="col-xs-12 col-md-1"></div>
</div>