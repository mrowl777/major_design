function init(){
  var input = $( '.input' );
  // при нажатии клавиши ф-ция проверят, это был энтер или нет
  // если это был энтер - передает значение инпута в get_data
  input.on( 'keyup', function keyup( e ) {
    if( e.keyCode == 13 ){
      get_data( input.val() );
    }
  });
  // то же самое, только для картинки
  $('.search img').on( 'click', function keyup( e ) {
    get_data( input.val() );
  });
  // сразу ставим фокус на поле, чтобы пользователю не надо было делать это вручную
  // юзабилити - наше все :)
  input.focus();
}

// ф-ция делает асинхронный запрос к серверу
// получает в качестве параметра введенную пользователем строку
function get_data( string ){
  // если строка пустая, сообщаем об этом и прекращаем дальнейшее выполнение
  if( string == '' ){
    return alert('Введите строку');
  }
// выполняем запрос
  $.post(
    "handler.php",
    {
      //тут в качестве экшэна задано get_palindrome
      //сделано для того, чтобы в будущем можно было расширять функционал и добавлять разные действия
        action: "get_palindrome",
        input: string
    },
    //функция вызывается при ответе хэндлера
    on_handler_answer
  );
}

function on_handler_answer( data ){
  //парсим жсон из ответа
  var response = $.parseJSON( data );
  var input = $( '.input' );
//если результат not_found - сообщаем о том что ничего не нашли и выходим
  if( response.result == 'not_found' ){
    input.val( 'палидромы не обнаружены' );
    return;
  }
//если результат не not_found ставим в инпут то, что нашли
  input.val( response.data );
}

// запускаем инит только после того как загрузилась страница, иначе 
// он отработает раньше и не обнаружит элементы, 
// на которые повешены слушатели => ничего не будет работать
document.addEventListener('DOMContentLoaded', function () {
    init();
});