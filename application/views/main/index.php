<div class="container">
			<div class="row">
					<div class="col-xs-12 col-md-3"></div>
          <div class="col-xs-12 col-md-6"><h1>Codeigniter User-Group </h1></div>
		  		<div class="col-xs-12 col-md-3"></div>
	  	</div>	
      <div class="row">
					<div class="col-xs-12 col-md-3"></div>
          <div class="col-xs-12 col-md-6"><h1> Administration CMS</h1></div>
		  		<div class="col-xs-12 col-md-3"></div>
	  	</div>	
  <hr>

<div class="row">
  <div class="col-xs-12 col-md-3"><h2>Todo Tasks :</h2></div>
  <div class="col-xs-12 col-md-6">
    <?php $task = new Task_model();
    $task->generate_todo_list_for_main();?>
  </div>
  <div class="col-xs-12 col-md-3">Db Stats Here</div>

</div>
  
  
  <hr>  
<div class="row">COLOUR STATS HERE</div>  


</div> <!-- End of container-->