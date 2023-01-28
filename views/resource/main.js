$(document).ready(function($){
   $('#searchfield').on('keyup',function(){
   var data=$(this).val();
   $.ajax({
    url: "../filemanager/inc.php",
    type:'POST',
    cache: false,
    'data':{data:data},
  })
    .done(function( html ) {
        $('#search-result').fadeIn('slow');
        $('#search-result-box').empty();
        $('#search-result-box').append(html);
      console.log(html);
    });
   })
});