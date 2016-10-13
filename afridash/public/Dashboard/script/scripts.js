
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
$(document).on("click", "#deleteClass", function(){
  if(confirm('Are you sure?')){
      var id=$(this).data('id');
      var dataString = "course_id="+id;
      $.ajax({
         type: "POST",
        data: dataString,
         cache: false,
         url: "ajax/drop_class.php",
         success: function(result){
             $("#tr"+id).fadeOut('slow');
             showNotification({
                type : "success",
                message: "Class was successfully dropped. ",
                autoClose: true, 
                 duration: 2
            });  
          },
        error: function (msg) {
                        showNotification({
                            message: "Oops! an error occurred.",
                            type: "error", // type of notification is error
                            autoClose: true, // auto close to true
                            duration: 3 // display duration
                        });
            $("#tr"+id).fadeOut('slow');
            }
      });
  }
});

$(document).on("click", "#dropClass", function(){
      var id=$(this).data('id');
      var num_pre=$("#num_pre").val();
    if(num_pre > 1){
        num_pre -=1;
        $("#num_pre").val(num_pre);
    }else{
        $("#RegistrationForm").hide(100);
    }
      var dataString = "course_id="+id+"&pre=true";
      $.ajax({
         type: "POST",
        data: dataString,
         cache: false,
         url: "ajax/drop_class.php",
         success: function(result){
             $("#tr"+id).fadeOut('slow');
             showNotification({
                type : "success",
                message: "Class was successfully removed from your list. ",
                autoClose: true, 
                 duration: 2
            });  
          },
        error: function (msg) {
                        showNotification({
                            message: "Oops! an error occurred.",
                            type: "error", // type of notification is error
                            autoClose: true, // auto close to true
                            duration: 3 // display duration
                        });
            $("#tr"+id).fadeOut('slow');
            }
      });
});