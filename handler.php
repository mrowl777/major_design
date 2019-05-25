<?php

class Handler{

    function __construct(){
        if( isset( $_POST['action'] ) ){
            switch ( $_POST['action'] ) {
                case 'get_palindrome':
                    $this->find_palindrome();
                    break;
                
                default:
                    die();
                    break;
            }
        }
    }

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

?>