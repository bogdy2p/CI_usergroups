//$(document).ready(function() {
//  $("table")
//    .tablesorter({widthFixed: true, widgets: ['zebra']});
//});
//

$(document).ready(function() {
  $("#usersTable")
    .tablesorter({widthFixed: true, widgets: ['zebra']})
    .tablesorterPager({container: $("#pagerUser")});
});


$(document).ready(function() {
  $("#groupsTable")
    .tablesorter({widthFixed: true, widgets: ['zebra']})
    .tablesorterPager({container: $("#pagerGroup")});
});

$(document).ready(function() {
  $("#mappingTable")
    .tablesorter({widthFixed: true, widgets: ['zebra']})
    .tablesorterPager({container: $("#pagerMapping")});
});

$(document).ready(function() {
  $("#changelogTable")
    .tablesorter({widthFixed: true, widgets: ['zebra']})
    .tablesorterPager({container: $("#pagerChangelog"), size: 10})
    ;
});

$(document).ready(function() {
  $("#latestPostTable")
    .tablesorter({widthFixed: true, widgets: ['zebra']})
    .tablesorterPager({container: $("#pagerLatest"), size: 5})
});
