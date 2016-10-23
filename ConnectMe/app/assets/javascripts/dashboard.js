// Place all the behaviors and hooks related to the matching controller here.
// All this logic will automatically be available in application.js.

$(document).on("click", ".mitem", function(e){
  e.preventDefault()
  $that = $(this);
   $(".list-group .mitem").removeClass("active");
  $that.addClass('active');
  var id=$(this).data("id");
  var team = $(this).data("team");
  $.ajax({
    type: "GET",
    url: "/dashboard/"+id+"/?team="+team,
    cache: false,
    success: function(result){
      $("#chatBoxLoad").html(result);
    },
    error: function(result){
      $("#chatBoxLoad").html(result);
    }
  });


});
