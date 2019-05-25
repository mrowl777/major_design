<?php

class Handler{

    function find_palindrome(){
        // получаем введенную пользователем строку
        $string = $_POST['input'];
        // создаем пустой массив палидромов
        $palindromes = [];
        // делим полученную строку на слова
        $words_list = preg_split("/[\s,.:;]+/", $string);
        // перебираем список слов
        foreach ( $words_list as $word ) {
            preg_match_all('/./us', $word, $result);
            // переворачиваем массив задом-наперед и складываем в строку
            $revert = join( '', array_reverse($result[0]) );
            // если исходное слово совпадает с перевернутым и больше одной буквы
            // добавляем его в массив
            if( $word == $revert && iconv_strlen($word) != 1 ){
                $palindromes[] = $word;
            }
        }
        // если массив пустой - возвращаем ошибку и завершаем выполнение
        if( empty($palindromes) ){
            die( json_encode(['result' => 'not_found']) );
        }

        // если не пустой - возвращаем данные
        $response = [
            'result' => 'ok', 
            'data' => $palindromes
        ];

        die( json_encode($response) );
    }
}

// создаем объект класса
$handler = new Handler();
// если пришел пост запрос и в нем есть экшен, то смотрим какой
if( isset( $_POST['action'] ) ){
    switch ( $_POST['action'] ) {
        case 'get_palindrome':
            // вызываем соответствующий метод класса
            $handler->find_palindrome();
            break;
        
        default:
        // если ничего не нашли, завершаемся
            die();
            break;
    }
}
?>