function init(){
  var input = $( '.input' );
  
  input.on( 'keyup', function keyup( e ) {
    if( e.keyCode == 13 ){
      get_data( input.val() );
    }
  });
  
  $('.search img').on( 'click', function keyup( e ) {
    get_data( input.val() );
  });

  input.focus();
}

function get_data( string ){
  if( string == '' ){
    return alert('Введите строку');
  }

  $.post(
    "handler.php",
    {
        action: "get_palindrome",
        input: string
    },
    on_handler_answer
  );
}

function on_handler_answer( data ){
  var response = $.parseJSON( data );
  var input = $( '.input' );
  
  if( response.result == 'not_found' ){
    input.text( 'палидромы не обнаружены' );
    return;
  }

  input.text( response.data );
}

document.addEventListener('DOMContentLoaded', function () {
    init();
});