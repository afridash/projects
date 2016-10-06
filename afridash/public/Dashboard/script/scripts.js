
    $('select#sel1').change(function(){
    var course=$('option:selected',this).val();
    var level=$('#sel2').val();
    if(level != ""){
        var dataString = "department="+ course + "&level="+level;
    }else{
         var dataString = "department="+ course; 
    }
    $("#SearchResult").html("<p class='lead text-center'>Please Wait...</p>");
    $.ajax({
		type: "POST",
  url: "ajax/class_search.php",
   data: dataString,
  cache: false,
  success: function(results){
      $("#SearchResult").html(results);
  }
 });
});

$("select#sel2").change(function(){
   var level=$('option:selected',this).val();
    var department = $('#sel1').val();
    if(department !=""){
    var dataString = "department="+department+"&level="+level;
     $("#SearchResult").html("<p class='lead text-center'>Please Wait...</p>");
    $.ajax({
       type: "POST",
        url: "ajax/class_search.php",
        data: dataString,
        cache: false,
        success: function(results){
            $("#SearchResult").html(results);
        }
    });   
    }else{
        $("#SearchResult").html("<p class='lead text-center'>Pick a Subject</p>");
    }
});

$('select#sel3').change(function(){
    var course=$('option:selected',this).val();
    var level=$('#sel4').val();
    if(level != ""){
        var dataString = "department="+ course + "&level="+level;
    }else{
         var dataString = "department="+ course; 
    }
    $(".SearchResult1").html("<p class='lead text-center'>Please Wait...</p>");
    $.ajax({
		type: "POST",
  url: "ajax/registration_search.php",
   data: dataString,
  cache: false,
  success: function(results){
      $(".SearchResult1").html(results);
  }
 });
});

$("select#sel4").change(function(){
   var level=$('option:selected',this).val();
    var department = $('#sel3').val();
    if(department !=""){
    var dataString = "department="+department+"&level="+level;
     $(".SearchResult1").html("<p class='lead text-center'>Please Wait...</p>");
    $.ajax({
       type: "POST",
        url: "ajax/registration_search.php",
        data: dataString,
        cache: false,
        success: function(results){
            $(".SearchResult1").html(results);
        }
    });   
    }else{
        $(".SearchResult1").html("<p class='lead text-center'>Pick a Subject</p>");
    }
});