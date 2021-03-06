<?php
namespace Drall\PRS\BASE;

class Filter{

    function capitalize( $string, $e ='utf-8' ){
        $aTmp = explode(" ",$string);
        $s = array();
        foreach($aTmp as $string){
            if (function_exists('mb_strtoupper') && function_exists('mb_substr') && !empty($string)) {
                $string = mb_strtolower($string, $e);
                $upper = mb_strtoupper($string, $e);
                preg_match('#(.)#us', $upper, $matches);
                $string = $matches[1] . mb_substr($string, 1, mb_strlen($string, $e), $e);
            } else {
                $string = ucfirst($string);
            }
            $s[] = $string;
        }
        $string = implode(" ",$s);
        return $string;
    }


	function phrase_capitalize($string, $e='utf-8'){
		$aTmp = explode(".",$string);
        $s = array();
        foreach($aTmp as $string){
            if (function_exists('mb_strtoupper') && function_exists('mb_substr') && !empty($string)) {
                $string = mb_strtolower($string, $e);
                $upper = mb_strtoupper($string, $e);
                preg_match('#(\s*)(.)#us', $upper, $matches);
                $begin_len = mb_strlen($matches[1] . $matches[2], $e);
                $string = $matches[1] . $matches[2] . mb_substr($string, $begin_len, mb_strlen($string, $e), $e);
            } else {
                $string = ucfirst($string);
            }
            $s[] = $string;
        }
        $string = implode(".",$s);
        return $string;
	}

    function lower( $string, $e ='utf-8' ){
        if (function_exists('mb_strtoupper') && function_exists('mb_substr') && !empty($string)) {
            $string = mb_strtolower($string, $e);
        } else {
            $string = strtolower($string);
        }
        return $string;
    }

    function upper( $string, $e ='utf-8'){
        if (function_exists('mb_strtoupper') && function_exists('mb_substr') && !empty($string)) {
            $string = mb_strtoupper($string, $e);
        } else {
            $string = strtoupper($string);
        }
        return $string;
    }
    
    function camelCase2SnakeCase( $string ){
        return strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $string));
    }

    function toAscii( $v ){
        $chars = array(
            '??'=>'S', '??'=>'s'
            ,'??'=>'Dj', '??'=>'dj'
            ,'??'=>'Z', '??'=>'z'
            ,'??'=>'C', '??'=>'c', '??'=>'C', '??'=>'c'
            ,'??'=>'A', '??'=>'A', '??'=>'A', '??'=>'A', '??'=>'A', '??'=>'A', '??'=>'A'
            ,'??'=>'C'
            ,'??'=>'E', '??'=>'E','??'=>'E', '??'=>'E'
            ,'??'=>'I', '??'=>'I', '??'=>'I', '??'=>'I'
            ,'??'=>'N'
            ,'??'=>'O', '??'=>'O', '??'=>'O','??'=>'O', '??'=>'O', '??'=>'O'
            ,'??'=>'U', '??'=>'U', '??'=>'U', "??"=>"U","??"=>"U"
            ,'??'=>'Y'
            ,'??'=>'R'
            ,'??'=>'B', '??'=>'Ss'
            ,'??'=>'a', '??'=>'a', '??'=>'a', '??'=>'a', '??'=>'a', '??'=>'a', '??'=>'a'
            ,'??'=>'c'
	    	,'??'=>'e', '??'=>'e','??'=>'e', '??'=>'e'
 	    	,'??'=>'i', '??'=>'i', '??'=>'i', '??'=>'i'
            ,'??'=>'o', '??'=>'o', '??'=>'o','??'=>'o', '??'=>'o', '??'=>'o', '??'=>'o'
            ,'??'=>'n'
            ,'??'=>'u', '??'=>'u', '??'=>'u', '??'=>'u',"??"=>"u"
            ,'??'=>'y', '??'=>'b','??'=>'y'
            ,'??'=>'r',
        );
/*
$a = array('??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??'); 
$b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
*/
/*
 //accent-folding function
    var accentMap = {
        '???': 'a',
        '??': 'a',
        '??': 'a',
        '??': 'a',
        '??': 'a',
        '??': 'a',
        '??': 'a',
        '???': 'a',
        '???': 'a',
        '???': 'a',
        '???': 'a',
        '???': 'a',
        '???': 'a',
        '???': 'a',
        '???': 'a',
        '??': 'a',
        '??': 'a',
        '???': 'a',
        '???': 'a',
        '???': 'a',
        '???': 'a',
        '???': 'a',
        '???': 'a',
        '???': 'a',
        '???': 'a',
        '??': 'a',
        '??': 'a',
        '??': 'a',
        '??': 'a',
        '??': 'a',
        '??': 'a',
        '??': 'a',
        '??': 'a',
        '??': 'a',
        '??': 'a',
        '??': 'a',
        '??': 'a',
        '??': 'a',
        '??': 'a',
        '??': 'a',
        '??': 'a',
        '??': 'a',
        '??': 'a',
        '??': 'a',
        '??': 'a',
        '???': 'a',
        '???': 'a',
        '??': 'a',
        '??': 'a',
        '??': 'a',
        '??': 'a',
        '???': 'a',
        '???': 'a',
        '???': 'a',
        '???': 'a',
        '???': 'a',
        '???': 'a',
        '???': 'a',
        '???': 'a',
        '??': 'a',
        '???': 'a',
        '??': 'a',
        '??': 'a',
        '??': 'a',
        '??': 'a',
        '???': 'b',
        '???': 'b',
        '???': 'b',
        '???': 'b',
        '???': 'b',
        '???': 'b',
        '??': 'b',
        '??': 'b',
        '???': 'b',
        '??': 'b',
        '??': 'b',
        '??': 'b',
        '??': 'b',
        '??': 'c',
        '??': 'c',
        '??': 'c',
        '??': 'c',
        '??': 'c',
        '??': 'c',
        '??': 'c',
        '??': 'c',
        '??': 'c',
        '??': 'c',
        '???': 'c',
        '???': 'c',
        '??': 'c',
        '??': 'c',
        '??': 'c',
        '??': 'c',
        '??': 'c',
        '??': 'd',
        '??': 'd',
        '???': 'd',
        '???': 'd',
        '???': 'd',
        '???': 'd',
        '???': 'd',
        '???': 'd',
        '???': 'd',
        '???': 'd',
        '???': 'd',
        '???': 'd',
        '??': 'd',
        '??': 'd',
        '???': 'd',
        '??': 'd',
        '??': 'd',
        '??': 'd',
        '??': 'd',
        '??': 'd',
        '??': 'd',
        '??': 'd',
        '??': 'd',
        '??': 'e',
        '??': 'e',
        '??': 'e',
        '??': 'e',
        '??': 'e',
        '??': 'e',
        '??': 'e',
        '??': 'e',
        '??': 'e',
        '??': 'e',
        '??': 'e',
        '???': 'e',
        '???': 'e',
        '???': 'e',
        '???': 'e',
        '???': 'e',
        '???': 'e',
        '???': 'e',
        '???': 'e',
        '??': 'e',
        '??': 'e',
        '??': 'e',
        '??': 'e',
        '???': 'e',
        '???': 'e',
        '??': 'e',
        '??': 'e',
        '??': 'e',
        '??': 'e',
        '???': 'e',
        '???': 'e',
        '??': 'e',
        '??': 'e',
        '??': 'e',
        '??': 'e',
        '???': 'e',
        '???': 'e',
        '???': 'e',
        '???': 'e',
        '???': 'e',
        '???': 'e',
        '??': 'e',
        '??': 'e',
        '??': 'e',
        '??': 'e',
        '???': 'e',
        '???': 'e',
        '???': 'e',
        '???': 'e',
        '???': 'e',
        '???': 'e',
        '???': 'e',
        '???': 'e',
        '??': 'e',
        '??': 'e',
        '??': 'e',
        '??': 'e',
        '???': 'f',
        '???': 'f',
        '???': 'f',
        '??': 'f',
        '??': 'f',
        '??': 'g',
        '??': 'g',
        '??': 'g',
        '??': 'g',
        '??': 'g',
        '??': 'g',
        '??': 'g',
        '??': 'g',
        '??': 'g',
        '??': 'g',
        '??': 'g',
        '??': 'g',
        '???': 'g',
        '???': 'g',
        '??': 'g',
        '??': 'g',
        '??': 'g',
        '??': 'g',
        '??': 'h',
        '??': 'h',
        '??': 'h',
        '??': 'h',
        '???': 'h',
        '???': 'h',
        '???': 'h',
        '???': 'h',
        '???': 'h',
        '???': 'h',
        '???': 'h',
        '???': 'h',
        '???': 'h',
        '???': 'h',
        'H': 'h',
        '??': 'h',
        '???': 'h',
        '??': 'h',
        '??': 'h',
        '???': 'h',
        '???': 'h',
        '??': 'i',
        '??': 'i',
        '??': 'i',
        '??': 'i',
        '??': 'i',
        '??': 'i',
        '??': 'i',
        '??': 'i',
        '??': 'i',
        '??': 'i',
        '??': 'i',
        '??': 'i',
        '???': 'i',
        '???': 'i',
        '??': 'i',
        '??': 'i',
        '??': 'i',
        'i': 'i',
        '??': 'i',
        '??': 'i',
        '??': 'i',
        '??': 'i',
        '???': 'i',
        '???': 'i',
        '??': 'i',
        '??': 'i',
        '??': 'i',
        '??': 'i',
        '???': 'i',
        '???': 'i',
        '???': 'i',
        '???': 'i',
        'I': 'i',
        '??': 'i',
        '??': 'i',
        '??': 'i',
        '??': 'j',
        '??': 'j',
        'J': 'j',
        '??': 'j',
        '??': 'j',
        '??': 'j',
        '??': 'j',
        '??': 'j',
        '??': 'j',
        '??': 'j',
        '??': 'j',
        '???': 'k',
        '???': 'k',
        '??': 'k',
        '??': 'k',
        '??': 'k',
        '??': 'k',
        '???': 'k',
        '???': 'k',
        '???': 'k',
        '???': 'k',
        '??': 'k',
        '??': 'k',
        '???': 'k',
        '???': 'k',
        '??': 'a',
        '??': 'l',
        '??': 'l',
        '??': 'l',
        '??': 'l',
        '??': 'l',
        '???': 'l',
        '???': 'l',
        '???': 'l',
        '???': 'l',
        '???': 'l',
        '???': 'l',
        '???': 'l',
        '???': 'l',
        '??': 'l',
        '??': 'l',
        '??': 'l',
        '??': 'l',
        '??': 'l',
        '??': 'l',
        '??': 'l',
        '??': 'l',
        '??': 'l',
        '??': 'l',
        '???': 'l',
        '???': 'l',
        '???': 'l',
        '??': 'l',
        '??': 'l',
        '??': 'l',
        '??': 'l',
        '???': 'm',
        '???': 'm',
        '???': 'm',
        '???': 'm',
        '???': 'm',
        '???': 'm',
        '??': 'm',
        '??': 'n',
        '??': 'n',
        '??': 'n',
        '??': 'n',
        '??': 'n',
        '??': 'n',
        '??': 'n',
        '??': 'n',
        '???': 'n',
        '???': 'n',
        '??': 'n',
        '??': 'n',
        '???': 'n',
        '???': 'n',
        '???': 'n',
        '???': 'n',
        '???': 'n',
        '???': 'n',
        '??': 'n',
        '??': 'n',
        '??': 'n',
        '??': 'n',
        '??': 'n',
        '??': 'n',
        'N': 'n',
        '??': 'n',
        'n': 'n',
        '??': 'n',
        '??': 'o',
        '??': 'o',
        '??': 'o',
        '??': 'o',
        '??': 'o',
        '??': 'o',
        '??': 'o',
        '??': 'o',
        '???': 'o',
        '???': 'o',
        '???': 'o',
        '???': 'o',
        '???': 'o',
        '???': 'o',
        '???': 'o',
        '???': 'o',
        '??': 'o',
        '??': 'o',
        '??': 'o',
        '??': 'o',
        '??': 'o',
        '??': 'o',
        '??': 'o',
        '??': 'o',
        '??': 'o',
        '??': 'o',
        '???': 'o',
        '???': 'o',
        '???': 'o',
        '???': 'o',
        '??': 'o',
        '??': 'o',
        '??': 'o',
        '??': 'o',
        '??': 'o',
        '??': 'o',
        '??': 'o',
        '??': 'o',
        '??': 'o',
        '??': 'o',
        '??': 'o',
        '??': 'o',
        '??': 'o',
        '??': 'o',
        '??': 'o',
        '??': 'o',
        '???': 'o',
        '???': 'o',
        '???': 'o',
        '???': 'o',
        '???': 'o',
        '???': 'o',
        '??': 'o',
        '??': 'o',
        '??': 'o',
        '??': 'o',
        '??': 'o',
        '??': 'o',
        '???': 'o',
        '???': 'o',
        '???': 'o',
        '???': 'o',
        '???': 'o',
        '???': 'o',
        '???': 'o',
        '???': 'o',
        '???': 'o',
        '???': 'o',
        '???': 'o',
        '???': 'o',
        '???': 'o',
        '???': 'o',
        '??': 'o',
        '??': 'o',
        '???': 'p',
        '???': 'p',
        '???': 'p',
        '???': 'p',
        '???': 'p',
        '??': 'p',
        '??': 'p',
        'P': 'p',
        '??': 'p',
        'p': 'p',
        '??': 'p',
        '??': 'q',
        '??': 'q',
        '??': 'q',
        '??': 'r',
        '??': 'r',
        '??': 'r',
        '??': 'r',
        '???': 'r',
        '???': 'r',
        '??': 'r',
        '??': 'r',
        '??': 'r',
        '??': 'r',
        '??': 'r',
        '??': 'r',
        '???': 'r',
        '???': 'r',
        '???': 'r',
        '???': 'r',
        '???': 'r',
        '???': 'r',
        '??': 'r',
        '??': 'r',
        '???': 'r',
        '??': 'r',
        '???': 'r',
        '??': 'r',
        '??': 'r',
        '???': 'r',
        '??': 's',
        '??': 's',
        '??': 's',
        '???': 's',
        '???': 's',
        '??': 's',
        '??': 's',
        '??': 's',
        '??': 's',
        '???': 's',
        '???': 's',
        '???': 's',
        '???': 's',
        '???': 's',
        '??': 's',
        '??': 's',
        '???': 's',
        '???': 's',
        '???': 's',
        '???': 's',
        '??': 's',
        '??': 's',
        '??': 's',
        'S': 's',
        '??': 's',
        's': 's',
        '??': 's',
        '??': 't',
        '??': 't',
        '??': 't',
        '??': 't',
        'T': 't',
        '??': 't',
        '???': 't',
        '???': 't',
        '???': 't',
        '??': 't',
        '??': 't',
        '???': 't',
        '???': 't',
        '??': 't',
        '??': 't',
        '???': 't',
        '???': 't',
        '???': 't',
        '???': 't',
        '??': 't',
        '??': 't',
        '??': 't',
        '???': 't',
        '???': 't',
        '??': 't',
        '??': 't',
        '??': 't',
        '??': 't',
        '??': 't',
        '??': 't',
        '??': 'u',
        '??': 'u',
        '??': 'u',
        '??': 'u',
        '??': 'u',
        '??': 'u',
        '??': 'u',
        '??': 'u',
        '??': 'u',
        '??': 'u',
        '??': 'u',
        '??': 'u',
        '??': 'u',
        '??': 'u',
        '??': 'u',
        '??': 'u',
        '??': 'u',
        '??': 'u',
        '??': 'u',
        '??': 'u',
        '??': 'u',
        '??': 'u',
        '??': 'u',
        '??': 'u',
        '??': 'u',
        '??': 'u',
        '???': 'u',
        '???': 'u',
        '??': 'u',
        '??': 'u',
        '??': 'u',
        '??': 'u',
        '???': 'u',
        '???': 'u',
        '???': 'u',
        '???': 'u',
        '??': 'u',
        '??': 'u',
        '??': 'u',
        '??': 'u',
        '??': 'u',
        '??': 'u',
        '???': 'u',
        '???': 'u',
        '???': 'u',
        '???': 'u',
        '???': 'u',
        '???': 'u',
        '???': 'u',
        '???': 'u',
        '???': 'u',
        '???': 'u',
        '???': 'u',
        '???': 'u',
        '???': 'u',
        '???': 'u',
        '???': 'u',
        '???': 'u',
        '???': 'u',
        '???': 'u',
        '??': 'u',
        '??': 'u',
        '???': 'v',
        '???': 'v',
        '???': 'v',
        '???': 'v',
        '??': 'v',
        '??': 'v',
        '???': 'w',
        '???': 'w',
        '???': 'w',
        '???': 'w',
        '??': 'w',
        '??': 'w',
        'W': 'w',
        '??': 'w',
        '???': 'w',
        '???': 'w',
        '???': 'w',
        '???': 'w',
        '???': 'w',
        '???': 'w',
        '???': 'w',
        '???': 'x',
        '???': 'x',
        '???': 'x',
        '???': 'x',
        '??': 'y',
        '??': 'y',
        '???': 'y',
        '???': 'y',
        '??': 'y',
        '??': 'y',
        'Y': 'y',
        '??': 'y',
        '???': 'y',
        '??': 'y',
        '??': 'y',
        '???': 'y',
        '???': 'y',
        '???': 'y',
        '???': 'y',
        '??': 'y',
        '??': 'y',
        '???': 'y',
        '???': 'y',
        '???': 'y',
        '???': 'y',
        '??': 'y',
        '??': 'y',
        '??': 'y',
        '??': 'y',
        '??': 'y',
        '??': 'z',
        '??': 'z',
        '???': 'z',
        '???': 'z',
        '??': 'z',
        '??': 'z',
        '??': 'z',
        '??': 'z',
        '???': 'z',
        '???': 'z',
        '???': 'z',
        '???': 'z',
        '??': 'z',
        '??': 'z',
        '??': 'z',
        '??': 'z',
        '??': 'z',
        '??': 'z',
        '???': 'z',
        '???': 'z',
        '??': 'z',
        '??': 'z',
        '??': 'z',

        // Roman fullwidth ascii equivalents: 0xff00 to 0xff5e
        '???': '2',
        '???': '6',
        '???': 'B',
        '???': 'F',
        '???': 'J',
        '???': 'N',
        '???': 'R',
        '???': 'V',
        '???': 'Z',
        '???': 'b',
        '???': 'f',
        '???': 'j',
        '???': 'n',
        '???': 'r',
        '???': 'v',
        '???': 'z',
        '???': '1',
        '???': '5',
        '???': '9',
        '???': 'A',
        '???': 'E',
        '???': 'I',
        '???': 'M',
        '???': 'Q',
        '???': 'U',
        '???': 'Y',
        '???': 'a',
        '???': 'e',
        '???': 'i',
        '???': 'm',
        '???': 'q',
        '???': 'u',
        '???': 'y',
        '???': '0',
        '???': '4',
        '???': '8',
        '???': 'D',
        '???': 'H',
        '???': 'L',
        '???': 'P',
        '???': 'T',
        '???': 'X',
        '???': 'd',
        '???': 'h',
        '???': 'l',
        '???': 'p',
        '???': 't',
        '???': 'x',
        '???': '3',
        '???': '7',
        '???': 'C',
        '???': 'G',
        '???': 'K',
        '???': 'O',
        '???': 'S',
        '???': 'W',
        '???': 'c',
        '???': 'g',
        '???': 'k',
        '???': 'o',
        '???': 's',
        '???': 'w'
    };
    */

        return strtr( $v, $chars );
    }
    
    function charsetError2UTF8 ( $v ){
	    $chars = array(
        	'??'=>'??'
			,'??'=>'??', '??'=>'??'
			,'??'=>'??'
			,'??'=>'??', '??'=>'??', '??'=>'??','??'=>'??'
			,'??'=>'??'
        );

        return strtr( $v, $chars );
    }
    
    
    
    function charsetError2Ascii ( $v ){
        return $this->toAscii($this->charsetError2UTF8($v));
    	
    }

    function trim( $v ){
        $v = $this->_default( $v, "" );
        //Attention. It is not empty for empty. It is an utf8 special blank char
        $v = str_replace("??"," ",$v);
        return trim( $v );
    }

    function onlyNumber( $v ){
        return preg_replace("/[^0-9]/","", $v);
    }

    function onlyA2Z( $v ){
        return preg_replace("/[^a-zA-Z]/","", $v);
    }

    function onlySpaceA2Z( $v ){
        return preg_replace("/[^a-zA-Z ]/","", $v);
    }

    function multipleSpaces2Single( $v ){
        return preg_replace( "/\s+/", " ", $v );
    }

	//Remove prepositions and some others words
    function removeFromArray( $array, $removeFromArray = array( "DE","DA","DO","DOS","DAS", "COM", "POR", "PRA", "PARA", "EM", "AO", "AOS", "NO", "NA", "NOS", "NAS", "A", "E", "I", "O", "U") ){
        $output = array();
        $len = count($array);
        for($x=0;$x<$len;$x++){
            if( !in_array( $array[$x], $removeFromArray ) ){
                $output[] = $array[$x];
            }
        }
        return $output;
    }

    function punctuationMarks2Space( $v ){
        return strtr($v,array(
            "."=>" "
            ,","=>" "
            ,"/"=>" "
            ,"?"=>" "
            ,"!"=>" "
            ,":"=>" "
            ,";"=>" "
        ));
    }

    function phrase2Words( $v ){
        //Beyond space character, any other that means separation between word
        $v = $this->punctuationMarks2Space( $v );

        //Split words
        $tmp_words = explode(" ",trim($v));

        $len = count($tmp_words);
        $words = array();
        for($x=0;$x<$len;$x++){
            $word = trim( $tmp_words[$x] );
            if( !empty( $word ) ){
                $words[] = $word;
            }
        }
        return $words;
    }
    
    function int2null( $v ){
        if(empty($v) && is_int($v)){
            return null;
        }
        return $v;
    }
    
    function string2null( $v ){
        if(empty($v) && is_string($v)){
            return null;
        }
        return $v;
    }
    
    /*
    Use $Filter->_default($v, "");
    function null2String( $v ){
        if ($v === null){
            $v = (string)"";
        }
            
        return $v; 
    }
    */
    
    //Convert acceptable boolean values to real boolean value
    function val2DBoolean( $v ){
        $not_standard_false_values = ["f","false","0"];
            
        //Not standard false values that must to be converted
        if(in_array($v,$not_standard_false_values,true)){
            return false;
        }
        if( $v === " " ){
            return true;
        }
        return (boolean)$v;
    }
    
    function normalizeTwitterLink( $twitter_link ){
        if( preg_match( '/twitter[.]com/i', $twitter_link ) ){
            return $this->lower($this->normalizeWebsiteLink( $twitter_link ));
        }
        
        if( preg_match( '/^[@]/i', $twitter_link ) ){
            $twitter_link = substr($twitter_link, 1);
        }
        return "http://www.twitter.com/".$this->lower($twitter_link);
    }
    
    function normalizeWebsiteLink( $website_link ){
        if( preg_match("/^http[s]?[:]\/{2}/i", $website_link) ){
            return $this->lower($website_link);
        }
        return "http://".$this->lower($website_link);
    }
    
    //Add default value if attribute is null or do not exist
    function _default( $v, $default_value ){
        if(is_null($v)){
            return $default_value;
        }
        return $v;
    }
    
    function bullshit_pt_BR($v){
        return strtr($v,array(
            'ANUS'=>''
            ,'??NUS'=>''
            ,'BABA-OVO'=>''
            ,'BABAOVO'=>''
            ,'BABACA'=>''
            ,'BACURA'=>''
            ,'BAGOS'=>''
            ,'BAITOLA'=>''
            ,'BALLCAT'=>''
            ,'BEBUM'=>''
            ,'BESTA'=>''
            ,'BICHA'=>''
            ,'BISCA'=>''
            ,'BIXA'=>''
            ,'BOAZUDA'=>''
            ,'BOCETA'=>''
            ,'BOCO'=>''
            ,'BOC??'=>''
            ,'BOIOLA'=>''
            ,'BOLAGATO'=>''
            ,'BOQUETE'=>''
            ,'BOLCAT'=>''
            ,'BOSSETA'=>''
            ,'BOSTA'=>''
            ,'BOSTANA'=>''
            ,'BRECHA'=>''
            ,'BREXA'=>''
            ,'BRIOCO'=>''
            ,'BRONHA'=>''
            ,'BUCA'=>''
            ,'BUCETA'=>''
            ,'BUNDA'=>''
            ,'BUNDUDA'=>''
            ,'BURRA'=>''
            ,'BURRO'=>''
            ,'BUSSETA'=>''
            ,'CACHORRA'=>''
            ,'CACHORRO'=>''
            ,'CADELA'=>''
            ,'CAGA'=>''
            ,'CAGADO'=>''
            ,'CAGAO'=>''
            ,'CAGONA'=>''
            ,'CANALHA'=>''
            ,'CARALHO'=>''
            ,'CASSETA'=>''
            ,'CASSETE'=>''
            ,'CHECHECA'=>''
            ,'CHERECA'=>''
            ,'CHIBUMBA'=>''
            ,'CHIBUMBO'=>''
            ,'CHIFRUDA'=>''
            ,'CHIFRUDO'=>''
            ,'CHOTA'=>''
            ,'CHOCHOTA'=>''
            ,'CHUPADA'=>''
            ,'CHUPADO'=>''
            ,'CLITORIS'=>''
            ,'CLIT??RIS'=>''
            ,'COCAINA'=>''
            ,'COCA??NA'=>''
            ,'COC??'=>''
            ,'CORNA'=>''
            ,'CORNO'=>''
            ,'CORNUDA'=>''
            ,'CORNUDO'=>''
            ,'CORRUPTA'=>''
            ,'CORRUPTO'=>''
            ,'CRETINA'=>''
            ,'CRETINO'=>''
            ,'CRUZ-CREDO'=>''
            ,'CU '=>''
            ,'C??'=>''
            ,'CULHAO'=>''
            ,'CULH??O'=>''
            ,'CULH??ES'=>''
            ,'CURALHO'=>''
            ,'CUZAO'=>''
            ,'CUZ??O'=>''
            ,'CUZUDA'=>''
            ,'CUZUDO'=>''
            ,'DEBIL'=>''
            ,'DEBILOIDE'=>''
            ,'DEFUNTO'=>''
            ,'DEMONIO'=>''
            ,'DEM??NIO'=>''
            ,'DIFUNTO'=>''
            ,'DOIDA'=>''
            ,'DOIDO'=>''
            ,'EGUA'=>''
            ,'??GUA'=>''
            ,'ESCROTA'=>''
            ,'ESCROTO'=>''
            ,'ESPORRADA'=>''
            ,'ESPORRADO'=>''
            ,'ESPORRO'=>''
            ,'ESP??RRO'=>''
            ,'ESTUPIDA'=>''
            ,'EST??PIDA'=>''
            ,'ESTUPIDEZ'=>''
            ,'ESTUPIDO'=>''
            ,'EST??PIDO'=>''
            ,'FEDIDA'=>''
            ,'FEDIDO'=>''
            ,'FEDOR'=>''
            ,'FEDORENTA'=>''
            ,'FEIA'=>''
            ,'FEIO'=>''
            ,'FEIOSA'=>''
            ,'FEIOSO'=>''
            ,'FEIOZA'=>''
            ,'FEIOZO'=>''
            ,'FELACAO'=>''
            ,'FELA????O'=>''
            ,'FENDA'=>''
            ,'FODA'=>''
            ,'FODAO'=>''
            ,'FOD??O'=>''
            ,'FODE'=>''
            ,'FODIDA'=>''
            ,'FODIDO'=>''
            ,'FORNICA'=>''
            ,'FUDENDO'=>''
            ,'FUDECAO'=>''
            ,'FUDE????O'=>''
            ,'FUDIDA'=>''
            ,'FUDIDO'=>''
            ,'FURADA'=>''
            ,'FURADO'=>''
            ,'FURAO'=>''
            ,'FUR??O'=>''
            ,'FURNICA'=>''
            ,'FURNICAR'=>''
            ,'FURO'=>''
            ,'FURONA'=>''
            ,'GAIATA'=>''
            ,'GAIATO'=>''
            ,'GAY'=>''
            ,'GONORREA'=>''
            ,'GONORREIA'=>''
            ,'GOSMA'=>''
            ,'GOSMENTA'=>''
            ,'GOSMENTO'=>''
            ,'GRELINHO'=>''
            ,'GRELO'=>''
            ,'HOMO-SEXUAL'=>''
            ,'HOMOSEXUAL'=>''
            ,'HOMOSSEXUAL'=>''
            ,'IDIOTA'=>''
            ,'IDIOTICE'=>''
            ,'IMBECIL'=>''
            ,'ISCROTA'=>''
            ,'ISCROTO'=>''
            ,'JAPA'=>''
            ,'LADRA'=>''
            ,'LADRAO'=>''
            ,'LADR??O'=>''
            ,'LADROEIRA'=>''
            ,'LADRONA'=>''
            ,'LALAU'=>''
            ,'LEPROSA'=>''
            ,'LEPROSO'=>''
            ,'LESBICA'=>''
            ,'L??SBICA'=>''
            ,'MACACA'=>''
            ,'MACACO'=>''
            ,'MACHONA'=>''
            ,'MACHORRA'=>''
            ,'MANGUACA'=>''
            ,'MANGUA??A'=>''
            ,'MASTURBA'=>''
            ,'MELECA'=>''
            ,'MERDA'=>''
            ,'MIJA'=>''
            ,'MIJADA'=>''
            ,'MIJADO'=>''
            ,'MIJO'=>''
            ,'MOCREA'=>''
            ,'MOCR??A'=>''
            ,'MOCREIA'=>''
            ,'MOCR??IA'=>''
            ,'MOLECA'=>''
            ,'MOLEQUE'=>''
            ,'MONDRONGA'=>''
            ,'MONDRONGO'=>''
            ,'NABA'=>''
            ,'NADEGA'=>''
            ,'NOJEIRA'=>''
            ,'NOJENTA'=>''
            ,'NOJENTO'=>''
            ,'NOJO'=>''
            ,'OLHOTA'=>''
            ,'OTARIA'=>''
            ,'OT??RIA'=>''
            ,'OTARIO'=>''
            ,'OT??RIO'=>''
            ,'PACA'=>''
            ,'PASPALHA'=>''
            ,'PASPALHAO'=>''
            ,'PASPALHO'=>''
            ,'PAU '=>''
            ,'PEIA'=>''
            ,'PEIDO'=>''
            ,'PEMBA'=>''
            ,'PENIS'=>''
            ,'P??NIS'=>''
            ,'PENTELHA'=>''
            ,'PENTELHO'=>''
            ,'PERERECA'=>''
            ,'PERU'=>''
            ,'PER??'=>''
            ,'PICA'=>''
            ,'PICAO'=>''
            ,'PIC??O'=>''
            ,'PILANTRA'=>''
            ,'PIRANHA'=>''
            ,'PIROCA'=>''
            ,'PIROCO'=>''
            ,'PIRU'=>''
            ,'PORRA'=>''
            ,'PREGA'=>''
            ,'PROSTIBULO'=>''
            ,'PROST??BULO'=>''
            ,'PROSTITUTA'=>''
            ,'PROSTITUTO'=>''
            ,'PUNHETA'=>''
            ,'PUNHETAO'=>''
            ,'PUNHET??O'=>''
            ,'PUS'=>''
            ,'PUSTULA'=>''
            ,'P??STULA'=>''
            ,'PUTA'=>''
            ,'PUTO'=>''
            ,'PUXA-SACO'=>''
            ,'PUXASACO'=>''
            ,'RABAO'=>''
            ,'RAB??O'=>''
            ,'RABO'=>''
            ,'RABUDA'=>''
            ,'RABUDAO'=>''
            ,'RABUD??O'=>''
            ,'RABUDO'=>''
            ,'RABUDONA'=>''
            ,'RACHA'=>''
            ,'RACHADA'=>''
            ,'RACHADAO'=>''
            ,'RACHAD??O'=>''
            ,'RACHADINHA'=>''
            ,'RACHADINHO'=>''
            ,'RACHADO'=>''
            ,'RAMELA'=>''
            ,'REMELA'=>''
            ,'RETARDADA'=>''
            ,'RETARDADO'=>''
            ,'RIDICULA'=>''
            ,'RID??CULA'=>''
            ,'ROLA'=>''
            ,'ROLINHA'=>''
            ,'ROSCA'=>''
            ,'SACANA'=>''
            ,'SAFADA'=>''
            ,'SAFADO'=>''
            ,'SAPATAO'=>''
            ,'SAPAT??O'=>''
            ,'SIFILIS'=>''
            ,'S??FILIS'=>''
            ,'SIRIRICA'=>''
            ,'TARADA'=>''
            ,'TARADO'=>''
            ,'TESTUDA'=>''
            ,'TEZAO'=>''
            ,'TEZ??O'=>''
            ,'TEZUDA'=>''
            ,'TEZUDO'=>''
            ,'TROCHA'=>''
            ,'TROLHA'=>''
            ,'TROUCHA'=>''
            ,'TROUXA'=>''
            ,'TROXA'=>''
            ,'VACA'=>''
            ,'VAGABUNDA'=>''
            ,'VAGABUNDO'=>''
            ,'VAGINA'=>''
            ,'VEADA'=>''
            ,'VEADAO'=>''
            ,'VEAD??O'=>''
            ,'VEADO'=>''
            ,'VIADA'=>''
            ,'VIADO'=>''
            ,'VIADAO'=>''
            ,'VIAD??O'=>''
            ,'XAVASCA'=>''
            ,'XERERECA'=>''
            ,'XEXECA'=>''
            ,'XIBIU'=>''
            ,'XIBUMBA'=>''
            ,'XOTA'=>''
            ,'XOCHOTA'=>''
            ,'XOXOTA'=>''
            ,'XANA'=>''
            ,'XANINHA'=>''
        ));
        
    }
    
    function slug($v){
    	$v = $this->toAscii($v);
    	$v = $this->lower(trim($v));
		$v = preg_replace('/[^a-z0-9_-]/', '-', $v);
		$v = preg_replace('/-+/', "-", $v);
		return rtrim($v, '-');
    }
    
    function slug_postgresql_column_name($v){
    	$v = $this->toAscii($v);
    	$v = $this->lower(trim($v));
		$v = preg_replace('/[^a-z0-9_]/', '_', $v);
		return substr(rtrim($v, '_'),0,50);
    }
    
    function clean_html($v, $exceptions_tags = []){
    	/*
    	You might wonder why trim(html_entity_decode('&nbsp;')); doesn't reduce the string to an empty string, that's because the '&nbsp;' entity is not ASCII code 32 (which is stripped by trim()) but ASCII code 160 (0xa0) in the default ISO 8859-1 encoding.
    	*/
    	return html_entity_decode(strip_tags($v,implode("",$exceptions_tags)));
    }
    
    /**
     * 
     * Convert the record_action value standard ('I','U','D' to the i_status value standard ('S', 'D')
     * Anyting different from the record_action value standard will return 'D'
     * Example:
     * record_action2i_status('I') = 'S'
     * record_action2i_status('U') = 'S'
     * record_action2i_status('D') = 'D'
     * record_action2i_status(X) = 'D'
     * 
     */ 
    function record_action2i_status( $record_action ){
        if ($record_action === 'I' || $record_action === 'U'){
            $i_status = 'S';
        }
        else {
            $i_status = 'D';
        }
        return $i_status;
    }
    
    function ___mask($val, $mask){
		$masked = '';
		$k = 0;
		$len = strlen($mask)-1;
		//Convert string to array
		$vals = str_split($val);
		for($i = 0; $i<=$len; $i++) {
			if($mask[$i] == '#'){
				if($vals){
					$masked .= array_shift($vals);
				}
			} else if(isset($mask[$i])){
				$masked .= $mask[$i];
				if($mask[$i] === " " && $vals[0] === " "){
					array_shift($vals);
				}
			}
		}
		return $masked;
	}
    
    function cpf($number){
    	return $this->___mask($number,'###.###.###-##');
    }
    
    function cep($number){
    	return $this->___mask($number,'#####-###');
    }
    
    function cnpj($number){
    	return $this->___mask($number,'##.###.###/####-##');
    }
    
    function datehour($number){
    	switch(strlen($number)){
    		case 4:
    			return $this->___mask($number,'##:##');

    		case 8:
    			return $this->___mask($number,'####-##-##');

    		case 12:
    		case 13:
    			return $this->___mask($number,'####-##-## ##:##');
    			
    		case 14:
			case 15:
    			return $this->___mask($number,'####-##-## ##:##:##');
    	}
    	return $number;
    }
    
    function camelCase2snake_case($input){
		return $this->lower(preg_replace(['/([a-z\d])([A-Z])/', '/([^_])([A-Z][a-z])/'], '$1_$2', $input));
    }
    
    function monthEnglish2number($month_english){
    	$month = [
    		"jan"=>"01"
    		,"january"=>"01"
    		,"feb"=>"02"
    		,"february"=>"02"
    		,"mar"=>"03"
    		,"march"=>"03"
    		,"apr"=>"04"
    		,"april"=>"04"
    		,"may"=>"05"
    		,"jun"=>"06"
    		,"june"=>"06"
    		,"jul"=>"07"
    		,"july"=>"07"
    		,"aug"=>"08"
    		,"august"=>"08"
    		,"sep"=>"09"
    		,"september"=>"09"
    		,"oct"=>"10"
    		,"october"=>"10"
    		,"nov"=>"11"
    		,"november"=>"11"
    		,"dec"=>"12"
    		,"december"=>"12"
    	];
    	return $month[$this->lower($month_english)];
    }
    
    function monthPtBR2number($month_ptbr){
    	$month = [
    		"jan"=>"01"
    		,"janeiro"=>"01"
    		,"fev"=>"02"
    		,"fevereiro"=>"02"
    		,"mar"=>"03"
    		,"mar??o"=>"03"
    		,"abr"=>"04"
    		,"abril"=>"04"
    		,"mai"=>"05"
    		,"maio"=>"05"
    		,"jun"=>"06"
    		,"junho"=>"06"
    		,"jul"=>"07"
    		,"julho"=>"07"
    		,"ago"=>"08"
    		,"agosto"=>"08"
    		,"set"=>"09"
    		,"setembro"=>"09"
    		,"out"=>"10"
    		,"outubro"=>"10"
    		,"nov"=>"11"
    		,"novembro"=>"11"
    		,"dez"=>"12"
    		,"dezembro"=>"12"
    	];
    	return $month[$this->lower($month_ptbr)];
    }
    
    
    function between_str($v,$begin,$end){
    	$len = strlen($v);
    	$len_begin = strlen($begin);
    	$len_end = strlen($end);
    	$pos_begin = 0;
    	$pos_end = 0;
    	$found_begin = false;
    	$between_text = '';
    	for($pos=0; $pos<$len;$pos++){
    		while(
    			!$found_begin
    			&&
    			$v[$pos] == $begin[$pos_begin]
    		){
    			if($pos_begin == $len_begin-1){
    				$found_begin = true;
    				continue 2;
    			}
    			$pos++;
    			$pos_begin++;
    		}

			if(!$found_begin){
				continue;
			}

			$buffer_txt = $v[$pos];

    		while(
    			$found_begin
    			&&
    			$v[$pos] == $end[$pos_end]
    		){
    			if($pos_end == $len_end-1){
    				return $between_text;
    			}
    			
    			$pos++;
    			$pos_end++;
    			
    			$buffer_txt .= $v[$pos];
    		}
    		$pos_end = 0;
			$between_text .= $buffer_txt;
    	}
    	
    	return null;
    }
    
    
    function ensure_left($v,$prefix){
    	if(strpos($v,$prefix) === 0){
    		return $v;
    	}
    	
    	return $prefix.$v;
    }
    
    function ensure_right($v,$sufix){
    	if(strrpos($v,$sufix) === strlen($v)-strlen($sufix)){
    		return $v;
    	}
    	
    	return $v.$sufix;
    }
    
    function initials($v){
    	$part_v = preg_split("/\s+/",$v);
    	$initials = "";
    	foreach($part_v as $part){
    		$initials .= $part[0];
    	}
    	return $initials;
    }
}
