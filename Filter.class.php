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
            'Š'=>'S', 'š'=>'s'
            ,'Đ'=>'Dj', 'đ'=>'dj'
            ,'Ž'=>'Z', 'ž'=>'z'
            ,'Č'=>'C', 'č'=>'c', 'Ć'=>'C', 'ć'=>'c'
            ,'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A'
            ,'Ç'=>'C'
            ,'È'=>'E', 'É'=>'E','Ê'=>'E', 'Ë'=>'E'
            ,'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I'
            ,'Ñ'=>'N'
            ,'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O','Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O'
            ,'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', "Ũ"=>"U","Ü"=>"U"
            ,'Ý'=>'Y'
            ,'Ŕ'=>'R'
            ,'Þ'=>'B', 'ß'=>'Ss'
            ,'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a'
            ,'ç'=>'c'
	    	,'è'=>'e', 'é'=>'e','ê'=>'e', 'ë'=>'e'
 	    	,'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i'
            ,'ð'=>'o', 'ò'=>'o', 'ó'=>'o','ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o'
            ,'ñ'=>'n'
            ,'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ũ'=>'u',"ü"=>"u"
            ,'ý'=>'y', 'þ'=>'b','ÿ'=>'y'
            ,'ŕ'=>'r',
        );
/*
$a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ'); 
$b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
*/
/*
 //accent-folding function
    var accentMap = {
        'ẚ': 'a',
        'Á': 'a',
        'á': 'a',
        'À': 'a',
        'à': 'a',
        'Ă': 'a',
        'ă': 'a',
        'Ắ': 'a',
        'ắ': 'a',
        'Ằ': 'a',
        'ằ': 'a',
        'Ẵ': 'a',
        'ẵ': 'a',
        'Ẳ': 'a',
        'ẳ': 'a',
        'Â': 'a',
        'â': 'a',
        'Ấ': 'a',
        'ấ': 'a',
        'Ầ': 'a',
        'ầ': 'a',
        'Ẫ': 'a',
        'ẫ': 'a',
        'Ẩ': 'a',
        'ẩ': 'a',
        'Ǎ': 'a',
        'ǎ': 'a',
        'Å': 'a',
        'å': 'a',
        'Ǻ': 'a',
        'ǻ': 'a',
        'Ä': 'a',
        'ä': 'a',
        'Ǟ': 'a',
        'ǟ': 'a',
        'Ã': 'a',
        'ã': 'a',
        'Ȧ': 'a',
        'ȧ': 'a',
        'Ǡ': 'a',
        'ǡ': 'a',
        'Ą': 'a',
        'ą': 'a',
        'Ā': 'a',
        'ā': 'a',
        'Ả': 'a',
        'ả': 'a',
        'Ȁ': 'a',
        'ȁ': 'a',
        'Ȃ': 'a',
        'ȃ': 'a',
        'Ạ': 'a',
        'ạ': 'a',
        'Ặ': 'a',
        'ặ': 'a',
        'Ậ': 'a',
        'ậ': 'a',
        'Ḁ': 'a',
        'ḁ': 'a',
        'Ⱥ': 'a',
        'ⱥ': 'a',
        'Ǽ': 'a',
        'ǽ': 'a',
        'Ǣ': 'a',
        'ǣ': 'a',
        'Ḃ': 'b',
        'ḃ': 'b',
        'Ḅ': 'b',
        'ḅ': 'b',
        'Ḇ': 'b',
        'ḇ': 'b',
        'Ƀ': 'b',
        'ƀ': 'b',
        'ᵬ': 'b',
        'Ɓ': 'b',
        'ɓ': 'b',
        'Ƃ': 'b',
        'ƃ': 'b',
        'Ć': 'c',
        'ć': 'c',
        'Ĉ': 'c',
        'ĉ': 'c',
        'Č': 'c',
        'č': 'c',
        'Ċ': 'c',
        'ċ': 'c',
        'Ç': 'c',
        'ç': 'c',
        'Ḉ': 'c',
        'ḉ': 'c',
        'Ȼ': 'c',
        'ȼ': 'c',
        'Ƈ': 'c',
        'ƈ': 'c',
        'ɕ': 'c',
        'Ď': 'd',
        'ď': 'd',
        'Ḋ': 'd',
        'ḋ': 'd',
        'Ḑ': 'd',
        'ḑ': 'd',
        'Ḍ': 'd',
        'ḍ': 'd',
        'Ḓ': 'd',
        'ḓ': 'd',
        'Ḏ': 'd',
        'ḏ': 'd',
        'Đ': 'd',
        'đ': 'd',
        'ᵭ': 'd',
        'Ɖ': 'd',
        'ɖ': 'd',
        'Ɗ': 'd',
        'ɗ': 'd',
        'Ƌ': 'd',
        'ƌ': 'd',
        'ȡ': 'd',
        'ð': 'd',
        'É': 'e',
        'Ə': 'e',
        'Ǝ': 'e',
        'ǝ': 'e',
        'é': 'e',
        'È': 'e',
        'è': 'e',
        'Ĕ': 'e',
        'ĕ': 'e',
        'Ê': 'e',
        'ê': 'e',
        'Ế': 'e',
        'ế': 'e',
        'Ề': 'e',
        'ề': 'e',
        'Ễ': 'e',
        'ễ': 'e',
        'Ể': 'e',
        'ể': 'e',
        'Ě': 'e',
        'ě': 'e',
        'Ë': 'e',
        'ë': 'e',
        'Ẽ': 'e',
        'ẽ': 'e',
        'Ė': 'e',
        'ė': 'e',
        'Ȩ': 'e',
        'ȩ': 'e',
        'Ḝ': 'e',
        'ḝ': 'e',
        'Ę': 'e',
        'ę': 'e',
        'Ē': 'e',
        'ē': 'e',
        'Ḗ': 'e',
        'ḗ': 'e',
        'Ḕ': 'e',
        'ḕ': 'e',
        'Ẻ': 'e',
        'ẻ': 'e',
        'Ȅ': 'e',
        'ȅ': 'e',
        'Ȇ': 'e',
        'ȇ': 'e',
        'Ẹ': 'e',
        'ẹ': 'e',
        'Ệ': 'e',
        'ệ': 'e',
        'Ḙ': 'e',
        'ḙ': 'e',
        'Ḛ': 'e',
        'ḛ': 'e',
        'Ɇ': 'e',
        'ɇ': 'e',
        'ɚ': 'e',
        'ɝ': 'e',
        'Ḟ': 'f',
        'ḟ': 'f',
        'ᵮ': 'f',
        'Ƒ': 'f',
        'ƒ': 'f',
        'Ǵ': 'g',
        'ǵ': 'g',
        'Ğ': 'g',
        'ğ': 'g',
        'Ĝ': 'g',
        'ĝ': 'g',
        'Ǧ': 'g',
        'ǧ': 'g',
        'Ġ': 'g',
        'ġ': 'g',
        'Ģ': 'g',
        'ģ': 'g',
        'Ḡ': 'g',
        'ḡ': 'g',
        'Ǥ': 'g',
        'ǥ': 'g',
        'Ɠ': 'g',
        'ɠ': 'g',
        'Ĥ': 'h',
        'ĥ': 'h',
        'Ȟ': 'h',
        'ȟ': 'h',
        'Ḧ': 'h',
        'ḧ': 'h',
        'Ḣ': 'h',
        'ḣ': 'h',
        'Ḩ': 'h',
        'ḩ': 'h',
        'Ḥ': 'h',
        'ḥ': 'h',
        'Ḫ': 'h',
        'ḫ': 'h',
        'H': 'h',
        '̱': 'h',
        'ẖ': 'h',
        'Ħ': 'h',
        'ħ': 'h',
        'Ⱨ': 'h',
        'ⱨ': 'h',
        'Í': 'i',
        'í': 'i',
        'Ì': 'i',
        'ì': 'i',
        'Ĭ': 'i',
        'ĭ': 'i',
        'Î': 'i',
        'î': 'i',
        'Ǐ': 'i',
        'ǐ': 'i',
        'Ï': 'i',
        'ï': 'i',
        'Ḯ': 'i',
        'ḯ': 'i',
        'Ĩ': 'i',
        'ĩ': 'i',
        'İ': 'i',
        'i': 'i',
        'Į': 'i',
        'į': 'i',
        'Ī': 'i',
        'ī': 'i',
        'Ỉ': 'i',
        'ỉ': 'i',
        'Ȉ': 'i',
        'ȉ': 'i',
        'Ȋ': 'i',
        'ȋ': 'i',
        'Ị': 'i',
        'ị': 'i',
        'Ḭ': 'i',
        'ḭ': 'i',
        'I': 'i',
        'ı': 'i',
        'Ɨ': 'i',
        'ɨ': 'i',
        'Ĵ': 'j',
        'ĵ': 'j',
        'J': 'j',
        '̌': 'j',
        'ǰ': 'j',
        'ȷ': 'j',
        'Ɉ': 'j',
        'ɉ': 'j',
        'ʝ': 'j',
        'ɟ': 'j',
        'ʄ': 'j',
        'Ḱ': 'k',
        'ḱ': 'k',
        'Ǩ': 'k',
        'ǩ': 'k',
        'Ķ': 'k',
        'ķ': 'k',
        'Ḳ': 'k',
        'ḳ': 'k',
        'Ḵ': 'k',
        'ḵ': 'k',
        'Ƙ': 'k',
        'ƙ': 'k',
        'Ⱪ': 'k',
        'ⱪ': 'k',
        'Ĺ': 'a',
        'ĺ': 'l',
        'Ľ': 'l',
        'ľ': 'l',
        'Ļ': 'l',
        'ļ': 'l',
        'Ḷ': 'l',
        'ḷ': 'l',
        'Ḹ': 'l',
        'ḹ': 'l',
        'Ḽ': 'l',
        'ḽ': 'l',
        'Ḻ': 'l',
        'ḻ': 'l',
        'Ł': 'l',
        'ł': 'l',
        'Ł': 'l',
        '̣': 'l',
        'ł': 'l',
        '̣': 'l',
        'Ŀ': 'l',
        'ŀ': 'l',
        'Ƚ': 'l',
        'ƚ': 'l',
        'Ⱡ': 'l',
        'ⱡ': 'l',
        'Ɫ': 'l',
        'ɫ': 'l',
        'ɬ': 'l',
        'ɭ': 'l',
        'ȴ': 'l',
        'Ḿ': 'm',
        'ḿ': 'm',
        'Ṁ': 'm',
        'ṁ': 'm',
        'Ṃ': 'm',
        'ṃ': 'm',
        'ɱ': 'm',
        'Ń': 'n',
        'ń': 'n',
        'Ǹ': 'n',
        'ǹ': 'n',
        'Ň': 'n',
        'ň': 'n',
        'Ñ': 'n',
        'ñ': 'n',
        'Ṅ': 'n',
        'ṅ': 'n',
        'Ņ': 'n',
        'ņ': 'n',
        'Ṇ': 'n',
        'ṇ': 'n',
        'Ṋ': 'n',
        'ṋ': 'n',
        'Ṉ': 'n',
        'ṉ': 'n',
        'Ɲ': 'n',
        'ɲ': 'n',
        'Ƞ': 'n',
        'ƞ': 'n',
        'ɳ': 'n',
        'ȵ': 'n',
        'N': 'n',
        '̈': 'n',
        'n': 'n',
        '̈': 'n',
        'Ó': 'o',
        'ó': 'o',
        'Ò': 'o',
        'ò': 'o',
        'Ŏ': 'o',
        'ŏ': 'o',
        'Ô': 'o',
        'ô': 'o',
        'Ố': 'o',
        'ố': 'o',
        'Ồ': 'o',
        'ồ': 'o',
        'Ỗ': 'o',
        'ỗ': 'o',
        'Ổ': 'o',
        'ổ': 'o',
        'Ǒ': 'o',
        'ǒ': 'o',
        'Ö': 'o',
        'ö': 'o',
        'Ȫ': 'o',
        'ȫ': 'o',
        'Ő': 'o',
        'ő': 'o',
        'Õ': 'o',
        'õ': 'o',
        'Ṍ': 'o',
        'ṍ': 'o',
        'Ṏ': 'o',
        'ṏ': 'o',
        'Ȭ': 'o',
        'ȭ': 'o',
        'Ȯ': 'o',
        'ȯ': 'o',
        'Ȱ': 'o',
        'ȱ': 'o',
        'Ø': 'o',
        'ø': 'o',
        'Ǿ': 'o',
        'ǿ': 'o',
        'Ǫ': 'o',
        'ǫ': 'o',
        'Ǭ': 'o',
        'ǭ': 'o',
        'Ō': 'o',
        'ō': 'o',
        'Ṓ': 'o',
        'ṓ': 'o',
        'Ṑ': 'o',
        'ṑ': 'o',
        'Ỏ': 'o',
        'ỏ': 'o',
        'Ȍ': 'o',
        'ȍ': 'o',
        'Ȏ': 'o',
        'ȏ': 'o',
        'Ơ': 'o',
        'ơ': 'o',
        'Ớ': 'o',
        'ớ': 'o',
        'Ờ': 'o',
        'ờ': 'o',
        'Ỡ': 'o',
        'ỡ': 'o',
        'Ở': 'o',
        'ở': 'o',
        'Ợ': 'o',
        'ợ': 'o',
        'Ọ': 'o',
        'ọ': 'o',
        'Ộ': 'o',
        'ộ': 'o',
        'Ɵ': 'o',
        'ɵ': 'o',
        'Ṕ': 'p',
        'ṕ': 'p',
        'Ṗ': 'p',
        'ṗ': 'p',
        'Ᵽ': 'p',
        'Ƥ': 'p',
        'ƥ': 'p',
        'P': 'p',
        '̃': 'p',
        'p': 'p',
        '̃': 'p',
        'ʠ': 'q',
        'Ɋ': 'q',
        'ɋ': 'q',
        'Ŕ': 'r',
        'ŕ': 'r',
        'Ř': 'r',
        'ř': 'r',
        'Ṙ': 'r',
        'ṙ': 'r',
        'Ŗ': 'r',
        'ŗ': 'r',
        'Ȑ': 'r',
        'ȑ': 'r',
        'Ȓ': 'r',
        'ȓ': 'r',
        'Ṛ': 'r',
        'ṛ': 'r',
        'Ṝ': 'r',
        'ṝ': 'r',
        'Ṟ': 'r',
        'ṟ': 'r',
        'Ɍ': 'r',
        'ɍ': 'r',
        'ᵲ': 'r',
        'ɼ': 'r',
        'Ɽ': 'r',
        'ɽ': 'r',
        'ɾ': 'r',
        'ᵳ': 'r',
        'ß': 's',
        'Ś': 's',
        'ś': 's',
        'Ṥ': 's',
        'ṥ': 's',
        'Ŝ': 's',
        'ŝ': 's',
        'Š': 's',
        'š': 's',
        'Ṧ': 's',
        'ṧ': 's',
        'Ṡ': 's',
        'ṡ': 's',
        'ẛ': 's',
        'Ş': 's',
        'ş': 's',
        'Ṣ': 's',
        'ṣ': 's',
        'Ṩ': 's',
        'ṩ': 's',
        'Ș': 's',
        'ș': 's',
        'ʂ': 's',
        'S': 's',
        '̩': 's',
        's': 's',
        '̩': 's',
        'Þ': 't',
        'þ': 't',
        'Ť': 't',
        'ť': 't',
        'T': 't',
        '̈': 't',
        'ẗ': 't',
        'Ṫ': 't',
        'ṫ': 't',
        'Ţ': 't',
        'ţ': 't',
        'Ṭ': 't',
        'ṭ': 't',
        'Ț': 't',
        'ț': 't',
        'Ṱ': 't',
        'ṱ': 't',
        'Ṯ': 't',
        'ṯ': 't',
        'Ŧ': 't',
        'ŧ': 't',
        'Ⱦ': 't',
        'ⱦ': 't',
        'ᵵ': 't',
        'ƫ': 't',
        'Ƭ': 't',
        'ƭ': 't',
        'Ʈ': 't',
        'ʈ': 't',
        'ȶ': 't',
        'Ú': 'u',
        'ú': 'u',
        'Ù': 'u',
        'ù': 'u',
        'Ŭ': 'u',
        'ŭ': 'u',
        'Û': 'u',
        'û': 'u',
        'Ǔ': 'u',
        'ǔ': 'u',
        'Ů': 'u',
        'ů': 'u',
        'Ü': 'u',
        'ü': 'u',
        'Ǘ': 'u',
        'ǘ': 'u',
        'Ǜ': 'u',
        'ǜ': 'u',
        'Ǚ': 'u',
        'ǚ': 'u',
        'Ǖ': 'u',
        'ǖ': 'u',
        'Ű': 'u',
        'ű': 'u',
        'Ũ': 'u',
        'ũ': 'u',
        'Ṹ': 'u',
        'ṹ': 'u',
        'Ų': 'u',
        'ų': 'u',
        'Ū': 'u',
        'ū': 'u',
        'Ṻ': 'u',
        'ṻ': 'u',
        'Ủ': 'u',
        'ủ': 'u',
        'Ȕ': 'u',
        'ȕ': 'u',
        'Ȗ': 'u',
        'ȗ': 'u',
        'Ư': 'u',
        'ư': 'u',
        'Ứ': 'u',
        'ứ': 'u',
        'Ừ': 'u',
        'ừ': 'u',
        'Ữ': 'u',
        'ữ': 'u',
        'Ử': 'u',
        'ử': 'u',
        'Ự': 'u',
        'ự': 'u',
        'Ụ': 'u',
        'ụ': 'u',
        'Ṳ': 'u',
        'ṳ': 'u',
        'Ṷ': 'u',
        'ṷ': 'u',
        'Ṵ': 'u',
        'ṵ': 'u',
        'Ʉ': 'u',
        'ʉ': 'u',
        'Ṽ': 'v',
        'ṽ': 'v',
        'Ṿ': 'v',
        'ṿ': 'v',
        'Ʋ': 'v',
        'ʋ': 'v',
        'Ẃ': 'w',
        'ẃ': 'w',
        'Ẁ': 'w',
        'ẁ': 'w',
        'Ŵ': 'w',
        'ŵ': 'w',
        'W': 'w',
        '̊': 'w',
        'ẘ': 'w',
        'Ẅ': 'w',
        'ẅ': 'w',
        'Ẇ': 'w',
        'ẇ': 'w',
        'Ẉ': 'w',
        'ẉ': 'w',
        'Ẍ': 'x',
        'ẍ': 'x',
        'Ẋ': 'x',
        'ẋ': 'x',
        'Ý': 'y',
        'ý': 'y',
        'Ỳ': 'y',
        'ỳ': 'y',
        'Ŷ': 'y',
        'ŷ': 'y',
        'Y': 'y',
        '̊': 'y',
        'ẙ': 'y',
        'Ÿ': 'y',
        'ÿ': 'y',
        'Ỹ': 'y',
        'ỹ': 'y',
        'Ẏ': 'y',
        'ẏ': 'y',
        'Ȳ': 'y',
        'ȳ': 'y',
        'Ỷ': 'y',
        'ỷ': 'y',
        'Ỵ': 'y',
        'ỵ': 'y',
        'ʏ': 'y',
        'Ɏ': 'y',
        'ɏ': 'y',
        'Ƴ': 'y',
        'ƴ': 'y',
        'Ź': 'z',
        'ź': 'z',
        'Ẑ': 'z',
        'ẑ': 'z',
        'Ž': 'z',
        'ž': 'z',
        'Ż': 'z',
        'ż': 'z',
        'Ẓ': 'z',
        'ẓ': 'z',
        'Ẕ': 'z',
        'ẕ': 'z',
        'Ƶ': 'z',
        'ƶ': 'z',
        'Ȥ': 'z',
        'ȥ': 'z',
        'ʐ': 'z',
        'ʑ': 'z',
        'Ⱬ': 'z',
        'ⱬ': 'z',
        'Ǯ': 'z',
        'ǯ': 'z',
        'ƺ': 'z',

        // Roman fullwidth ascii equivalents: 0xff00 to 0xff5e
        '２': '2',
        '６': '6',
        'Ｂ': 'B',
        'Ｆ': 'F',
        'Ｊ': 'J',
        'Ｎ': 'N',
        'Ｒ': 'R',
        'Ｖ': 'V',
        'Ｚ': 'Z',
        'ｂ': 'b',
        'ｆ': 'f',
        'ｊ': 'j',
        'ｎ': 'n',
        'ｒ': 'r',
        'ｖ': 'v',
        'ｚ': 'z',
        '１': '1',
        '５': '5',
        '９': '9',
        'Ａ': 'A',
        'Ｅ': 'E',
        'Ｉ': 'I',
        'Ｍ': 'M',
        'Ｑ': 'Q',
        'Ｕ': 'U',
        'Ｙ': 'Y',
        'ａ': 'a',
        'ｅ': 'e',
        'ｉ': 'i',
        'ｍ': 'm',
        'ｑ': 'q',
        'ｕ': 'u',
        'ｙ': 'y',
        '０': '0',
        '４': '4',
        '８': '8',
        'Ｄ': 'D',
        'Ｈ': 'H',
        'Ｌ': 'L',
        'Ｐ': 'P',
        'Ｔ': 'T',
        'Ｘ': 'X',
        'ｄ': 'd',
        'ｈ': 'h',
        'ｌ': 'l',
        'ｐ': 'p',
        'ｔ': 't',
        'ｘ': 'x',
        '３': '3',
        '７': '7',
        'Ｃ': 'C',
        'Ｇ': 'G',
        'Ｋ': 'K',
        'Ｏ': 'O',
        'Ｓ': 'S',
        'Ｗ': 'W',
        'ｃ': 'c',
        'ｇ': 'g',
        'ｋ': 'k',
        'ｏ': 'o',
        'ｓ': 's',
        'ｗ': 'w'
    };
    */

        return strtr( $v, $chars );
    }
    
    function charsetError2UTF8 ( $v ){
	    $chars = array(
        	''=>'Á'
			,''=>'é', ''=>'ê'
			,'¡'=>'í'
			,'ä'=>'õ', '¢'=>'ó', 'ø'=>'º',''=>'ô'
			,'£'=>'ú'
        );

        return strtr( $v, $chars );
    }
    
    
    
    function charsetError2Ascii ( $v ){
        return $this->toAscii($this->charsetError2UTF8($v));
    	
    }

    function trim( $v ){
        $v = $this->_default( $v, "" );
        //Attention. It is not empty for empty. It is an utf8 special blank char
        $v = str_replace(" "," ",$v);
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
            ,'ÂNUS'=>''
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
            ,'BOCÓ'=>''
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
            ,'CLITÓRIS'=>''
            ,'COCAINA'=>''
            ,'COCAÍNA'=>''
            ,'COCÔ'=>''
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
            ,'CÚ'=>''
            ,'CULHAO'=>''
            ,'CULHÃO'=>''
            ,'CULHÕES'=>''
            ,'CURALHO'=>''
            ,'CUZAO'=>''
            ,'CUZÃO'=>''
            ,'CUZUDA'=>''
            ,'CUZUDO'=>''
            ,'DEBIL'=>''
            ,'DEBILOIDE'=>''
            ,'DEFUNTO'=>''
            ,'DEMONIO'=>''
            ,'DEMÔNIO'=>''
            ,'DIFUNTO'=>''
            ,'DOIDA'=>''
            ,'DOIDO'=>''
            ,'EGUA'=>''
            ,'ÁGUA'=>''
            ,'ESCROTA'=>''
            ,'ESCROTO'=>''
            ,'ESPORRADA'=>''
            ,'ESPORRADO'=>''
            ,'ESPORRO'=>''
            ,'ESPÔRRO'=>''
            ,'ESTUPIDA'=>''
            ,'ESTÚPIDA'=>''
            ,'ESTUPIDEZ'=>''
            ,'ESTUPIDO'=>''
            ,'ESTÚPIDO'=>''
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
            ,'FELAÇÃO'=>''
            ,'FENDA'=>''
            ,'FODA'=>''
            ,'FODAO'=>''
            ,'FODÃO'=>''
            ,'FODE'=>''
            ,'FODIDA'=>''
            ,'FODIDO'=>''
            ,'FORNICA'=>''
            ,'FUDENDO'=>''
            ,'FUDECAO'=>''
            ,'FUDEÇÃO'=>''
            ,'FUDIDA'=>''
            ,'FUDIDO'=>''
            ,'FURADA'=>''
            ,'FURADO'=>''
            ,'FURAO'=>''
            ,'FURÃO'=>''
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
            ,'LADRÃO'=>''
            ,'LADROEIRA'=>''
            ,'LADRONA'=>''
            ,'LALAU'=>''
            ,'LEPROSA'=>''
            ,'LEPROSO'=>''
            ,'LESBICA'=>''
            ,'LÁSBICA'=>''
            ,'MACACA'=>''
            ,'MACACO'=>''
            ,'MACHONA'=>''
            ,'MACHORRA'=>''
            ,'MANGUACA'=>''
            ,'MANGUAÇA'=>''
            ,'MASTURBA'=>''
            ,'MELECA'=>''
            ,'MERDA'=>''
            ,'MIJA'=>''
            ,'MIJADA'=>''
            ,'MIJADO'=>''
            ,'MIJO'=>''
            ,'MOCREA'=>''
            ,'MOCRÁA'=>''
            ,'MOCREIA'=>''
            ,'MOCRÁIA'=>''
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
            ,'OTÁRIA'=>''
            ,'OTARIO'=>''
            ,'OTÁRIO'=>''
            ,'PACA'=>''
            ,'PASPALHA'=>''
            ,'PASPALHAO'=>''
            ,'PASPALHO'=>''
            ,'PAU '=>''
            ,'PEIA'=>''
            ,'PEIDO'=>''
            ,'PEMBA'=>''
            ,'PENIS'=>''
            ,'PÊNIS'=>''
            ,'PENTELHA'=>''
            ,'PENTELHO'=>''
            ,'PERERECA'=>''
            ,'PERU'=>''
            ,'PERÚ'=>''
            ,'PICA'=>''
            ,'PICAO'=>''
            ,'PICÃO'=>''
            ,'PILANTRA'=>''
            ,'PIRANHA'=>''
            ,'PIROCA'=>''
            ,'PIROCO'=>''
            ,'PIRU'=>''
            ,'PORRA'=>''
            ,'PREGA'=>''
            ,'PROSTIBULO'=>''
            ,'PROSTÍBULO'=>''
            ,'PROSTITUTA'=>''
            ,'PROSTITUTO'=>''
            ,'PUNHETA'=>''
            ,'PUNHETAO'=>''
            ,'PUNHETÃO'=>''
            ,'PUS'=>''
            ,'PUSTULA'=>''
            ,'PÚSTULA'=>''
            ,'PUTA'=>''
            ,'PUTO'=>''
            ,'PUXA-SACO'=>''
            ,'PUXASACO'=>''
            ,'RABAO'=>''
            ,'RABÃO'=>''
            ,'RABO'=>''
            ,'RABUDA'=>''
            ,'RABUDAO'=>''
            ,'RABUDÃO'=>''
            ,'RABUDO'=>''
            ,'RABUDONA'=>''
            ,'RACHA'=>''
            ,'RACHADA'=>''
            ,'RACHADAO'=>''
            ,'RACHADÃO'=>''
            ,'RACHADINHA'=>''
            ,'RACHADINHO'=>''
            ,'RACHADO'=>''
            ,'RAMELA'=>''
            ,'REMELA'=>''
            ,'RETARDADA'=>''
            ,'RETARDADO'=>''
            ,'RIDICULA'=>''
            ,'RIDÍCULA'=>''
            ,'ROLA'=>''
            ,'ROLINHA'=>''
            ,'ROSCA'=>''
            ,'SACANA'=>''
            ,'SAFADA'=>''
            ,'SAFADO'=>''
            ,'SAPATAO'=>''
            ,'SAPATÃO'=>''
            ,'SIFILIS'=>''
            ,'SÍFILIS'=>''
            ,'SIRIRICA'=>''
            ,'TARADA'=>''
            ,'TARADO'=>''
            ,'TESTUDA'=>''
            ,'TEZAO'=>''
            ,'TEZÃO'=>''
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
            ,'VEADÃO'=>''
            ,'VEADO'=>''
            ,'VIADA'=>''
            ,'VIADO'=>''
            ,'VIADAO'=>''
            ,'VIADÃO'=>''
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
    		,"março"=>"03"
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