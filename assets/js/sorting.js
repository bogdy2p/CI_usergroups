//$(document).ready(function() {
//("table").tablesorter();
//});

$(document).ready(function() {
  $("#usersTable")
    .tablesorter({widthFixed: true, widgets: ['zebra']})
    .tablesorterPager({container: $("#pagerUser")});
});
//
$(document).ready(function() {
  $("#groupsTable")
    .tablesorter({widthFixed: true, widgets: ['zebra']})
    .tablesorterPager({container: $("#pagerGroup")});
});

$(document).ready(function()
{
  $("#mappingTable")
    .tablesorter({widthFixed: true, widgets: ['zebra']})
    .tablesorterPager({container: $("#pagerMapping")});
}
);