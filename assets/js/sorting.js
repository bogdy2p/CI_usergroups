function sortBy(btn){
  //Split the button id by the dot
  // name.ASC => a[0]name and a[1]ASC
  
  var a = btn.split(".");
  var b = "";
  
  (a[1] == "ASC") ? b = "DESC" : b = "ASC";
  
  var c = a[0]+"."+b;
  //Assign the new id to the button(header) so it toggles
  document.getElementById(btn).id = c;
  //Add text while request processes
  
}
