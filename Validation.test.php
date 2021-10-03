<?php
require_once __DIR__."/Validation.class.php";
use \Drall\PRS\BASE\Validation as Validation;

class ValidationTest extends PHPUnit\Framework\TestCase{

    public $obj;


    protected function setUp() {
        $this->obj = new Validation();
    }


    protected function tearDown() {
        unset($this->obj);
    }

    function test_required(){
        $this->assertEquals( $this->obj->required("abcd"), "abcd", "Check string with alphabetic characteres");
        $this->assertEquals( $this->obj->required("9876"), "9876", "Check string with numeric value");
        $this->assertEquals( $this->obj->required( array("9876") ), array("9876"), "Check array with element");
        $this->assertEquals( $this->obj->required( 0 ), 0, "Check zero as number");
        $this->assertEquals( $this->obj->required( "0" ), "0", "Check zero as string");
        $this->assertEquals( $this->obj->required( true ), true, "Check boolean true value");
        $this->assertEquals( $this->obj->required( false ), false, "Check boolean true value");
        
        try{
            $this->obj->required(" ");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating no input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->required("");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating no input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->required(null);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->required(array());
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Invalid empty array input for required");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating empty array input. It is invalid input, but test will catch its fail." );
        }
    }

    function test_string(){
        $this->assertEquals( $this->obj->string("try this"), "try this", "String value is a valid string value");
        $this->assertEquals( $this->obj->string("Actual"), "Actual", "Capitalize string value is a valid string value");
        $this->assertEquals( $this->obj->string("-a.a"), "-a.a", "String value has special symbol is a valid string value");
        $this->assertEquals( $this->obj->string(" "), " ", "Valid string value");
        $this->assertEquals( $this->obj->string(""), "", "Valid string value"); 
        
        
        try{
            $this->obj->string(null);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }
        
        try{
            $this->obj->string(0);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Zero is not a string");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating zero input. It is invalid input for string, but test will catch its fail." );
        }
        
        try{
            $this->obj->string(1);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "One is not a string");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating one input. It is invalid input for string, but test will catch its fail." );
        }
    }

    function test_int(){
        $this->assertEquals( $this->obj->int(1), 1, "Input is int");
        $this->assertEquals( $this->obj->int(0), 0, "Input is int");
        $this->assertEquals( $this->obj->int("1"), 1, "Input is int");
        $this->assertEquals( $this->obj->int("0"), 0, "Input is int");
        
        try{
            $this->obj->int(" ");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating space string input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating space string input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->int("");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating empty string input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating empty string input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->int(null);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->int(false);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating boolean false input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating boolean false input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->int("aaa");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating int input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating int input. It is invalid input, but test will catch its fail." );
        }
    }
    
    function test_integer(){
        $this->assertEquals( $this->obj->integer(1), 1, "Input is integer");
        $this->assertEquals( $this->obj->integer(0), 0, "Input is integer");
        $this->assertEquals( $this->obj->integer("1"), 1, "Input is integer");
        $this->assertEquals( $this->obj->integer("0"), 0, "Input is integer");
        
        try{
            $this->obj->integer(" ");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating space string input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating space string input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->integer("");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating empty string input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating empty string input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->integer(null);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->integer(false);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating boolean false input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating boolean false input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->integer("aaa");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating integer input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating integer input. It is invalid input, but test will catch its fail." );
        }
    }
    
    function test_bool(){
        $this->assertEquals( $this->obj->bool(true), true, "Input is bool");
        $this->assertEquals( $this->obj->bool(false), false, "Input is bool");
        
        try{
            $this->obj->bool(null);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->bool(" ");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->bool("");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->bool(0);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating bool false input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating bool false input. It is invalid input, but test will catch its fail." );
        }

        try{
            $this->obj->bool("aaa");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating bool input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating bool input. It is invalid input, but test will catch its fail." );
        }
    }

    function test_boolean(){
        $this->assertEquals( $this->obj->boolean(true), true, "Input is boolean");
        $this->assertEquals( $this->obj->boolean(false), false, "Input is boolean");
        
        try{
            $this->obj->boolean(null);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->boolean(" ");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->boolean("");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->boolean(0);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating boolean false input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating boolean false input. It is invalid input, but test will catch its fail." );
        }

        try{
            $this->obj->boolean("aaa");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating boolean input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating boolean input. It is invalid input, but test will catch its fail." );
        }
    }
    
    function test_dboolean(){
        $this->assertEquals( $this->obj->dboolean(true), true, "Value is acceptable boolean true");
        $this->assertEquals( $this->obj->dboolean(false), false, "Value is acceptable boolean false");
        $this->assertEquals( $this->obj->dboolean("true"), "true", "Value is acceptable boolean 'true'");
        $this->assertEquals( $this->obj->dboolean("false"), "false", "Value is acceptable boolean 'false'");
        $this->assertEquals( $this->obj->dboolean("True"), "True", "Value is acceptable boolean 'True'");
        $this->assertEquals( $this->obj->dboolean("False"), "False", "Value is acceptable boolean 'False'");
        
        
        $this->assertEquals( $this->obj->dboolean("t"), "t", "Value is acceptable boolean 't'");
        $this->assertEquals( $this->obj->dboolean("f"), "f", "Value is acceptable boolean 'f'");
        
        $this->assertEquals( $this->obj->dboolean(0), 0, "Value is acceptable boolean 0");
        $this->assertEquals( $this->obj->dboolean(1), 1, "Value is acceptable boolean 1");
        
        try{
            $this->obj->dboolean(null);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->dboolean(" ");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->dboolean("");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->dboolean("0");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating boolean false input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating dboolean false input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->dboolean("1");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating boolean false input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating dboolean false input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->dboolean("T");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating boolean false input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating dboolean false input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->dboolean("F");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating boolean false input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating dboolean false input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->dboolean("aaa");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating dboolean input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating dboolean input. It is invalid input, but test will catch its fail." );
        }
    }

    function test_numeric(){
        $this->assertEquals( $this->obj->numeric("1.1"), "1.1", "Input is not numeric");
        $this->assertEquals( $this->obj->numeric("55"), "55", "Input is not numeric");
        $this->assertEquals( $this->obj->numeric("-23.45897962354321942"), "-23.45897962354321942", "Input is string, but numeric");
        $this->assertEquals( $this->obj->numeric(-23.45897962354321942), -23.45897962354321942, "Input is double, but numeric");

        try{
            $this->obj->numeric(null);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->numeric(" ");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating spache string input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->numeric("");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating empty string input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }        
        try{
            $this->obj->numeric("110,9");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating numeric input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating numeric input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->numeric("3,234,432.23");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating 3,234,432.23 input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating 3,234,432.23 input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->numeric("numeric");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating numeric input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating numeric input. It is invalid input, but test will catch its fail." );
        }
    }
    
    function test_float(){
    	$this->assertEquals( $this->obj->float(1.0), 1.0, "Input is float");
        $this->assertEquals( $this->obj->float(1.4), 1.4, "Input is float");
        $this->assertEquals( $this->obj->float(1), 1.0, "Input is float");
        $this->assertEquals( $this->obj->float(0.8), 0.8, "Input is float");
        $this->assertEquals( $this->obj->float(0.0), 0.0, "Input is float");
        $this->assertEquals( $this->obj->float("1.0"), 1.0, "Input is float");
        $this->assertEquals( $this->obj->float("1.4"), 1.4, "Input is float");
        $this->assertEquals( $this->obj->float("1"), 1.0, "Input is float");
        $this->assertEquals( $this->obj->float("0.8"), 0.8, "Input is float");
        $this->assertEquals( $this->obj->float("-0.8"), -0.8, "Input is float");
        $this->assertEquals( $this->obj->float("0.0"), 0.0, "Input is float");
        
        try{
            $this->obj->float(" ");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating space string input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating space string input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->float("");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating empty string input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating empty string input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->float(null);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->float(false);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating boolean false input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating boolean false input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->float("aaa");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating float input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating float input. It is invalid input, but test will catch its fail." );
        }
    }
    
    function test_email(){
        $this->assertEquals( $this->obj->email("email@mail.com"), "email@mail.com", "Valid email value");
        
        try{
            $this->obj->email(null);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->email(" ");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating empty string input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->email("");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating string space input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->email("3843920");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating email. Invalid value");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating email. It is invalid email, but test will catch its fail." );
        }
        try{
            $this->obj->email("email@mail");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating email. Invalid value");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating email. It is invalid email, but test will catch its fail." );
        }
        try{
            $this->obj->email("emailmail.com");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating email. Invalid value");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating email. It is invalid email, but test will catch its fail." );
        }
    }

    function test_url(){
        $this->assertEquals( $this->obj->url("https://www.drall.com.br"), "https://www.drall.com.br", "Validating valid url value");
        $this->assertEquals( $this->obj->url("http://www.drall.com.br"), "http://www.drall.com.br", "Validating valid url value");
        $this->assertEquals( $this->obj->url("http://drall.com.br"), "http://drall.com.br", "Validating valid url value");
        $this->assertEquals( $this->obj->url("http://drall.com.br/teste.php"), "http://drall.com.br/teste.php", "Validating valid url value");
        $this->assertEquals( $this->obj->url("http://drall.com.br/teste/ccc?key=0AsDtf7hgR_2IdFYxdm9QQUVwRDZhaDhDLTlXbE9wZ1E#gid=0"), "http://drall.com.br/teste/ccc?key=0AsDtf7hgR_2IdFYxdm9QQUVwRDZhaDhDLTlXbE9wZ1E#gid=0", "Validating valid url value");
        $this->assertEquals( $this->obj->url("https://autorizadorup.drall.com.br/Autenticacao/LogOn?ReturnUrl=%2f"),'https://autorizadorup.drall.com.br/Autenticacao/LogOn?ReturnUrl=%2f', "Validating valid url value");
        $this->assertEquals( $this->obj->url("https://www.facebook.com/profile.php?id=100000557597058&fref=ts"), "https://www.facebook.com/profile.php?id=100000557597058&fref=ts", "Validating domain value 'of a valid facebook profile'");
        $this->assertEquals( $this->obj->url("https://www.facebook.com/regiani.carvalhodeoliveira"), "https://www.facebook.com/regiani.carvalhodeoliveira", "Validating url profile of facebook having point in the middle");
        $this->assertEquals( $this->obj->url("https://www.facebook.com/pages/Signing-Hands-Across-the-Water/173650286067837"), "https://www.facebook.com/pages/Signing-Hands-Across-the-Water/173650286067837", "Validating url profile of facebook having hifen,numbers in the middle");


        try{
            $this->obj->url(null);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->url(" ");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating space string input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating space string input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->url("");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating empty string input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating empty string input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->url("3843920");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating valid url value. Invalid url");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating valid url value. It is invalid url, but test will catch its fail." );
        }
        try{
            $this->obj->url("www.drall.com.br");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating valid url value. Invalid url");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating valid url value. It is invalid url, but test will catch its fail." );
        }
        try{
            $this->obj->url("a");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating valid url value. Invalid url");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating valid url value. It is invalid url, but test will catch its fail." );
        }
        try{
            $this->obj->url("a.");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating valid url value. Invalid url");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating valid url value. It is invalid url, but test will catch its fail." );
        }
        try{
            $this->obj->url("www.");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating valid url value. Invalid url");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating valid url value. It is invalid url, but test will catch its fail." );
        }
        try{
            $this->obj->url("www.drall");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating valid url value. Invalid url");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating valid url value. It is invalid url, but test will catch its fail." );
        }
    }
    
    
    function test_durl(){
        $this->assertEquals( $this->obj->durl("https://www.drall.com.br"), "https://www.drall.com.br", "Validating valid url value");
        $this->assertEquals( $this->obj->durl("http://www.drall.com.br"), "http://www.drall.com.br", "Validating valid url value");
        $this->assertEquals( $this->obj->durl("http://drall.com.br"), "http://drall.com.br", "Validating valid url value");
        $this->assertEquals( $this->obj->durl("http://drall.com.br/teste.php"), "http://drall.com.br/teste.php", "Validating valid url value");
        $this->assertEquals( $this->obj->durl("http://drall.com.br/teste/ccc?key=0AsDtf7hgR_2IdFYxdm9QQUVwRDZhaDhDLTlXbE9wZ1E#gid=0"), "http://drall.com.br/teste/ccc?key=0AsDtf7hgR_2IdFYxdm9QQUVwRDZhaDhDLTlXbE9wZ1E#gid=0", "Validating valid url value");
        $this->assertEquals( $this->obj->durl("https://autorizadorup.drall.com.br/Autenticacao/LogOn?ReturnUrl=%2f"),'https://autorizadorup.drall.com.br/Autenticacao/LogOn?ReturnUrl=%2f', "Validating valid url value");
        $this->assertEquals( $this->obj->durl("https://www.facebook.com/profile.php?id=100000557597058&fref=ts"), "https://www.facebook.com/profile.php?id=100000557597058&fref=ts", "Validating domain value 'of a valid facebook profile'");
        $this->assertEquals( $this->obj->durl("https://www.facebook.com/profile.1"), "https://www.facebook.com/profile.1", "Validating domain value 'of a valid facebook profile' 'https://www.facebook.com/profile.1'");

        
        
        
        $this->assertEquals( $this->obj->durl("www.drall.com.br"), "www.drall.com.br", "Validating valid url value");
        $this->assertEquals( $this->obj->durl("www.drall.com.br"), "www.drall.com.br", "Validating valid url value");
        $this->assertEquals( $this->obj->durl("drall.com.br"), "drall.com.br", "Validating valid url value");
        $this->assertEquals( $this->obj->durl("drall.com.br/teste.php"), "drall.com.br/teste.php", "Validating valid url value");
        $this->assertEquals( $this->obj->durl("drall.com.br/teste/ccc?key=0AsDtf7hgR_2IdFYxdm9QQUVwRDZhaDhDLTlXbE9wZ1E#gid=0"), "drall.com.br/teste/ccc?key=0AsDtf7hgR_2IdFYxdm9QQUVwRDZhaDhDLTlXbE9wZ1E#gid=0", "Validating valid url value");
        $this->assertEquals( $this->obj->durl("autorizadorup.drall.com.br/Autenticacao/LogOn?ReturnUrl=%2f"),'autorizadorup.drall.com.br/Autenticacao/LogOn?ReturnUrl=%2f', "Validating valid url value");
        $this->assertEquals( $this->obj->durl("www.facebook.com/profile.php?id=100000557597058&fref=ts"), "www.facebook.com/profile.php?id=100000557597058&fref=ts", "Validating domain value 'of a valid facebook profile'");
        $this->assertEquals( $this->obj->durl("www.drall"), "www.drall", "Validating durl value 'www.drall'");


        try{
            $this->obj->durl(null);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->durl(" ");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating space string input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating space string input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->durl("");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating empty string input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating empty string input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->durl("3843920");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating valid url value. Invalid url");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating valid url value. It is invalid url, but test will catch its fail." );
        }
        try{
            $this->obj->durl("a");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating valid url value. Invalid url");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating valid url value. It is invalid url, but test will catch its fail." );
        }
        try{
            $this->obj->durl("a.");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating valid url value. Invalid url");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating valid url value. It is invalid url, but test will catch its fail." );
        }
        try{
            $this->obj->durl("www.drall.com.br.");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating valid url value. Invalid url with dot at the end");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating valid url value. It is invalid url, but test will catch its fail." );
        }
        try{
            $this->obj->durl("www.");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating valid url value. Invalid url");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating valid url value. It is invalid url, but test will catch its fail." );
        }
        try{
            $this->obj->durl("www.d");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating valid url value. Invalid url");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating valid url value. It is invalid url, but test will catch its fail." );
        }
        
        try{
            $this->obj->durl("admin@drall.com.br");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Checking email string. Invalid url");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Checking email string. It is invalid url, but test will catch its fail." );
        }
    }


    function test_domain(){
        $this->assertEquals( $this->obj->domain("https://www.drall.com.br"), "https://www.drall.com.br", "Validating valid url value");
        $this->assertEquals( $this->obj->domain("http://www.drall.com.br"), "http://www.drall.com.br", "Validating valid domain value");
        $this->assertEquals( $this->obj->domain("http://drall.com.br"), "http://drall.com.br", "Validating valid domain value");
        $this->assertEquals( $this->obj->domain("www.drall.com.br"), "www.drall.com.br", "Validating valid domain value");
        $this->assertEquals( $this->obj->domain("drall.com.br"), "drall.com.br", "Validating valid domain value");
        
        try{
            $this->obj->domain(null);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->domain("www.drall");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating 'www.drall' input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->domain(" ");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating space string input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating space string input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->domain("");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating empty string input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating empty string input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->domain("3843920");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating valid domain value. Invalid domain");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating valid url value. It is invalid domain, but test will catch its fail." );
        }
        try{
            $this->obj->domain("drall");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating valid url value. Invalid domain");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating valid domain value. It is invalid domain, but test will catch its fail." );
        }
        try{
            $this->obj->domain("a");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating valid url value. Invalid domain");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating valid domain value. It is invalid domain, but test will catch its fail." );
        }
        try{
            $this->obj->domain("a.");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating valid url value. Invalid domain");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating valid domain value. It is invalid domain, but test will catch its fail." );
        }
        try{
            $this->obj->domain("www.");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating valid url value. Invalid domain");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating valid domain value. It is invalid domain, but test will catch its fail." );
        }
    }


    function test_ip(){
        $this->assertEquals( $this->obj->ip("192.168.0.160"), "192.168.0.160", "Validating ip value");
        
        try{
            $this->obj->ip(null);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->ip(" ");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating space string input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating space string input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->ip("");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating empty string input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating empty string input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->ip("192,169,0,160");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating valid ip value. Invalid ip");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating valid url value. It is invalid url, but test will catch its fail." );
        }
        try{
            $this->obj->ip("192.169.160");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating valid ip value. Invalid ip");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating valid url value. It is invalid url, but test will catch its fail." );
        }
        try{
            $this->obj->ip("192.169.0000.160");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating valid ip value. Invalid ip");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating valid url value. It is invalid url, but test will catch its fail." );
        }
        try{
            $this->obj->ip("192.169.167.256");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating valid ip value. Invalid ip");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating valid url value. It is invalid url, but test will catch its fail." );
        }
    }

    function test_date(){
        $this->assertEquals( $this->obj->date("2013-12-29"), "2013-12-29", "Validating date value");
        $this->assertEquals( $this->obj->date("1900-01-01"), "1900-01-01", "Validating date value");
        
        try{
            $this->obj->date(null);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->date(" ");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating space string input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating space string input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->date("");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating empty string input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating empty string input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->date("2013-2-29");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating date value. Invalid date value");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating date value. It is invalid date, but test will catch its fail." );
        }
        try{
            $this->obj->date("year-month-day");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating date value. Invalid date value");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating date value. It is invalid date, but test will catch its fail." );
        }
    }

    function test_time(){
        $this->assertEquals( $this->obj->time("23:59:59"), "23:59:59", "Validating date time value");
        $this->assertEquals( $this->obj->time("23:59"), "23:59", "Validating time value");
        
        try{
            $this->obj->time(null);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->time(" ");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating space string input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating space string input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->time("");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating empty string input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating empty string input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->time("23:60");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating time value. Invalid time value");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating time value. It is invalid time, but test will catch its fail." );
        }
        try{
            $this->obj->time("23:60:00");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating time value. Invalid time value");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating time value. It is invalid time, but test will catch its fail." );
        }     
        try{
            $this->obj->time("ab:01:00");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating time value. Invalid time value");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating time value. It is invalid time, but test will catch its fail." );
        }     
    }

    function test_dateTime(){
        $this->assertEquals( $this->obj->dateTime("2013-12-29 23:59:59"), "2013-12-29 23:59:59", "Validating date Time value");
        $this->assertEquals( $this->obj->dateTime("2013-12-29 23:59"), "2013-12-29 23:59", "Validating date Time value");
        $this->assertEquals( $this->obj->dateTime("2013-12-29T23:59"), "2013-12-29T23:59", "Validating date Time value with T letter separation");
        
        try{
            $this->obj->dateTime(null);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->dateTime(" ");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating space string input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating space string input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->dateTime("");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating empty string input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating empty string input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->dateTime("2013-02-29 23:60");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating date time value. Invalid time value");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating date time value. It is invalid time, but test will catch its fail." );
        }
        try{
            $this->obj->dateTime("2013-13-33 23:59:59");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating date time value. Invalid date value");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating date time value. It is invalid date, but test will catch its fail." );
        }
        try{
            $this->obj->dateTime("23:59:59");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating date time value. Invalid date time format");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating date time value. It is invalid format, but test will catch its fail." );
        }
    }

    function test_timestamp(){
        $this->assertEquals( $this->obj->timestamp("2013-12-29 20:18:20.123456-03"), "2013-12-29 20:18:20.123456-03", "Validating datetimestamp value");
        $this->assertEquals( $this->obj->timestamp("2013-06-05 17:45:28-03"), "2013-06-05 17:45:28-03", "Validating datetimestamp value without miliseconds");
        $this->assertEquals( $this->obj->timestamp("2014-09-25 03:52:40.246035+00"), "2014-09-25 03:52:40.246035+00", "Validating datetimestamp value and GMT equal 0");

        try{
            $this->obj->timestamp(null);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->timestamp(" ");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating space string input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating space string input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->timestamp("");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating empty string input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating empty string input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->timestamp("2013-12-29 20:180:20.123456-03");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating timestamp value. Invalid minute value");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating timestamp value. It is invalid minute, but test will catch its fail." );
        }
        try{
            $this->obj->timestamp("2013-12-29 20:18:20.1234563");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating timestamp value. Not found timestamp_timezone value value");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating timestamp value. It is invalid imestamp_timezone, but test will catch its fail." );
        }
        try{
            $this->obj->timestamp("2013-13-32 25:80:61.1234563-05");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating timestamp value. Invalid milisecond value");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating timestamp value. Milisecond is to long, but test will catch its fail." );
        }
        try{
            $this->obj->timestamp("2013-13-32 25:01:61.1234563-15");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating timestamp value. Invalid date value");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating timestamp value. It is invalid date, but test will catch its fail." );
        }
    }

    function test_phone(){
        $this->assertEquals( $this->obj->phone("33843920"), "33843920", "Only Number");
        $this->assertEquals( $this->obj->phone("33884433991"), "33884433991", "Only Number");
        
        try{
            $this->obj->phone(null);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->phone(" ");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating space string input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating space string input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->phone("");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating empty string input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating empty string input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->phone("3843920");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating phone numbers. Invalid number");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating phone numbers. It is invalid number, but test will catch its fail." );
        }
        try{
            $this->obj->phone("338433992200");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating phone numbers. Invalid number");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating phone numbers. It is invalid number, but test will catch its fail." );
        }
        try{
            $this->obj->phone("116546.5989");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating phone numbers with dot. Invalid number");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating phone numbers with dot. It is invalid number, but test will catch its fail." );
        }
    }
    
    function test_creditcarddate(){
        $this->assertEquals( $this->obj->creditcarddate("012000"), "012000", "Validating date value");
        
        try{
            $this->obj->creditcarddate(null);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->creditcarddate(" ");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating space string input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating space string input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->creditcarddate("");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating empty string input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating empty string input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->creditcarddate("292013");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating date value. Invalid date value");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating date value. It is invalid date, but test will catch its fail." );
        }
        try{
            $this->obj->creditcarddate("year-month-day");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating date value. Invalid date value");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating date value. It is invalid date, but test will catch its fail." );
        }
    }
    
    function test_creditcard_name(){
        $this->assertEquals( $this->obj->creditcard_name("Name Sobrenome"), "Name Sobrenome", "Validating Name Sobrenome value");
        
        $this->assertEquals( $this->obj->creditcard_name("Name MidleName Sobrenome"), "Name MidleName Sobrenome", "Validating Name MidleName Sobrenome value");
        
        try{
            $this->obj->creditcard_name(null);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->creditcard_name(" ");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating space string input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating space string input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->creditcard_name("");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating empty string input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating empty string input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->creditcard_name("Name");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating date value. Invalid Name value");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating Name value. It is invalid Name, but test will catch its fail." );
        }
    }

    function test_cep(){
        $this->assertEquals( $this->obj->cep("30640155"), "30640155", "Validating cep numbers.");
        
        try{
            $this->obj->cep(null);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->cep(" ");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating space string input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating space string input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->cep("");
            $this->fail( "Validating empty string input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating empty string input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->cep("3064015");
            $this->fail( "Validating cep numbers. Invalid number" );
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating cep numbers. It is invalid number, but test will catch its fail." );
        }
    }

    function test_cpf(){
        $this->assertEquals( $this->obj->cpf("09175525631"), "09175525631", "Validating cpf numbers. It is valid number.");
        $this->assertEquals( $this->obj->cpf("07586220662"), "07586220662", "Validating cpf numbers. It is valid number.");
        $this->assertEquals( $this->obj->cpf("65585255428"), "65585255428", "Validating cpf numbers. It is valid number.");
        
        try{
            $this->obj->cpf(null);
            $this->fail( "Validating null input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->cpf(" ");
            
            $this->fail( "Validating space string input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating space string input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->cpf("");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating empty string input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating empty string input. It is invalid input, but test will catch its fail." );
        }
        try{
           $this->obj->cpf("65585255421");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
           $this->fail( "Validating cpf numbers. Invalid number" );
        } catch ( Exception $e ){
           $this->assertTrue( true , "Validating cpf numbers. It is valid." );
        }
        try{
           $this->obj->cpf("11111111111");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
           $this->fail( "Validating cpf numbers. Invalid number, but test will catch its fail" );
        } catch ( Exception $e ){
           $this->assertTrue( true , "Validating cpf numbers. It is invalid number, but test will catch its fail." );
        }
        try{
           $this->obj->cpf("00000000000");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
           $this->fail( "Validating cpf numbers. Invalid number, but test will catch its fail" );
        } catch ( Exception $e ){
           $this->assertTrue( true , "Validating cpf numbers. It is invalid number, but test will catch its fail." );
        }
    }

    function test_cnpj(){
        $this->assertEquals( $this->obj->cnpj("37338975000134"), "37338975000134", "Validating the cnpj numbers, removing '.' and '-' from number");
        $this->assertEquals( $this->obj->cnpj("32287070000169"), "32287070000169", "Validating the cnpj numbers, removing '.' and '-' from number");
        
        try{
            $this->obj->cnpj(null);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }       
        try{
            $this->obj->cnpj("988528450001075");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating cnpj numbers. Invalid number" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validating cnpj numbers. It is invalid number, but test will catch its fail." );
        }
        try{
            $this->obj->cnpj("11111111111111");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating cnpj numbers. Invalid number" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validating cnpj numbers. It is invalid number, but test will catch its fail." );
        }
        try{
            $this->obj->cnpj("00000000000000");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating cnpj numbers. Invalid number" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validating cnpj numbers. It is invalid number, but test will catch its fail." );
        }
    }
    
    
    function test_json(){
        $json = 'null';
        $this->assertEquals( $this->obj->json($json), $json, "Validating json convertion of null");
        $json = '{}';
        $this->assertEquals( $this->obj->json($json), $json, "Validating json convertion of {}");
        $json = '[]';
        $this->assertEquals( $this->obj->json($json), $json, "Validating json convertion of []");
        
        try{
            $this->obj->json("{");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating '{' caracter. Invalid json" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validating string json. It is invalid json, but test will catch its fail." );
        }
    }

    function test_length(){
        $this->assertEquals( $this->obj->length("aa aa bb", 2, 8), "aa aa bb", "Validating length");
        $this->assertEquals( $this->obj->length("aa", 2, 8), "aa", "Validating min length of word");
        $this->assertEquals( $this->obj->length("aaaaaaaa", 2, 8), "aaaaaaaa", "Validating max length of word");
        $this->assertEquals( $this->obj->length("aaaaaaaa", 2, null), "aaaaaaaa", "Validating min length and max length null of word");
        $this->assertEquals( $this->obj->length("aaaaaaaa", 2, 'N'), "aaaaaaaa", "Validating min length and max length 'N' of word");
        $this->assertEquals( $this->obj->length("aaaaaaaa", 'N', 8), "aaaaaaaa", "Validating max length and min length 'N' of word");
        $this->assertEquals( $this->obj->length(array("a", "b", "c", "bd"), 2, 8), array("a", "b", "c", "bd"), "Validating length ");
        $this->assertEquals( $this->obj->length("aaa aaa abc"), "aaa aaa abc", "Validating max length and min length null");

        try{
            $this->obj->length(null, 2, null);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->length(" ", 2, null);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating space string input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating space string input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->length("", 2, null);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating empty string input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating empty string input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->length("aaa aaa abc", 1, 2);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating length. Invalid length of words" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validating length. It is a invalid length, but test will catch its fail." );
        }
    }


    /**
     * @depends test_length
     */
    function test_words(){
        $this->assertEquals( $this->obj->words("aa aa bb", 2, 3), "aa aa bb", "Validating the max and the min number of words ");
        $this->assertEquals( $this->obj->words("aa aa aab aabb", 2, null), "aa aa aab aabb", "Validating max and min number of words ");
        $this->assertEquals( $this->obj->words("", null, null), "", "Validating max and the min number of words ");
        $this->assertEquals( $this->obj->words(null, null, null), "", "Validating max and the min number of null ");
        $this->assertEquals( $this->obj->words(null), "", "Validating max and the min number of null ");
        $this->assertEquals( $this->obj->words(null,1,2), "", "Validating max and the min number of null ");
        $this->assertEquals( $this->obj->words("aaa aaa aab aabb", null, null, 2), "aaa aaa aab aabb", "Validating min length of each word");
        $this->assertEquals( $this->obj->words("aaa aaa aab aabb", null, null, null, 4), "aaa aaa aab aabb", "Validating max length of each word");
        $this->assertEquals( $this->obj->words("aaa aaa aab aabb", null, null, 2, 4), "aaa aaa aab aabb", "Validating min and max length of each word");

        try{
            $this->obj->words(null, 1, 2, 1);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->words("", 1, 2, 1);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating numbers of words. Invalid number of words" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validating numbers of words. It is a invalid number, but test will catch its fail." );
        }
        try{
            $this->obj->words("aaa aaa abc", 1, 2);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating numbers of words. Invalid number of words" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validating numbers of words. It is a invalid number, but test will catch its fail." );
        }
    }


    function test_range(){
        $this->assertEquals( $this->obj->range("3", 2, 8), "3", "Validating range");
        $this->assertEquals( $this->obj->range("4", 2, null), "4", "Validating range");
        $this->assertEquals( $this->obj->range("4", null, 5), "4", "Validating range");

        try{
            $this->obj->range(null,1,1);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }
        try{
            $this->obj->range("1", 5, 6);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating range. Invalid range" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validating range. It is a invalid range, but test will catch its fail." );
        }
        try{
            $this->obj->range("1", a, 1.1);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating range. Invalid range" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validating range. It is a invalid range, but test will catch its fail." );
        }
    }
    
    function test_max(){
        $this->assertEquals( $this->obj->max("3", 8), "3", "Validating range");
        $this->assertEquals( $this->obj->max("4", 5), "4", "Validating range");
        $this->assertEquals( $this->obj->max("4", 4), "4", "Validating range");

        try{
            $this->obj->max("4", null);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }

        try{
            $this->obj->max("4", 2);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating max. Invalid max");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }

        try{
            $this->obj->max(null,1);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }

        try{
            $this->obj->max("10", 6);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating max. Invalid max" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validating max. It is a invalid max, but test will catch its fail." );
        }

        try{
            $this->obj->max("1.11", 1.1);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating max. Invalid max" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validating max. It is a invalid max, but test will catch its fail." );
        }
    }
    
    function test_min(){
        $this->assertEquals( $this->obj->min("3", 2), "3", "Validating range");
        $this->assertEquals( $this->obj->min("4", -4), "4", "Validating range");
        $this->assertEquals( $this->obj->min("4", 4), "4", "Validating range");

        try{
            $this->obj->min("4", null);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }

        try{
            $this->obj->min("4", 6);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating max. Invalid max");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }

        try{
            $this->obj->min(null,1);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null input. Invalid input");
        } catch ( Exception $e ){
            $this->assertTrue( true , "Validating null input. It is invalid input, but test will catch its fail." );
        }

        try{
            $this->obj->min("1", 6);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating min. Invalid min" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validating min. It is a invalid min, but test will catch its fail." );
        }

        try{
            $this->obj->min("1.1", 1.11);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating min. Invalid min" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validating max. It is a invalid min, but test will catch its fail." );
        }
    }

    function test_in(){
        $this->assertEquals( $this->obj->in("bd", array("a", "b", "c", "bd") ), "bd", "Validating if there is variable value inside");
        $this->assertEquals( $this->obj->in( null, array("a", "b", "c", "bd", null) ), null, "Validating if there is variable value inside");
        $this->assertEquals( $this->obj->in( 3, array("1", "2", "3", "4") ), 3, "Validating string numeric and integer");
        $this->assertEquals( $this->obj->in( 3, array(1, 2, 3, 4) ), 3, "Validating integer");
        $this->assertEquals( $this->obj->in( true, array(true,0,1) ), true, "Validating boolean");
        $this->assertEquals( $this->obj->in("bd1111111111e", array("a", "b", "c", "/bd\d1+e/", "bd") ), "bd1111111111e", "Validating if regex pattern is working");
        
        
        try{
            $this->assertEquals( $this->obj->in("bd1111111111e", array("a", "b", "c", "/bd\d1+e", "bd") ), "Validating an invalid regex pattern. So, it must to fail");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validation invalid regex. It is wrong. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validation invalid regex. It is a invalid value, but test will catch its fail." );
        }
        
            
        try{
            $this->obj->in(true, array(1, "1", "2", "3", "4") );
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validation boolean against [1, \"1\", \"2\", \"3\", \"4\"]. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validation boolean against [1, \"1\", \"2\", \"3\", \"4\"]. It is a invalid value, but test will catch its fail." );
        }
        
        try{
            $this->obj->in("a", array("1", "2", "3", "4") );
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating if there is variable value inside. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validating if there is variable value inside. It is a invalid value, but test will catch its fail." );
        }
    }
    
    function test_no_white_space(){
        $this->assertEquals( $this->obj->no_white_space("EstáTudoBlzAqui"), "EstáTudoBlzAqui", "Validating variable with no white space");
            
        try{
            $this->obj->no_white_space(" ");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating variable value empty. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validating if there is whitespace value inside. It is a invalid value, but test will catch its fail." );
        }
        try{
            $this->obj->no_white_space("Não pode passar");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating variable value with whitespace. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validating if there is whitespace value inside. It is a invalid value, but test will catch its fail." );
        }
    }
    
    function test_negative(){        
        $this->assertEquals( $this->obj->negative(-2), -2, "Validating negative value on negative validator");
        $this->assertEquals( $this->obj->negative("-2"), "-2", "Validating negative value on negative validator");
        $this->assertEquals( $this->obj->negative(0), 0, "Validating zero value on negative validator");
        
        try{
            $this->obj->negative(null);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null value on negative validator. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validating null value on negative validator. It is a invalid value, but test will catch its fail." );
        }
        try{
            $this->obj->negative(" ");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating space string value on negative validator. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validating space string value on negative validator. It is a invalid value, but test will catch its fail." );
        }
        try{
            $this->obj->negative("");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating empty string value on negative validator. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validating empty string value on negative validator. It is a invalid value, but test will catch its fail." );
        }
        try{
            $this->assertEquals( $this->obj->negative(2), 2, "Validating positive value on negative validator");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating positive value '2' on negative validator. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validating positive value '2' on negative validator. It is a invalid value, but test will catch its fail." );
        }
        try{
            $this->assertEquals( $this->obj->negative("a"), "a", "Validating string 'a' value on negative validator");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating string 'a' value on negative validator. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validating string 'a' value on negative validator. It is a invalid value, but test will catch its fail." );
        }
    }
    
    function test_positive(){
        $this->assertEquals( $this->obj->positive(2), 2, "Validating positive value on positive validator");
        $this->assertEquals( $this->obj->positive("2"), "2", "Validating positive value on positive validator");
        $this->assertEquals( $this->obj->positive(0), 0, "Validating zero on positive validator");

        try{
            $this->obj->positive(null);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null value on positive validator. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validating null value on positive validator. It is a invalid value, but test will catch its fail." );
        }
        try{
            $this->obj->positive(" ");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating space string value on positive validator. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validating space string value on positive validator. It is a invalid value, but test will catch its fail." );
        }
        try{
            $this->obj->positive("");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating empty string value on positive validator. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validating empty string value on positive validator. It is a invalid value, but test will catch its fail." );
        }
        try{
            $this->assertEquals( $this->obj->positive(-2), -2, "Validating negative value on positive validator");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating negative value '-2' on positive validator. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validating negative value '-2' on positive validator. It is a invalid value, but test will catch its fail." );
        }
        try{
            $this->assertEquals( $this->obj->positive("a"), "a", "Validating string 'a' value on positive validator");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating string 'a' value on positive validator. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validating string 'a' value on positive validator. It is a invalid value, but test will catch its fail." );
        }
    }
    
    function test_accepted(){
    	$this->assertEquals( $this->obj->accepted(true), true, "Check boolean value true");
    	
    	try{
            $this->obj->accepted(false);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating boolean value false on accepted validator. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Check boolean value false on accepted validation. It is a invalid value, but test will catch its fail." );
        }
        
        try{
            $this->obj->accepted("true");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating string value true on accepted validator. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Check string value true on accepted validation. It is a invalid value, but test will catch its fail." );
        }
        
        try{
            $this->obj->accepted("false");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating string value false on accepted validator. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Check string value false on accepted validation. It is a invalid value, but test will catch its fail." );
        }
        
        try{
            $this->obj->accepted(0);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating integer value 0 on accepted validator. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Check integer value 0 on accepted validation. It is a invalid value, but test will catch its fail." );
        }
        
        try{
            $this->obj->accepted(1);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating integer value 1 on accepted validator. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Check integer value 1 on accepted validation. It is a invalid value, but test will catch its fail." );
        }
        
        try{
            $this->obj->accepted("0");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating string value 0 on accepted validator. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Check string value 0 on accepted validation. It is a invalid value, but test will catch its fail." );
        }
        
        try{
            $this->obj->accepted("1");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating string value 1 on accepted validator. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Check string value 1 on accepted validation. It is a invalid value, but test will catch its fail." );
        }
        
        try{
            $this->obj->accepted(null);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null value null on accepted validator. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Check null value null on accepted validation. It is a invalid value, but test will catch its fail." );
        }
        
        try{
            $this->obj->accepted(" ");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating string value empty space on accepted validator. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Check string value empty space on accepted validation. It is a invalid value, but test will catch its fail." );
        }
    }
    
    function test_rejected(){
    	$this->assertEquals( $this->obj->rejected(false), false, "Check boolean value false");
    	
    	try{
            $this->obj->rejected(true);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating boolean value true on rejected validator. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Check boolean value true on rejected validation. It is a invalid value, but test will catch its fail." );
        }
        
        try{
            $this->obj->rejected("true");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating string value true on rejected validator. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Check string value true on rejected validation. It is a invalid value, but test will catch its fail." );
        }
        
        try{
            $this->obj->rejected("false");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating string value false on rejected validator. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Check string value false on rejected validation. It is a invalid value, but test will catch its fail." );
        }
        
        try{
            $this->obj->rejected(0);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating integer value 0 on rejected validator. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Check integer value 0 on rejected validation. It is a invalid value, but test will catch its fail." );
        }
        
        try{
            $this->obj->rejected(1);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating integer value 1 on rejected validator. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Check integer value 1 on rejected validation. It is a invalid value, but test will catch its fail." );
        }
        
        try{
            $this->obj->rejected("0");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating string value 0 on rejected validator. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Check string value 0 on rejected validation. It is a invalid value, but test will catch its fail." );
        }
        
        try{
            $this->obj->rejected("1");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating string value 1 on rejected validator. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Check string value 1 on rejected validation. It is a invalid value, but test will catch its fail." );
        }
        
        try{
            $this->obj->rejected(null);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null value null on rejected validator. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Check null value null on rejected validation. It is a invalid value, but test will catch its fail." );
        }
        
        try{
            $this->obj->rejected(" ");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating string value empty space on rejected validator. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Check string value empty space on rejected validation. It is a invalid value, but test will catch its fail." );
        }
    }
    
    function test_not_zero(){
        $this->assertEquals( $this->obj->not_zero("1"), "1", "Check string value 1");
        $this->assertEquals( $this->obj->not_zero("0"), "0", "Check string value 0");
        $this->assertEquals( $this->obj->not_zero(null), null, "Check null");
        $this->assertEquals( $this->obj->not_zero(" "), " ", "Check empty space");

        try{
            $this->obj->not_zero(0);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating 0 value on not_zero validator. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Check integer value 0 on not_zero validation. It is a invalid value, but test will catch its fail." );
        }
        try{
            $this->obj->not_zero(0.0);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating float 0.0 value on not_zero validator. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Check float value 0.0 on not_zero validator. It is a invalid value, but test will catch its fail." );
        }
    }
    
    
    function test_orderOfIds(){
        $aIn = array(-1,1);
        $this->assertEquals( $this->obj->orderOfIds($aIn), $aIn, "Validate order ids");
        
        $aIn = array(-3,10);
        $this->assertEquals( $this->obj->orderOfIds($aIn), $aIn, "Validating order of saved ids");
        
        $aIn = array(11,11);
        $this->assertEquals( $this->obj->orderOfIds($aIn), $aIn, "Validating order of saved ids");

        try{
            $aIn = array(3,10);
            $this->assertEquals( $this->obj->orderOfIds($aIn), $aIn, "Invalid first element positive different from second value");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating orderOfIds. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validating orderOfIds. It is a invalid value, but test will catch its fail." );
        }
        
        
        try{
            $aIn = array(-3,-3);
            $this->assertEquals( $this->obj->orderOfIds($aIn), $aIn, "Invalid second element negative");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating orderOfIds. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validating orderOfIds. It is a invalid value, but test will catch its fail." );
        }
    }
    
    
    function test_twitter(){
        $this->assertEquals( $this->obj->twitter('@username'), 'https://twitter.com/username', 'Validating twitter user value @username on twitter validator');
        $this->assertEquals( $this->obj->twitter('https://twitter.com/username'), 'https://twitter.com/username', 'Validating link to twitter value "https://twitter.com/username" on twitter validator');
        $this->assertEquals( $this->obj->twitter('http://twitter.com/username'), 'http://twitter.com/username', 'Validating link to twitter value "http://twitter.com/username" on twitter validator');
        $this->assertEquals( $this->obj->twitter('twitter.com/username'), 'twitter.com/username', 'Validating link to twitter value "twitter.com/username" on twitter validator');
        $this->assertEquals( $this->obj->twitter('https://twitter.com.br/username'), 'https://twitter.com.br/username', 'Validating link to twitter value "https://twitter.com.br/username" on twitter validator');
        $this->assertEquals( $this->obj->twitter('http://twitter.com.br/username'), 'http://twitter.com.br/username', 'Validating link to twitter value "http://twitter.com.br/username" on twitter validator');
        $this->assertEquals( $this->obj->twitter('twitter.com.br/username'), 'twitter.com.br/username', 'Validating link to twitter value "twitter.com.br/username" on twitter validator');
        
        try{
            $this->obj->twitter(null);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null value on twitter validator. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validating null value on twitter validator. It is a invalid value, but test will catch its fail." );
        }
        
        try{
            $this->obj->twitter('https://twitter.com');
            $this->fail('');
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( 'Validating link to twitter value "https://twitter.com" on twitter validator. Invalid value' );
        } catch(Exception $e){
            $this->assertTrue( true , 'Validating link to twitter value "https://twitter.com" on twitter validator. It is a invalid value, but test will catch its fail.' );
        }
        
        try{
            $this->obj->twitter('http://twitter.com');
            $this->fail('');
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( 'Validating link to twitter value "http://twitter.com" on twitter validator. Invalid value' );
        } catch(Exception $e){
            $this->assertTrue( true , 'Validating link to twitter value "http://twitter.com" on twitter validator. It is a invalid value, but test will catch its fail.' );
        }
        
        try{
            $this->obj->twitter('twitter.com');
            $this->fail('');
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( 'Validating link to twitter value "twitter.com" on twitter validator. Invalid value' );
        } catch(Exception $e){
            $this->assertTrue( true , 'Validating link to twitter value "twitter.com" on twitter validator. It is a invalid value, but test will catch its fail.' );
        }
        
        try{
            $this->obj->twitter('https://twitter.com.br');
            $this->fail('');
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( 'Validating link to twitter value "https://twitter.com.br" on twitter validator. Invalid value' );
        } catch(Exception $e){
            $this->assertTrue( true , 'Validating link to twitter value "https://twitter.com.br" on twitter validator. It is a invalid value, but test will catch its fail.' );
        }
        
        try{
            $this->obj->twitter('http://twitter.com.br');
            $this->fail('');
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( 'Validating link to twitter value "http://twitter.com.br" on twitter validator. Invalid value' );
        } catch(Exception $e){
            $this->assertTrue( true , 'Validating link to twitter value "http://twitter.com.br" on twitter validator. It is a invalid value, but test will catch its fail.' );
        }
        
        try{
            $this->obj->twitter('twitter.com.br');
            $this->fail('');
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( 'Validating link to twitter value "twitter.com.br" on twitter validator. Invalid value' );
        } catch(Exception $e){
            $this->assertTrue( true , 'Validating link to twitter value "twitter.com.br" on twitter validator. It is a invalid value, but test will catch its fail.' );
        }
        
    }
    
    function test_facebook(){
        $this->assertEquals( $this->obj->facebook('username'), 'https://facebook.com/username', 'Validating facebook user value username on facebook validator');
        $this->assertEquals( $this->obj->facebook('https://facebook.com/username'), 'https://facebook.com/username', 'Validating link to facebook value "https://facebook.com/username" on facebook validator');
        $this->assertEquals( $this->obj->facebook('http://facebook.com/username'), 'http://facebook.com/username', 'Validating link to facebook value "http://facebook.com/username" on facebook validator');
        $this->assertEquals( $this->obj->facebook('facebook.com/username'), 'facebook.com/username', 'Validating link to facebook value "facebook.com/username" on facebook validator');
        $this->assertEquals( $this->obj->facebook('https://facebook.com.br/username'), 'https://facebook.com.br/username', 'Validating link to facebook value "https://facebook.com.br/username" on facebook validator');
        $this->assertEquals( $this->obj->facebook('http://facebook.com.br/username'), 'http://facebook.com.br/username', 'Validating link to facebook value "http://facebook.com.br/username" on facebook validator');
        $this->assertEquals( $this->obj->facebook('facebook.com.br/username'), 'facebook.com.br/username', 'Validating link to facebook value "facebook.com.br/username" on facebook validator');
        $this->assertEquals( $this->obj->facebook('https://www.facebook.com/app_scoped_user_id/724264124306134/'), 'https://www.facebook.com/app_scoped_user_id/724264124306134/', 'Validating link to facebook value "https://www.facebook.com/app_scoped_user_id/724264124306134/" on facebook validator. This is the url that facebook api return.');
        $this->assertEquals( $this->obj->facebook("https://www.facebook.com/regiani.carvalhodeoliveira"), "https://www.facebook.com/regiani.carvalhodeoliveira", "Validating url profile of facebook having point in the middle with http");
        $this->assertEquals( $this->obj->facebook("www.facebook.com/regiani.carvalhodeoliveira"), "www.facebook.com/regiani.carvalhodeoliveira", "Validating url profile of facebook having point in the middle without http");
        $this->assertEquals( $this->obj->facebook("https://www.facebook.com/pages/Signing-Hands-Across-the-Water/173650286067837"), "https://www.facebook.com/pages/Signing-Hands-Across-the-Water/173650286067837", "Validating url profile of facebook having hifen,numbers in the middle");
        $this->assertEquals( $this->obj->facebook("https://www.facebook.com/rachel.suttonspence?fref=ts"), "https://www.facebook.com/rachel.suttonspence?fref=ts", "Validating url profile of facebook having exclamation market (url query part) in the middle");
        
        
        try{
            $this->obj->facebook(null);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null value on facebook validator. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validating null value on facebook validator. It is a invalid value, but test will catch its fail." );
        }
        
        try{
            $this->obj->facebook('https://facebook.com');
            $this->fail('');
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( 'Validating link to facebook value "https://facebook.com" on facebook validator. Invalid value' );
        } catch(Exception $e){
            $this->assertTrue( true , 'Validating link to facebook value "https://facebook.com" on facebook validator. It is a invalid value, but test will catch its fail.' );
        }
        
        try{
            $this->obj->facebook('http://facebook.com');
            $this->fail('');
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( 'Validating link to facebook value "http://facebook.com" on facebook validator. Invalid value' );
        } catch(Exception $e){
            $this->assertTrue( true , 'Validating link to facebook value "http://facebook.com" on facebook validator. It is a invalid value, but test will catch its fail.' );
        }
        
        try{
            $this->obj->facebook('facebook.com');
            $this->fail('');
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( 'Validating link to facebook value "facebook.com" on facebook validator. Invalid value' );
        } catch(Exception $e){
            $this->assertTrue( true , 'Validating link to facebook value "facebook.com" on facebook validator. It is a invalid value, but test will catch its fail.' );
        }
        
        try{
            $this->obj->facebook('https://facebook.com.br');
            $this->fail('');
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( 'Validating link to facebook value "https://facebook.com.br" on facebook validator. Invalid value' );
        } catch(Exception $e){
            $this->assertTrue( true , 'Validating link to facebook value "https://facebook.com.br" on facebook validator. It is a invalid value, but test will catch its fail.' );
        }
        
        try{
            $this->obj->facebook('http://facebook.com.br');
            $this->fail('');
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( 'Validating link to facebook value "http://facebook.com.br" on facebook validator. Invalid value' );
        } catch(Exception $e){
            $this->assertTrue( true , 'Validating link to facebook value "http://facebook.com.br" on facebook validator. It is a invalid value, but test will catch its fail.' );
        }
        
        try{
            $this->obj->facebook('facebook.com.br');
            $this->fail('');
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( 'Validating link to facebook value "facebook.com.br" on facebook validator. Invalid value' );
        } catch(Exception $e){
            $this->assertTrue( true , 'Validating link to facebook value "facebook.com.br" on facebook validator. It is a invalid value, but test will catch its fail.' );
        }
        
    }
    
    function test_google_plus(){
        $this->assertEquals( $this->obj->google_plus('123456789'), 'https://plus.google.com/123456789', 'Validating plus.google user value 123456789 on plus.google validator');
        $this->assertEquals( $this->obj->google_plus('https://plus.google.com/123456789'), 'https://plus.google.com/123456789', 'Validating link to plus.google value "https://plus.google.com/123456789" on plus.google validator');
        $this->assertEquals( $this->obj->google_plus('http://plus.google.com/123456789'), 'http://plus.google.com/123456789', 'Validating link to plus.google value "http://plus.google.com/123456789" on plus.google validator');
        $this->assertEquals( $this->obj->google_plus('plus.google.com/123456789'), 'plus.google.com/123456789', 'Validating link to plus.google value "plus.google.com/123456789" on plus.google validator');
        $this->assertEquals( $this->obj->google_plus('https://plus.google.com/+CruzeiroBrOficial/posts'), 'https://plus.google.com/+CruzeiroBrOficial/posts', 'Validating link to plus.google value "https://plus.google.com/+CruzeiroBrOficial/posts" on plus.google validator');

        try{
            $this->obj->google_plus(null);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null value on plus.google validator. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validating null value on plus.google validator. It is a invalid value, but test will catch its fail." );
        }
        
        try{
            $this->obj->google_plus('https://plus.google.com');
            $this->fail('');
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( 'Validating link to plus.google value "https://plus.google.com" on plus.google validator. Invalid value' );
        } catch(Exception $e){
            $this->assertTrue( true , 'Validating link to plus.google value "https://plus.google.com" on plus.google validator. It is a invalid value, but test will catch its fail.' );
        }
        
        try{
            $this->obj->google_plus('http://plus.google.com');
            $this->fail('');
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( 'Validating link to plus.google value "http://plus.google.com" on plus.google validator. Invalid value' );
        } catch(Exception $e){
            $this->assertTrue( true , 'Validating link to plus.google value "http://plus.google.com" on plus.google validator. It is a invalid value, but test will catch its fail.' );
        }
        
        try{
            $this->obj->google_plus('plus.google.com');
            $this->fail('');
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( 'Validating link to plus.google value "plus.google.com" on plus.google validator. Invalid value' );
        } catch(Exception $e){
            $this->assertTrue( true , 'Validating link to plus.google value "plus.google.com" on plus.google validator. It is a invalid value, but test will catch its fail.' );
        }
        
        try{
            $this->obj->google_plus('https://plus.google.com.br');
            $this->fail('');
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( 'Validating link to plus.google value "https://plus.google.com.br" on plus.google validator. Invalid value' );
        } catch(Exception $e){
            $this->assertTrue( true , 'Validating link to plus.google value "https://plus.google.com.br" on plus.google validator. It is a invalid value, but test will catch its fail.' );
        }
        
        try{
            $this->obj->google_plus('http://plus.google.com.br');
            $this->fail('');
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( 'Validating link to plus.google value "http://plus.google.com.br" on plus.google validator. Invalid value' );
        } catch(Exception $e){
            $this->assertTrue( true , 'Validating link to plus.google value "http://plus.google.com.br" on plus.google validator. It is a invalid value, but test will catch its fail.' );
        }
        
        try{
            $this->obj->google_plus('plus.google.com.br');
            $this->fail('');
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( 'Validating link to plus.google value "plus.google.com.br" on plus.google validator. Invalid value' );
        } catch(Exception $e){
            $this->assertTrue( true , 'Validating link to plus.google value "plus.google.com.br" on plus.google validator. It is a invalid value, but test will catch its fail.' );
        }
        
    }
    
    function test_youtube(){
        $this->assertEquals( $this->obj->youtube('username'), 'https://youtube.com/username', 'Validating youtube user value username on youtube validator');
        $this->assertEquals( $this->obj->youtube('https://youtube.com/username'), 'https://youtube.com/username', 'Validating link to youtube value "https://youtube.com/username" on youtube validator');
        $this->assertEquals( $this->obj->youtube('http://youtube.com/username'), 'http://youtube.com/username', 'Validating link to youtube value "http://youtube.com/username" on youtube validator');
        $this->assertEquals( $this->obj->youtube('youtube.com/username'), 'youtube.com/username', 'Validating link to youtube value "youtube.com/username" on youtube validator');
        $this->assertEquals( $this->obj->youtube('https://youtube.com.br/username'), 'https://youtube.com.br/username', 'Validating link to youtube value "https://youtube.com.br/username" on youtube validator');
        $this->assertEquals( $this->obj->youtube('http://youtube.com.br/username'), 'http://youtube.com.br/username', 'Validating link to youtube value "http://youtube.com.br/username" on youtube validator');
        $this->assertEquals( $this->obj->youtube('youtube.com.br/username'), 'youtube.com.br/username', 'Validating link to youtube value "youtube.com.br/username" on youtube validator');
        $this->assertEquals( $this->obj->youtube('youtu.be/username'), 'youtu.be/username', 'Validating link to youtube value "youtu.be/username" on youtube validator');
        
        try{
            $this->obj->youtube(null);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null value on youtube validator. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validating null value on youtube validator. It is a invalid value, but test will catch its fail." );
        }
        
        try{
            $this->obj->youtube('https://youtube.com');
            $this->fail('');
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( 'Validating link to youtube value "https://youtube.com" on youtube validator. Invalid value' );
        } catch(Exception $e){
            $this->assertTrue( true , 'Validating link to youtube value "https://youtube.com" on youtube validator. It is a invalid value, but test will catch its fail.' );
        }
        
        try{
            $this->obj->youtube('http://youtube.com');
            $this->fail('');
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( 'Validating link to youtube value "http://youtube.com" on youtube validator. Invalid value' );
        } catch(Exception $e){
            $this->assertTrue( true , 'Validating link to youtube value "http://youtube.com" on youtube validator. It is a invalid value, but test will catch its fail.' );
        }
        
        try{
            $this->obj->youtube('youtube.com');
            $this->fail('');
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( 'Validating link to youtube value "youtube.com" on youtube validator. Invalid value' );
        } catch(Exception $e){
            $this->assertTrue( true , 'Validating link to youtube value "youtube.com" on youtube validator. It is a invalid value, but test will catch its fail.' );
        }
        
        try{
            $this->obj->youtube('https://youtube.com.br');
            $this->fail('');
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( 'Validating link to youtube value "https://youtube.com.br" on youtube validator. Invalid value' );
        } catch(Exception $e){
            $this->assertTrue( true , 'Validating link to youtube value "https://youtube.com.br" on youtube validator. It is a invalid value, but test will catch its fail.' );
        }
        
        try{
            $this->obj->youtube('http://youtube.com.br');
            $this->fail('');
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( 'Validating link to youtube value "http://youtube.com.br" on youtube validator. Invalid value' );
        } catch(Exception $e){
            $this->assertTrue( true , 'Validating link to youtube value "http://youtube.com.br" on youtube validator. It is a invalid value, but test will catch its fail.' );
        }
        
        try{
            $this->obj->youtube('youtube.com.br');
            $this->fail('');
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( 'Validating link to youtube value "youtube.com.br" on youtube validator. Invalid value' );
        } catch(Exception $e){
            $this->assertTrue( true , 'Validating link to youtube value "youtube.com.br" on youtube validator. It is a invalid value, but test will catch its fail.' );
        }
        
    }
    
    function test_linkedin(){
        $this->assertEquals( $this->obj->linkedin('username'), 'https://linkedin.com/username', 'Validating linkedin user value username on linkedin validator');
        $this->assertEquals( $this->obj->linkedin('https://linkedin.com/username'), 'https://linkedin.com/username', 'Validating link to linkedin value "https://linkedin.com/username" on linkedin validator');
        $this->assertEquals( $this->obj->linkedin('http://linkedin.com/username'), 'http://linkedin.com/username', 'Validating link to linkedin value "http://linkedin.com/username" on linkedin validator');
        $this->assertEquals( $this->obj->linkedin('linkedin.com/username'), 'linkedin.com/username', 'Validating link to linkedin value "linkedin.com/username" on linkedin validator');
        $this->assertEquals( $this->obj->linkedin('https://linkedin.com.br/username'), 'https://linkedin.com.br/username', 'Validating link to linkedin value "https://linkedin.com.br/username" on linkedin validator');
        $this->assertEquals( $this->obj->linkedin('http://linkedin.com.br/username'), 'http://linkedin.com.br/username', 'Validating link to linkedin value "http://linkedin.com.br/username" on linkedin validator');
        $this->assertEquals( $this->obj->linkedin('linkedin.com.br/username'), 'linkedin.com.br/username', 'Validating link to linkedin value "linkedin.com.br/username" on linkedin validator');
        $this->assertEquals( $this->obj->linkedin('http://www.linkedin.com/profile/view?id=382726&authType=NAME_SEARCH&authToken=uFm0&locale=en_US&trk=tyah&trkInfo=clickedVertical%3Amynetwork%2Cidx%3A1-1-1%2CtarId%3A1430236411904%2Ctas%3Arafeh'), 'http://www.linkedin.com/profile/view?id=382726&authType=NAME_SEARCH&authToken=uFm0&locale=en_US&trk=tyah&trkInfo=clickedVertical%3Amynetwork%2Cidx%3A1-1-1%2CtarId%3A1430236411904%2Ctas%3Arafeh', 'Validating link to linkedin value "http://www.linkedin.com/profile/view?id=382726&authType=NAME_SEARCH&authToken=uFm0&locale=en_US&trk=tyah&trkInfo=clickedVertical%3Amynetwork%2Cidx%3A1-1-1%2CtarId%3A1430236411904%2Ctas%3Arafeh" on linkedin validator');
        
        try{
            $this->obj->linkedin(null);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null value on linkedin validator. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validating null value on linkedin validator. It is a invalid value, but test will catch its fail." );
        }
        
        try{
            $this->obj->linkedin('https://linkedin.com');
            $this->fail('');
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( 'Validating link to linkedin value "https://linkedin.com" on linkedin validator. Invalid value' );
        } catch(Exception $e){
            $this->assertTrue( true , 'Validating link to linkedin value "https://linkedin.com" on linkedin validator. It is a invalid value, but test will catch its fail.' );
        }
        
        try{
            $this->obj->linkedin('http://linkedin.com');
            $this->fail('');
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( 'Validating link to linkedin value "http://linkedin.com" on linkedin validator. Invalid value' );
        } catch(Exception $e){
            $this->assertTrue( true , 'Validating link to linkedin value "http://linkedin.com" on linkedin validator. It is a invalid value, but test will catch its fail.' );
        }
        
        try{
            $this->obj->linkedin('linkedin.com');
            $this->fail('');
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( 'Validating link to linkedin value "linkedin.com" on linkedin validator. Invalid value' );
        } catch(Exception $e){
            $this->assertTrue( true , 'Validating link to linkedin value "linkedin.com" on linkedin validator. It is a invalid value, but test will catch its fail.' );
        }
        
        try{
            $this->obj->linkedin('https://linkedin.com.br');
            $this->fail('');
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( 'Validating link to linkedin value "https://linkedin.com.br" on linkedin validator. Invalid value' );
        } catch(Exception $e){
            $this->assertTrue( true , 'Validating link to linkedin value "https://linkedin.com.br" on linkedin validator. It is a invalid value, but test will catch its fail.' );
        }
        
        try{
            $this->obj->linkedin('http://linkedin.com.br');
            $this->fail('');
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( 'Validating link to linkedin value "http://linkedin.com.br" on linkedin validator. Invalid value' );
        } catch(Exception $e){
            $this->assertTrue( true , 'Validating link to linkedin value "http://linkedin.com.br" on linkedin validator. It is a invalid value, but test will catch its fail.' );
        }
        
        try{
            $this->obj->linkedin('linkedin.com.br');
            $this->fail('');
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( 'Validating link to linkedin value "linkedin.com.br" on linkedin validator. Invalid value' );
        } catch(Exception $e){
            $this->assertTrue( true , 'Validating link to linkedin value "linkedin.com.br" on linkedin validator. It is a invalid value, but test will catch its fail.' );
        }
        
    }
    
    function test_instagram(){
        $this->assertEquals( $this->obj->instagram('username'), 'https://instagram.com/username', 'Validating instagram user value username on instagram validator');
        $this->assertEquals( $this->obj->instagram('https://instagram.com/username'), 'https://instagram.com/username', 'Validating link to instagram value "https://instagram.com/username" on instagram validator');
        $this->assertEquals( $this->obj->instagram('http://instagram.com/username'), 'http://instagram.com/username', 'Validating link to instagram value "http://instagram.com/username" on instagram validator');
        $this->assertEquals( $this->obj->instagram('instagram.com/username'), 'instagram.com/username', 'Validating link to instagram value "instagram.com/username" on instagram validator');
        
        try{
            $this->obj->instagram(null);
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating null value on instagram validator. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validating null value on instagram validator. It is a invalid value, but test will catch its fail." );
        }
        
        try{
            $this->obj->instagram('https://instagram.com');
            $this->fail('');
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( 'Validating link to instagram value "https://instagram.com" on instagram validator. Invalid value' );
        } catch(Exception $e){
            $this->assertTrue( true , 'Validating link to instagram value "https://instagram.com" on instagram validator. It is a invalid value, but test will catch its fail.' );
        }
        
        try{
            $this->obj->instagram('http://instagram.com');
            $this->fail('');
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( 'Validating link to instagram value "http://instagram.com" on instagram validator. Invalid value' );
        } catch(Exception $e){
            $this->assertTrue( true , 'Validating link to instagram value "http://instagram.com" on instagram validator. It is a invalid value, but test will catch its fail.' );
        }
        
        try{
            $this->obj->instagram('instagram.com');
            $this->fail('');
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( 'Validating link to instagram value "instagram.com" on instagram validator. Invalid value' );
        } catch(Exception $e){
            $this->assertTrue( true , 'Validating link to instagram value "instagram.com" on instagram validator. It is a invalid value, but test will catch its fail.' );
        }
        
        try{
            $this->obj->instagram('https://instagram.com.br');
            $this->fail('');
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( 'Validating link to instagram value "https://instagram.com.br" on instagram validator. Invalid value' );
        } catch(Exception $e){
            $this->assertTrue( true , 'Validating link to instagram value "https://instagram.com.br" on instagram validator. It is a invalid value, but test will catch its fail.' );
        }
        
        try{
            $this->obj->instagram('http://instagram.com.br');
            $this->fail('');
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( 'Validating link to instagram value "http://instagram.com.br" on instagram validator. Invalid value' );
        } catch(Exception $e){
            $this->assertTrue( true , 'Validating link to instagram value "http://instagram.com.br" on instagram validator. It is a invalid value, but test will catch its fail.' );
        }
        
        try{
            $this->obj->instagram('instagram.com.br');
            $this->fail('');
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( 'Validating link to instagram value "instagram.com.br" on instagram validator. Invalid value' );
        } catch(Exception $e){
            $this->assertTrue( true , 'Validating link to instagram value "instagram.com.br" on instagram validator. It is a invalid value, but test will catch its fail.' );
        }
        
    }
    
    
    /**
    * @depends test_in
    */
    function test_slug(){
        $this->assertEquals( $this->obj->slug("testando-isto-daqui-2-vai-tirar-tudo"), "testando-isto-daqui-2-vai-tirar-tudo", "Checking slug function replacing interrogation point, number, spaces, etc");
        $this->assertEquals( $this->obj->slug("g-branco"), "g-branco","Testing abbreviation replacement");
        
        $this->assertEquals( $this->obj->slug($this->obj->slug("testando-isto-daqui-2-vai-tirar-tudo")), "testando-isto-daqui-2-vai-tirar-tudo", "Checking slug function slugified results as input and if return the same results on replacing interrogation point, number, spaces, etc");
        $this->assertEquals( $this->obj->slug($this->obj->slug("g-branco")), "g-branco","Testing slugified results as input and if return the same results on abbreviation replacement");
        $this->assertEquals( $this->obj->slug($this->obj->slug("g_branco")), "g_branco","Testing slugified results as input and if return the same results on abbreviation replacement");
        
        
        
        try{
            $this->obj->slug("I am not a slug");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating string value on slug validator. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validating string value on slug validator. It is a invalid value, but test will catch its fail." );
        }
    }
    
    /**
    * @depends test_slug
    */
    function test_slug_postgresql_column_name(){
        $this->assertEquals( $this->obj->slug_postgresql_column_name("testando_isto_daqui_2___vai_tirar_tudo"), "testando_isto_daqui_2___vai_tirar_tudo", "Checking slug function replacing interrogation point, number, spaces, etc");
        $this->assertEquals( $this->obj->slug_postgresql_column_name("g_branco"), "g_branco","Testing abbreviation replacement");
        
        $this->assertEquals( $this->obj->slug_postgresql_column_name($this->obj->slug_postgresql_column_name("testando_isto_daqui_2___vai_tirar_tudo")), "testando_isto_daqui_2___vai_tirar_tudo", "Checking slug function slugified results as input and if return the same results on replacing interrogation point, number, spaces, etc");
        $this->assertEquals( $this->obj->slug_postgresql_column_name($this->obj->slug_postgresql_column_name("g_branco")), "g_branco","Testing slugified results as input and if return the same results on abbreviation replacement");
        $this->assertEquals( $this->obj->slug_postgresql_column_name($this->obj->slug_postgresql_column_name("g_branco")), "g_branco","Testing slugified results as input and if return the same results on abbreviation replacement");
        $this->assertEquals( $this->obj->slug_postgresql_column_name($this->obj->slug_postgresql_column_name("g_branco_vamos_cortar_em_50_caracteres_para_eu_ver")), "g_branco_vamos_cortar_em_50_caracteres_para_eu_ver","Testing slugified results as input and if return the same results on abbreviation replacement");
        
        
        try{
            $this->obj->slug_postgresql_column_name("I am not a slug");
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating string value on slug validator. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validating string value on slug validator. It is a invalid value, but test will catch its fail." );
        }
    }
    
    
    /**
    * @depends test_slug_postgresql_column_name
    */
    function test_record_action(){
        $this->assertEquals( $this->obj->record_action( "I" ), "I", "Validating if there is variable value inside");
        $this->assertEquals( $this->obj->record_action( "U" ), "U", "Validating if there is variable value inside");
        $this->assertEquals( $this->obj->record_action( "D" ), "D", "Validating if there is variable value inside");
        
        
        try{
            $this->obj->record_action( "a" );
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating if there is variable value inside. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validating if there is variable value inside. It is a invalid value, but test will catch its fail." );
        }
        
        try{
            $this->obj->record_action( 1 );
            $this->fail( "" );
        } catch(PHPUnit_Framework_AssertionFailedError $e){
            $this->fail( "Validating if there is variable value inside. Invalid value" );
        } catch(Exception $e){
            $this->assertTrue( true , "Validating if there is variable value inside. It is a invalid value, but test will catch its fail." );
        }
    }
}