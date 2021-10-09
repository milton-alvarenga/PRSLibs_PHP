<?php
namespace Drall\PRS\BASE;
use \Exception as Exception;

class Validation{

    /**
    * Function to test if variable required have value
    *
    * @param mixed $v Value to test
    * @return mixed Value tested, if success. Otherwise, raise an Exception
    */
    function required( $v ){
        if( is_array( $v ) || is_bool( $v ) ){
            $v = $v;
        } else if( is_int( $v ) ){
            return $v;
        } else if( is_string( $v ) || is_numeric( $v ) || is_object( $v ) ){
            $v = trim( (string)$v );
        } else {
            throw new Exception( "No input detected" );
        }
        //Empty accept "0" as empty, but it has value. So, treat it
        if ( empty( $v ) && $v !== "0" && $v !== false){
            throw new Exception( "Invalid value for required" );
        }
        return $v;
    }

    /**
    * Function test if variable have string value
    *
    * @param mixed $v Value to test. Should be string
    * @return string Value tested, if success. Otherwise, raise an Exception
    */
    function string( $v ){
        if( is_string( $v ) ){
            return $v;
        }
        throw new Exception( $v."  of type ".gettype($v)."  not a string" );
    }

    /**
    * Function test if variable have integer value
    *
    * @param mixed $v Value to test. Should be integer
    * @return integer Value tested, if success. Otherwise, raise an Exception
    */
    function int( $v ){
        if ( is_int( $v ) ){
            return $v;
        } else if( is_numeric( $v ) && is_int( (int)$v )){
            return (int)$v;
        }
        throw new Exception( $v." value of type ".gettype($v)." is not an integer" );
    }
    
    /**
    * Function test if variable have integer value
    *
    * @param mixed $v Value to test. Should be integer
    * @return integer Value tested, if success. Otherwise, raise an Exception
    */
    function integer( $v ){
    	return $this->int( $v );
    }
    
    /**
    * Function test if variable have boolean value
    *
    * @param mixed $v Value to test. Should be boolean
    * @return boolean Value tested, if success. Otherwise, raise an Exception
    */
    function boolean( $v ){
        if ( is_bool( $v ) ){
            return $v;
        }
        throw new Exception( $v."  of type ".gettype($v)."  not a boolean" );
    }
    
    /**
    * Function test if variable have boolean value
    *
    * @param mixed $v Value to test. Should be boolean
    * @return boolean Value tested, if success. Otherwise, raise an Exception
    */
    function bool( $v ){
    	return $this->boolean( $v );
    }
    
    /**
    * Function test if variable have acceptable convertable boolean value
    *
    * @param mixed $v Value to test. Should be boolean
    * @return boolean Value tested, if success. Otherwise, raise an Exception
    */
    function dboolean( $v ){
        if(in_array($v,["f","t","true","false","True","False",0,1,true,false],true)){
            return $v;
        }
        throw new Exception( $v."  of type ".gettype($v)."  not a acceptable convertable boolean value" );
    }

    /**
    * Function test if variable have numeric value
    *
    * @param mixed $v Value to test. Should be numeric
    * @return numeric Value tested, if success. Otherwise, raise an Exception
    */
    function numeric( $v ){
        if( is_numeric( $v ) ){
            return $v;
        }
        throw new Exception( $v."  of type ".gettype($v)."  not numeric" );
    }
    
    /**
    * Function test if variable have float value
    *
    * @param mixed $v Value to test. Should be float
    * @return float Value tested, if success. Otherwise, raise an Exception
    */
    function float( $v ){
        if ( is_float( $v ) ){
            return $v;
        } else if( is_numeric( $v ) && is_float( (float)$v )){
            return (float)$v;
        }
        throw new Exception( $v." value of type ".gettype($v)." is not a float" );
    }

    /**
    * Function test if variable have valid email value
    *
    * @param mixed $v Value to test. Should be string
    * @return string Value tested, if success. Otherwise, raise an Exception
    */
    function email( $v ){
        $v = filter_var( $v, FILTER_VALIDATE_EMAIL );
        
        if( $v ){
            return $v;
        }
        throw new Exception( "Invalid email value" );
    }


    /**
    * Function test if variable have valid url value. Protocol is required
    *
    * @param mixed $v Value to test. Should be string
    * @return string Value tested, if success. Otherwise, raise an Exception
    */
    function url( $v ){
        /*
        FILTER_FLAG_PATH_REQUIRED
        FILTER_FLAG_QUERY_REQUIRED
        */
        $v = filter_var( $v, FILTER_VALIDATE_URL );

        if( $v ){
            return $v;
        }
       throw new Exception( "Invalid url value" );

        //if( preg_match($v, '([a-zA-Z]{3,})://([\w-]+\.)+[\w-]+(/[\w- ./?%&=]*)?')){
        //    return $v;
        //}
        //throw new Exception("");
    }
    
    
    /**
    * Function test if variable have valid url value. Protocol is optional
    * The same behavior that url validation but, accept value with/without protocol
    *
    * @param mixed $v Value to test. Should be string
    * @return string Value tested, if success. Otherwise, raise an Exception
    */
    function durl( $v ){
        $_v = $v;
        
        //Do not accepts pure email as durl
        try{
            $this->email( $_v );
            $is_email = true;
        } catch( Exception $e ) {
            $is_email = false;
        }
        if($is_email){
            throw new Exception( "Invalid durl value. It is an email." );
        }

        
        if(! (stripos($v, 'http://') === 0 || stripos($v, 'https://') === 0) ){
           $_v = "http://".$_v ;
        }
        
        if(strpos($_v,".") === false){
            throw new Exception( "Invalid durl value" );
        }
        
        if(preg_match("/\..?$/",$_v) && preg_match("/\..+\/.+\..?$/", $_v) === 0){
            throw new Exception( "Invalid durl value" );
        }
        
        /*
        FILTER_FLAG_PATH_REQUIRED
        FILTER_FLAG_QUERY_REQUIRED
        */
        $_v = filter_var( $_v, FILTER_VALIDATE_URL );

        if( $_v ){
            return $v;
        }
       throw new Exception( "Invalid durl value" );

        //if( preg_match($v, '([a-zA-Z]{3,})://([\w-]+\.)+[\w-]+(/[\w- ./?%&=]*)?')){
        //    return $v;
        //}
        //throw new Exception("");
    }


    function domain( $v ){
        $domain = $v;
        if(stripos($v, 'http://') === 0 ){
            $v = substr($v, 7); 
        }
        
        if(stripos($v, 'https://') === 0 ){
            $v = substr($v, 8); 
        }
         
        ///Not even a single . this will eliminate things like abcd, since http://abcd is reported valid
        if(!substr_count($v, '.')){
            throw new Exception("Invalid domain value");
        }
         
        if(stripos($v, 'www.') === 0){
            $v = substr($v, 4); 
        }
        
        $again = 'http://' . $v;
        if(preg_match("/^http:\/\/([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/", $again)){
            return $domain;
        }
        
        throw new Exception("Invalid domain value");
    }

    /**
    * Function test if variable have valid ip value
    *
    * @param mixed $v Value to test. Should be string
    * @return string Value tested, if success. Otherwise, raise an Exception
    */
    function ip( $v, $version = "v4" ){
        /*
        FILTER_FLAG_IPV4
        FILTER_FLAG_IPV6
        FILTER_FLAG_NO_PRIV_RANGE
        */
        $v = filter_var( $v, FILTER_VALIDATE_IP );

        if( $v ){
            return $v;
        }
        throw new Exception( "" );
    }

    /**
    * Function test if variable have valid data value
    *
    * @param mixed $v Value to test. Should be date string on format 'YYYY-mm-dd'
    * @param string $format Format to test date
    * @return string Value tested, if success. Otherwise, raise an Exception
    */
    function date( $v ){
       list($yy,$mm,$dd)=explode("-",$v);
        if (is_numeric($yy) && is_numeric($mm) && is_numeric($dd))
        {
             if(checkdate($mm,$dd,$yy)){
                return $v;
             }
        }
        throw new Exception( $v." is an invalid date value.");
    }

    /**
    * Function test if variable have valid time value
    *
    * @param mixed $v Value to test. Should be time string on format '23:59:59','23:59'
    * @return string Value tested, if success. Otherwise, raise an Exception
    */
    function time( $v ){
        if(preg_match("/^([0-1][0-9]|[2][0-3])(:([0-5][0-9]))(:([0-5][0-9])){0,1}$/",$v)){
            return $v;
        }
        throw new Exception("");
    }

    /**
    * Function test if variable have valid dataTime value
    *
    * @param mixed $v Value to test. Should be date string on format 'YYYY-mm-dd 23:59:59', 'YYYY-mm-dd 23:59'
    * @return string Value tested, if success. Otherwise, raise an Exception
    */
    function datetime( $v ){
    	if(strpos($v," ") !== false){
        	list($date,$time)=explode(" ",$v);
    	} else {
    		list($date,$time)=explode("T",$v);
    	}
        list($yy,$mm,$dd)=explode("-", $date);

        if (is_numeric($yy) && is_numeric($mm) && is_numeric($dd))
        {
            if(checkdate($mm,$dd,$yy) && (preg_match("/^([0-1][0-9]|[2][0-3])(:([0-5][0-9]))(:([0-5][0-9])){0,1}$/",$time))){
                return $v;
            }
        }
        throw new Exception("");
    }

    /**
    * Function test if variable have valid data hour and timezone values
    *
    * @param mixed $v Value to test. Should be on format date hour.milissecond -Timezone'2013-06-28 17:06:30.123456-03'
    * @return string Value tested, if success. Otherwise, raise an Exception
    */
    function timestamp( $v ){
        list($date,$timestamp)=explode(" ",$v);
        list($yy,$mm,$dd)=explode("-", $date);
        $timestamp_tz = substr($timestamp,-3);
        list($hour)=explode("-", $timestamp);
        list($hour)=explode("+",$hour);

        if (strpos($hour,'.') !== false) {
            list($hour,$millisecond)=explode(".", $hour);
        }

        if (
    		is_numeric($yy)
    		&&
    		is_numeric($mm)
    		&&
    		is_numeric($dd)
    		&&
    		(
    			!isset($millisecond)
    			||
    			is_numeric($millisecond)
    		)
    		&&
    		checkdate($mm,$dd,$yy)
    		&&
    		preg_match("/^([0-1][0-9]|[2][0-3])(:([0-5][0-9]))(:([0-5][0-9])){1,2}$/",$hour)
    		&&
   			$timestamp_tz>=-12
   			&&
   			$timestamp_tz<=+12
        ){
        	return $v;
        }
        throw new Exception("");
    }

    /**
    * Function test if variable have valid Brazilian phone number
    *
    * @param mixed $v Value to test. Should be on phone number format 33843920
    * @return string Value tested, if success. Otherwise, raise an Exception
    */
    function phone( $v ){
        if( preg_match("/^\d+$/",$v) && ((strlen($v) == 8 ) || (strlen($v) == 9) || (strlen($v) == 10) || (strlen($v) == 11)))
        {
            return $v;
        }        
        throw new Exception("Invalid phone number");
    }
    
    /**
    * Function test if variable have valid creditcard date value
    *
    * @param mixed $v Value to test. Should be date string on format 'mm/YYYY'
    * @param string $format Format to test date
    * @return string Value tested, if success. Otherwise, raise an Exception
    */
    function creditcarddate( $v ){
        if (strlen($v) != 6 ) {
            throw new Exception( $v." has an invalid creditcard date size value.");
        }
        
        $mm = $v[0].$v[1];
        $yy = $v[2].$v[3].$v[4].$v[5];
        
        if (is_numeric($yy) && is_numeric($mm))
        {
            if(checkdate($mm, '01', $yy)){
                return $v;
            }
        }
        throw new Exception( $v." is an invalid creditcard date value.");
    }
    
    /**
    * Function test if variable have valid creditcard name value
    *
    * @param mixed $v Value to test. Should be name string on format Name Sobrenome
    * @param string $format Format to test name
    * @return string Value tested, if success. Otherwise, raise an Exception
    */
    function creditcard_name( $v ){
        if (strlen($v) < 3 ) {
            throw new Exception( $v." has an invalid creditcard name size value.");
        }
        
        if( preg_match("/^[A-Za-z0-9]+ [A-Za-z0-9 ]+$/",$v) ){
            return $v;
        }
        throw new Exception( $v." is an invalid creditcard name value.");
    }

    /**
    * Function test if variable have valid current brazilian zip code
    *
    * @param $v integer,string Number of size equal 8
    * @return string Value tested, if success. Otherwise, raise an Exception
    */
    function cep( $v ){
        if( is_numeric($v) && strlen($v) == 8)
        {
            return $v;
        }
        throw new Exception("CEP must be at least 8 numbers");
    }

    /**
    * Function test if variable have valid cpf code value
    *
    * @param $v integer value to test. 09175525631
    * @return string Value tested, if success. Otherwise, raise an Exception
    */
    function cpf( $v ){
        $v = str_pad(preg_replace('[^0-9]', '', $v), 11, '0', STR_PAD_LEFT);

        // Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
        if ($v == '00000000000' || $v == '11111111111' || $v == '22222222222' || $v == '33333333333' || $v == '44444444444' || $v == '55555555555' || $v == '66666666666' || $v == '77777777777' || $v == '88888888888' || $v == '99999999999')
        {
            throw new Exception("");
        }
        else
        {   // Calcula os números para verificar se o CPF é verdadeiro
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $v[$c] * (($t + 1) - $c);
                }
                
                $d = ((10 * $d) % 11) % 10;
                
                if ($v[$c] != $d) {
                    throw new Exception("Invalid CPF");
                }
            }
            return $v;
        }

    }

    /**
    * Function test if variable have valid cnpj code value
    *
    * @param $v value to test. Number of size equal 14
    * @return string Value tested, if success. Otherwise, raise an Exception
    */
    function cnpj( $v ){
        $v = str_pad(preg_replace('[^0-9]', '', str_replace(" ","",$v)), 14, '0', STR_PAD_LEFT);

        if ($v == '00000000000000') {
            throw new Exception("Invalid CNPJ");
        } else {
            for ($t = 12; $t < 14; $t++) {
                for ($d = 0, $p = $t - 7, $c = 0; $c < $t; $c++) {
                    $d += $v[$c] * $p;
                    $p   = ($p < 3) ? 9 : --$p;
                }

                $d = ((10 * $d) % 11) % 10;

                if ($v[$c] != $d) {
                    throw new Exception("Invalid CNPJ");
                }
            }
            return $v;
        }
    }
    
    /**
    * Function test if json have valid format
    *
    * @param $json value to test.
    * @return string $json tested, if success. Otherwise, raise an Exception
    */
    function json( $v ){
        if(!is_string($v)){
            throw new Exception("Invalid JSON. Value must to be a json string");
        }
        json_decode( $v );

        $json_error = null;
        switch(json_last_error()) {
                
            case JSON_ERROR_DEPTH:
                $json_error = "JSON_ERROR_DEPTH";
            case JSON_ERROR_STATE_MISMATCH:
                !$json_error && $json_error = "JSON_ERROR_STATE_MISMATCH";
            case JSON_ERROR_CTRL_CHAR:
                !$json_error && $json_error = "JSON_ERROR_CTRL_CHAR";
            case JSON_ERROR_SYNTAX:
                !$json_error && $json_error = "JSON_ERROR_SYNTAX";
            case JSON_ERROR_UTF8:
                !$json_error && $json_error = "JSON_ERROR_UTF8";
                throw new Exception("Invalid pattern. Validation.json must to be a valid json object".$json_error);
            break;
            case JSON_ERROR_NONE:
            default:
                return $v;
            break;
        }
    }

    /**
    * Function test if variable have valid length
    *
    * @param $v value to test.
    * @param $min minimum value for $v.
    * @param $max max value fot $v.
    * @return string Value tested, if success. Otherwise, raise an Exception
    */
    function length( $v, $min=null, $max=null ){
        if( is_string( $v ) || is_numeric( $v ) ){
            $size = strlen( trim ( (string)$v ) );
        } else if( is_array( $v ) ){
            $size = count( $v );
        } else {
            throw new Exception( "Invalid type to get length property." );
        }
        
        if(
            ( is_null($min) || ( is_numeric($min) && $size >= $min ) || ( $min === 'N' ) )
            &&
            ( is_null($max) || ( is_numeric($max) && $size <= $max ) || ( $max === 'N' ) )
        ){
            return $v;
        }
        
        throw new Exception( "Invalid length (".$size.")." );
    }

    /**
    * Function test if variable have valid length of words
    *
    * @param $v mixed value to test.
    * @param $minCount minimum words for $v.
    * @param $maxCount maximum words fot $v.
    * @param $minLength min length of each word in $v.
    * @param $maxLength max length of each word in $v.
    * @return string Value tested, if success. Otherwise, raise an Exception
    */
    function words( $v, $minCount=null, $maxCount=null, $minLength=null, $maxLength=null ){
        if( is_string( $v ) || is_numeric( $v ) || is_null( $v )){
            $v = trim( (string)$v );
            $words = explode(" ", $v);
        }
        else if ( is_array( $v ) ){
            $words = $v;
        }

        //Count total of words
        $len = count($words);

        //Does it have any word length limitation
        if( $minLength || $maxLength ){
            //Check words length
            for($x=0;$x<$len;$x++){
                //Check word and its length
                $this->length( $words[$x], $minLength, $maxLength );
            }
        }

        if(
            ( !$minCount || ( $minCount && $len >= $minCount) )
            &&
            ( !$maxCount || ( $maxCount && $len <= $maxCount ) )
        ){
            return $v;
        }
        throw new Exception("Invalid number of words");
    }

    /**
    * Function test if numeric variable is between range
    *
    * @param numeric $v Value to test
    * @param integer $min Min value accepted
    * @param integer $max Max value accepted
    * @return mixed Value tested, if success. Otherwise, raise an Exception
    */
    function range( $v, $min=null, $max=null){
        //if ( is_numeric ( $v ) && ( (!$min && !$max) || ( $min && $v >= $min) || ( $max && $v <= $max ) ) ){
        //    return $v;
        //}
        if( 
            is_numeric($v)
            &&
            (
                is_numeric($min)
                ||
                is_null($min)
            )
            &&
            (
                is_numeric($max)
                ||
                is_null($max)
            )
            &&
            (
                (
                    $min
                    &&
                    $v >= $min
                )
                ||
                !$min
            )
            &&
            (
                (
                    $max
                    &&
                    $v <= $max
                )
                ||
                !$max
            )
        ) {
            return $v;
        }
        throw new Exception( "Invalid range" );
    }

    /**
    * Function test if numeric variable have max value than $max
    *
    * @param numeric $v Value to test
    * @param integer $max Max value accepted
    * @return mixed Value tested, if success. Otherwise, raise an Exception
    */
    function max($v,$max){
        if(!is_numeric($max)){
            throw new Exception( "Invalid max" );
        }
        return $this->range($v,null,$max);
    }
    
        /**
    * Function test if numeric variable have max value than $min
    *
    * @param numeric $v Value to test
    * @param integer $min Min value accepted
    * @return mixed Value tested, if success. Otherwise, raise an Exception
    */
    function min($v,$min){
        if(!is_numeric($min)){
            throw new Exception( "Invalid min" );
        }
        return $this->range($v,$min,null);
    }

    /**
    * Function test if there variable value inside an array of options
    *
    * @param mixed $v Value to test. Should be string, integer or float.
    * @param array $aValidValues Valid acceptables values
    * @return mixed Value tested, if success. Otherwise, raise an Exception
    */
    function in( $v, $aValidValues = array() ){
        if ( in_array($v, $aValidValues, true) ){
            return $v;
        }
        
        if(is_numeric($v)){
            foreach($aValidValues as $value){
                if(!is_numeric($value)){
                    continue;
                }
                if($v == $value){
                    return $v;
                }
            }
        } else {
        	//Check if there is any regular expression on aValidValues
        	//to be checked
        	foreach($aValidValues as $value){
        		$is_regex = (
        			substr($value,0,1) == "/"
        			&&
	        		substr($value,-1) == "/"
	        	);
	        	
	        	if(!$is_regex){
	        		continue;
	        	}
	        	
	        	//$value is a pattern in $aValidValues
	        	//Validation:in(pattern,value,value,value,pattern)
	        	if(preg_match($value,$v)){
	        		return $v;
	        	}
        	}
        }
        
        throw new Exception( "Invalid value '".$v."' on Validation->in" );
    }

    //Nao precisa testar
    function regex( $v, $pattern ){
        if ( preg_match( $pattern, $v ) ){
            return $v;
        }
        throw new Exception( "" );
    }
    
    /**
    * Function test if there is not white space on string
    *
    * @param mixed $v Value to test. Should not have white space.
    * @return mixed Value tested, if success. Otherwise, raise an Exception
    */
    function no_white_space( $v ){
        if ( is_null($v) || strlen($v) == 0 || preg_match( "/\s/", $v )){
            throw new Exception( "" );
        }
        return $v;
    }
    
    /**
    * Function test if the value of $v is negative.
    *
    * @param mixed $v Value to test. Should be negative.
    * @return mixed Value tested, if success. Otherwise, raise an Exception
    */
    function negative( $v ){
        if( $v === 0 || $v < 0 ){
            return $v;
        }
        throw new Exception( $v." is not negative value" );
    }

    /**
    * Function test if the value of $v is positive.
    *
    * @param mixed $v Value to test. Should be positive.
    * @return mixed Value tested, if success. Otherwise, raise an Exception
    */
    function positive( $v ){
        if( $v === 0 || $v > 0 ){
            return $v;     
        }
        throw new Exception( $v." is not positive value" );
    }
    
    /**
    * Function test if the value of $v is boolean true.
    *
    * @param mixed $v Value to test. Should be boolean true.
    * @return mixed Value tested, if success. Otherwise, raise an Exception
    */
    function accepted( $v ){
    	if( $v === true ){
            return $v;     
        }
        throw new Exception( $v." is not a boolean true value" );
    }
    
    /**
    * Function test if the value of $v is boolean false.
    *
    * @param mixed $v Value to test. Should be boolean true.
    * @return mixed Value tested, if success. Otherwise, raise an Exception
    */
    function rejected( $v ){
    	if( $v === false ){
            return $v;     
        }
        throw new Exception( $v." is not a boolean false value" );
    }
    
    /**
    * Function test if the value of v is not zero.
    *
    * @param mixed v Value to test. Should be different from number 0.
    * @return mixed Value tested, if success. Otherwise, raise an Exception
    */
    function not_zero( $v ){
        if( !($v === 0 || $v === 0.0) ){
            return $v;     
        }
        throw new Exception( $v." is zero number" );
    }
    
    /**
     * Check if order of saved ids in array is right
     * First id must to be old one - In general negative number or same id if it has been saved before on database 
     * Second id must to be new one - Always positive number
     * 
     */ 
    function orderOfIds( $aIds ){
        if( 
            !(
                $aIds[1] > 0
                &&
                (
                    $aIds[0] < 0 
                    ||
                    $aIds[0] == $aIds[1]
                )
            )
        ){
            throw new Exception("Invalid order of values on arrays of processed ids return");
        }
        return $aIds;
    }
    
    /**
    * Function test if the value of v is an user from twitter or a link to twitter.
    *
    * @param mixed v Value to test. Should be an user from twitter or a link to twitter..
    * @return mixed Value tested, if success. Otherwise, raise an Exception
    */
    function twitter( $v ){
        if( preg_match("/^((http|https):\/\/)?(\w+:{0,1}\w*\.)?twitter\.com(\.br)?\/([A-Za-z0-9_\?]+)$/", $v ) ){
            return $v;
        }
        else if( preg_match("/^@([A-Za-z0-9_]+)$/", $v) ){
            return 'https://twitter.com/'.str_replace('@','', $v);
        }
        throw new Exception("Invalid twitter link");
    }
    
    /**
    * Function test if the value of v is a link to facebook.
    *
    * @param mixed v Value to test. Should be a link to facebook..
    * @return mixed Value tested, if success. Otherwise, raise an Exception
    */
    function facebook( $v ){
        //preg_match("/^((http|https):\/\/)?(\w+:{0,1}\w*\.)?facebook\.com(\.br)?\/(app_scoped_user_id\/)?([A-Za-z0-9_\?.]+)(\/)?$/", $v ) ){
		try{
	        if( 
	        	$this->durl($v)
	        	&&
	        	preg_match("/^((http|https):\/\/)?(\w+:{0,1}\w*\.)?facebook\.com(\.br)?\/([A-Za-z0-9_\?.-]+)/", $v ) 
	        ){
	            return $v;
	        }
    	} catch(Exception $e){
    		
    	}
	    if( preg_match("/^([A-Za-z0-9_]+)$/", $v) ){
            return 'https://facebook.com/'.$v;
        }
        throw new Exception("Invalid facebook link");
    }
    
    /**
    * Function test if the value of v is a link to G+.
    *
    * @param mixed v Value to test. Should be a link to Google Plus..
    * @return mixed Value tested, if success. Otherwise, raise an Exception
    */
    function google_plus( $v ){
        if( preg_match("/^((http|https):\/\/)?(\w+:{0,1}\w*\.)?plus\.google\.com?\/([A-Za-z0-9\?\+\/]+)$/", $v ) ){
            return $v;
        }
        else if( preg_match("/^([A-Za-z0-9\+]+)$/", $v) ){
            return 'https://plus.google.com/'.$v;
        }
        throw new Exception("Invalid G+ link");
    }
    
    /**
    * Function test if the value of v is a link to youtube.
    *
    * @param mixed v Value to test. Should be a link to youtube..
    * @return mixed Value tested, if success. Otherwise, raise an Exception
    */
    function youtube( $v ){
        if( preg_match("/^((http|https):\/\/)?(\w+:{0,1}\w*\.)?youtu(\.be|be\.com(\.br)?)\/(user\/)?([A-Za-z0-9\?]+)$/", $v ) ){
            return $v;
        }
        else if( preg_match("/^([A-Za-z0-9]+)$/", $v) ){
            return 'https://youtube.com/'.$v;
        }
        throw new Exception("Invalid youtube link");
    }
    
    /**
    * Function test if the value of v is a link to linkedin.
    *
    * @param mixed v Value to test. Should be a link to linkedin..
    * @return mixed Value tested, if success. Otherwise, raise an Exception
    */
    function linkedin( $v ){
        if( preg_match("/^((http|https):\/\/)?(\w+:{0,1}\w*\.)?linkedin\.com(\.br)?\/([A-Za-z0-9\-\/\?=&_%]+)$/", $v ) ){
            return $v;
        }
        else if( preg_match("/^([A-Za-z0-9\-\/]+)$/", $v) ){
            return 'https://linkedin.com/'.$v;
        }
        throw new Exception("Invalid linkedin link");
    }
    
    /**
    * Function test if the value of v is a link to instagram.
    *
    * @param mixed v Value to test. Should be a link to instagram..
    * @return mixed Value tested, if success. Otherwise, raise an Exception
    */
    function instagram( $v ){
        if( preg_match("/^((http|https):\/\/)?(\w+:{0,1}\w*\.)?instagram\.com\/([A-Za-z0-9_\?]+)$/", $v ) ){
            return $v;
        }
        else if( preg_match("/^([A-Za-z0-9_]+)$/", $v) ){
            return 'https://instagram.com/'.$v;
        }
        throw new Exception("Invalid instagram link");
    }
    
    /*
    * Function test if the value of v is a valid slug
    *
    * @param string v Value to test. Should be a slug.
    * @return string Value tested, if success. Otherwise, raise an Exception
    */
    function slug( $v ){
    	$_v = trim($v);
		$_v = preg_replace('/[^a-z0-9_-]/', '-', $_v);
		$_v = preg_replace('/-+/', "-", $_v);
		$_v = rtrim($_v, '-');
		
		if($v != $_v){
    		throw new Exception("Invalid slug");
		}
		return $v;
    }
    
    
    /*
    * Function test if the value of v is a valid slug for postgresql column name
    *
    * @param mixed v Value to test. Should be a slug for postgresql column name.
    * @return mixed Value tested, if success. Otherwise, raise an Exception
    */
    function slug_postgresql_column_name($v){
    	$_v = trim($v);
		$_v = preg_replace('/[^a-z0-9_]/', '_', $_v);
		$_v = substr(rtrim($_v, '_'),0,50);
		
		if($v != $_v){
    		throw new Exception("Invalid slug for postgresql column name");
		}
		return $v;
    }
    
    /**
    * Function test if there variable value inside an array of options ('I','U','D')
    *
    * @param mixed $v Value to test. Should be string.
    * @return mixed Value tested, if success. Otherwise, raise an Exception
    */
    function record_action( $v ){
        if (!is_string($v)){
            throw new Exception( "The input is not a string" );
        }
        $aValidValues = [
            "I"
            ,"U"
            ,"D"
        ];
        return $this->in($v, $aValidValues);
    }
}