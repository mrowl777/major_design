<?php

class Handler{

    function find_palindrome(){
        $string = $_POST['input'];
        $palindromes = [];
        $words_list = preg_split("/[\s,.:;]+/", $string);

        foreach ( $words_list as $word ) {
            preg_match_all('/./us', $word, $result);
            $revert = join( '', array_reverse($result[0]) );
            if( $word == $revert && iconv_strlen($word) != 1 ){
                $palindromes[] = $word;
            }
        }

        if( empty($palindromes) ){
            die( json_encode(['result' => 'not_found']) );
        }

        $response = [
            'result' => 'ok', 
            'data' => $palindromes
        ];

        die( json_encode($response) );
    }
}

$handler = new Handler();

if( isset( $_POST['action'] ) ){
    switch ( $_POST['action'] ) {
        case 'get_palindrome':
            $handler->find_palindrome();
            break;
        
        default:
            die();
            break;
    }
}
?>