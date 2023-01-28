$(document).ready(function($){
   $('#searchfield').on('keyup',function(){
   var data=$(this).val();
   $.ajax({
    url: "test.html",
    cache: false
  })
    .done(function( html ) {
      $( "#results" ).append( html );
    });
   })
});