//$(document).ready(function() {
//("table").tablesorter();
//});

 $(document).ready(function() { 
     $("table") 
     .tablesorter({widthFixed: true, widgets: ['zebra']}) 
     .tablesorterPager({container: $("#pager")}); 
 }); 
//

//$(document).ready(function()
//{
//  $("#mappingTable")
//    .tablesorter({widthFixed: true, widgets: ['zebra']})
////  $("#mappingTable").tablesorterPager();
//}
//);