<?php
require_once __DIR__."/Filter.class.php";
use \Drall\PRS\BASE\Filter as Filter;

class FilterTest extends PHPUnit\Framework\TestCase{

    public $obj;


    protected function setUp(): void {
        $this->obj = new Filter();
    }


    protected function tearDown(): void {
        unset($this->obj);
    }


    function test_capitalize( ){
        $this->assertEquals( $this->obj->capitalize("test"), "Test", "Check single word for capitalize" );
        $this->assertEquals( $this->obj->capitalize("test test"), "Test Test", "Check for capitalize on double words" );

        $this->assertEquals( $this->obj->capitalize("test hi test"), "Test Hi Test", "Check for capitalize a phrase" );
        $this->assertEquals( $this->obj->capitalize("mAçÃ"), "Maçã", "Check single word with special latin letters for capitalize" );
    }
    
    function test_phrase_capitalize () {
    	$this->assertEquals( $this->obj->phrase_capitalize("test"), "Test", "Check single word for capitalize" );
    	$this->assertEquals( $this->obj->phrase_capitalize("test."), "Test.", "Check single word for capitalize" );
        $this->assertEquals( $this->obj->phrase_capitalize("test test"), "Test test", "Check for capitalize on double words" );

        $this->assertEquals( $this->obj->phrase_capitalize("test hi test"), "Test hi test", "Check for capitalize a phrase" );
        $this->assertEquals( $this->obj->phrase_capitalize("mAçÃ"), "Maçã", "Check single word with special latin letters for capitalize" );
        $this->assertEquals( $this->obj->phrase_capitalize("test hi test. ok"), "Test hi test. Ok", "Check for capitalize a phrase" );
        $this->assertEquals( $this->obj->phrase_capitalize("test hi test.  ok. Deu?"), "Test hi test.  Ok. Deu?", "Check for capitalize a phrase" );
        $this->assertEquals( $this->obj->phrase_capitalize("test hi test.ok"), "Test hi test.Ok", "Check for capitalize a phrase" );
    }

    function test_lower( ){
        $this->assertEquals( $this->obj->lower("TeStE"), "teste", "Testing single word with lower and uppercase to entire lowercase" );
        $this->assertEquals( $this->obj->lower("TESTE"), "teste", "Testing word in uppercase to lowercase" );
        $this->assertEquals( $this->obj->lower("MaÇÃ"), "maçã", "Testing word with special latin letters in uppercase to lowercase" );
    }

    function test_upper( ){
        $this->assertEquals( $this->obj->upper("TeStE"), "TESTE", "Testing single word with lower and uppercase to entire uppercase" );
        $this->assertEquals( $this->obj->upper("teste"), "TESTE", "Testing word in lowercase to uppercase" );
        $this->assertEquals( $this->obj->upper("mAçã"), "MAÇÃ", "Check single word with special latin letters for upper" );
    }
    
    function test_camelCase2SnakeCase(){
        $this->assertEquals( $this->obj->camelCase2SnakeCase("Id"), "id", "Testing word 'Id'" );
        $this->assertEquals( $this->obj->camelCase2SnakeCase("id"), "id", "Testing word 'id'" );
        $this->assertEquals( $this->obj->camelCase2SnakeCase("ProfessionalAddress"), "professional_address", "Testing word 'ProfessionalAddress'" );
        $this->assertEquals( $this->obj->camelCase2SnakeCase("ProfessionalAddress__c"), "professional_address__c", "Testing word 'ProfessionalAddress__c'" );
        $this->assertEquals( $this->obj->camelCase2SnakeCase("Professional_Address__c"), "professional_address__c", "Testing word 'Professional_Address__c'" );
        $this->assertEquals( $this->obj->camelCase2SnakeCase("Professional_Address__Test"), "professional_address__test", "Testing word 'Professional_Address__test'" );
    }
    

    function test_toAscii(  ){
        $this->assertEquals( $this->obj->toAscii("ÀùŔ"), "AuR", "Testing special characteres to ASCII" );
        $this->assertEquals( $this->obj->toAscii("Maçã"), "Maca", "Testing portuguese word with special characteres to ASCII" );
        $this->assertEquals( $this->obj->toAscii("House"), "House", "Testing English word without special characteres to ASCII" );
    }
    
    function test_charsetError2UTF8(  ){
        //Special charsets errors / problems
        $this->assertEquals( $this->obj->charsetError2UTF8(""),"Á","Testing special charset errors from ISO-8859-15 to UTF8");
        $this->assertEquals( $this->obj->charsetError2UTF8(""),"éê","Testing special charset errors from ISO-8859-15 to UTF8");
        $this->assertEquals( $this->obj->charsetError2UTF8("¡"),"í","Testing special charset errors from ISO-8859-15 to UTF8");
        $this->assertEquals( $this->obj->charsetError2UTF8("ä¢ø"),"õóºô","Testing special charset errors from ISO-8859-15 to UTF8");
        $this->assertEquals( $this->obj->charsetError2UTF8("£"),"ú","Testing special charset errors from ISO-8859-15 to UTF8");
    }
    
    function test_charsetError2Ascii(  ){
        //Special charsets errors / problems
        $this->assertEquals( $this->obj->charsetError2Ascii(""),"A","Testing special charset errors from ISO-8859-15 to UTF8");
        $this->assertEquals( $this->obj->charsetError2Ascii(""),"ee","Testing special charset errors from ISO-8859-15 to UTF8");
        $this->assertEquals( $this->obj->charsetError2Ascii("¡"),"i","Testing special charset errors from ISO-8859-15 to UTF8");
        $this->assertEquals( $this->obj->charsetError2Ascii("ä¢ø"),"ooºo","Testing special charset errors from ISO-8859-15 to UTF8");
        $this->assertEquals( $this->obj->charsetError2Ascii("£"),"u","Testing special charset errors from ISO-8859-15 to UTF8");
    }


    function test_trim( ){
        $this->assertEquals( $this->obj->trim(" Hi "), "Hi", "Checking trim function removing space from begin and from end of word");
        $this->assertEquals( $this->obj->trim(" Hi everyone. You are so special. "), "Hi everyone. You are so special.", "Checking trim function removing space from begin and from end of phrase");
        $this->assertEquals( $this->obj->trim(" Hi everyone. You are so special."), "Hi everyone. You are so special.", "Checking trim function removing space from begin of phrase");
        $this->assertEquals( $this->obj->trim("Hi everyone. You are so special. "), "Hi everyone. You are so special.", "Checking trim function removing space from end of phrase");
        $this->assertEquals( $this->obj->trim( null ), "", "Testing null input/output");
        //Take care. The spaces below are not regular space. They are special character ' '
        $this->assertEquals( $this->obj->trim(' Muangthong '), 'Muangthong', "Testing to remove special invisible character space");
    }

    function test_onlyNumber( ){
        $this->assertEquals( $this->obj->onlyNumber("32.340-040"), "32340040", "Checking onlyNumber function removing '.' and '-' from number");
    }

    function test_onlyA2Z( ){
        $this->assertEquals( $this->obj->onlyA2Z("Testando isto daqui 2?. Vai tirar tudo"), "TestandoistodaquiVaitirartudo", "Checking onlyA2Z function removing spaces, interrogation point, number, etc");
    }

    function test_onlySpaceA2Z( ){
        $this->assertEquals( $this->obj->onlySpaceA2Z("Testando isto daqui 2?. Vai tirar tudo"), "Testando isto daqui  Vai tirar tudo", "Checking onlySpaceA2Z function removing interrogation point, number, etc");
        $this->assertEquals( $this->obj->onlySpaceA2Z("G.BRANCO"), "GBRANCO","Testing abbreviation");
    }

    function test_multipleSpace2Single( ){
        $this->assertEquals( $this->obj->multipleSpaces2Single("Testando  isto  daqui.     Deu    certo?"), "Testando isto daqui. Deu certo?", "Testing 'multipleSpaces2Single' replacing multiple to single");
    }
    
    function test_removeFromArray( ){
        $this->assertEquals( $this->obj->removeFromArray( array( "DE","DA","DO","DOS","DAS", "COM", "POR", "PRA", "PARA", "EM", "AO", "AOS", "NO", "NA", "NOS", "NAS", "A", "E", "I", "O", "U" ) ), array(), "Testing remove all itens" );

        $this->assertEquals( $this->obj->removeFromArray( array( "DE","A", "DA","b", "DO","C","DOS","DAS", "COM", "POR", "PRA","d" ) ), array("b","C","d"), "Testing remove all itens, but returning some elements" );
    }

    function test_punctuationMarks2Space( ){
        $this->assertEquals( $this->obj->punctuationMarks2Space( "test,right,now" ), "test right now", "Testing replace punctuationMarks to space");
        $this->assertEquals( $this->obj->punctuationMarks2Space( "test,right,now!!!Right." ), "test right now   Right ", "Testing replace punctuationMarks to space");
    }

    /**
    * @depends test_punctuationMarks2Space
    */
    function test_phrase2Words( ){
        $this->assertEquals( $this->obj->phrase2Words("Testando isto daqui 2?. Vai tirar tudo"), array("Testando","isto","daqui","2","Vai","tirar","tudo"), "Testing phrase2Words");

        $this->assertEquals( $this->obj->phrase2Words("Será que isto está funcionando????Sim!!!!Ou não???"), array("Será","que","isto","está","funcionando","Sim","Ou","não"), "Testing phrase2Words");

        $this->assertEquals( $this->obj->phrase2Words("A menina, de nome Francisca, é campeã!!!!!!!!Parabéns para a garota!"), array("A","menina","de","nome","Francisca","é","campeã","Parabéns","para","a","garota"), "Testing phrase2Words");
        $this->assertEquals( $this->obj->phrase2Words("G.BRANCO"), array("G","BRANCO"),"Testing abbreviation");
    }
    
    function test_int2null( ){
        $this->assertEquals( $this->obj->int2null(0), null, "Validating int2null value must be null");
        $this->assertEquals( $this->obj->int2null(-1), -1, "Validating int2null value must be -1");
        $this->assertEquals( $this->obj->int2null(1), 1, "Validating int2null value must be 1");
    }
    
    function test_string2null( ){
        $this->assertEquals( $this->obj->string2null(""), null, "Validating string2null value must be null");
        $this->assertEquals( $this->obj->string2null("   "), "   ", "Validating string2null value must be 3 string spaces");
        $this->assertEquals( $this->obj->string2null(" "), " ", "Validating string2null value must be a string space");
        $this->assertEquals( $this->obj->string2null("a"), "a", "Validating string2null value must be letter 'a'");
    }
    
    function test_val2DBoolean(){
        $this->assertEquals( $this->obj->val2DBoolean(true), true, "Value is acceptable boolean true");
        $this->assertEquals( $this->obj->val2DBoolean(false), false, "Value is acceptable boolean false");
        $this->assertEquals( $this->obj->val2DBoolean("true"), true, "Value is acceptable boolean 'true'");
        $this->assertEquals( $this->obj->val2DBoolean("false"), false, "Value is acceptable boolean 'false'");
        
        
        $this->assertEquals( $this->obj->val2DBoolean("t"), true, "Value is acceptable boolean 't'");
        $this->assertEquals( $this->obj->val2DBoolean("f"), false, "Value is acceptable boolean 'f'");
        
        $this->assertEquals( $this->obj->val2DBoolean(0), false, "Value is acceptable boolean 0");
        $this->assertEquals( $this->obj->val2DBoolean(1), true, "Value is acceptable boolean 1");
        
        $this->assertEquals( $this->obj->val2DBoolean(0.0), false, "Value is acceptable boolean 0.0");
        
        $this->assertEquals( $this->obj->val2DBoolean(null), false, "Value is acceptable boolean null");
        $this->assertEquals( $this->obj->val2DBoolean([]), false, "Value is acceptable boolean emtpy array");
        $this->assertEquals( $this->obj->val2DBoolean(" "), true, "Value is acceptable boolean space");
        $this->assertEquals( $this->obj->val2DBoolean(""), false, "Value is acceptable boolean empty string");
        $this->assertEquals( $this->obj->val2DBoolean("0"), false, "Value is acceptable boolean space");
        $this->assertEquals( $this->obj->val2DBoolean("1"), true, "Value is acceptable boolean space");
        $this->assertEquals( $this->obj->val2DBoolean("T"), true, "Value is acceptable boolean space");
        $this->assertEquals( $this->obj->val2DBoolean("F"), true, "Value is acceptable boolean space");
        $this->assertEquals( $this->obj->val2DBoolean("aaa"), true, "Value is acceptable boolean space");
    }
    
    function test_normalizeTwitterLink(){
        $obj = $this->obj;

        $this->assertEquals($this->obj->normalizeTwitterLink('@maajdrall'),'http://www.twitter.com/maajdrall', "Test @twitter_username pattern");
        $this->assertEquals($this->obj->normalizeTwitterLink('maajdrall'),'http://www.twitter.com/maajdrall', "Test just twitter_username pattern");
        $this->assertEquals($this->obj->normalizeTwitterLink('twitter.com/maajdrall'),'http://twitter.com/maajdrall', "Test twitter url without www pattern");
        $this->assertEquals($this->obj->normalizeTwitterLink('www.twitter.com/maajdrall'),'http://www.twitter.com/maajdrall', "Test twitter url without www pattern");
        $this->assertEquals($this->obj->normalizeTwitterLink('http://www.twitter.com/maajdrall'),'http://www.twitter.com/maajdrall', "Test twitter url http pattern");
        $this->assertEquals($this->obj->normalizeTwitterLink('https://www.twitter.com/maajdrall'),'https://www.twitter.com/maajdrall', "Test twitter url https pattern");
        //Test capitalize remove filter
        $this->assertEquals($this->obj->normalizeTwitterLink('@maajDrall'),'http://www.twitter.com/maajdrall', "Test @twitter_username pattern and to lower");
    }
    
    function test_normalizeWebsiteLink(){
        $obj = $this->obj;

        $this->assertEquals($this->obj->normalizeWebsiteLink('drall.com.br'), 'http://drall.com.br',"Test website url without www pattern");
        $this->assertEquals($this->obj->normalizeWebsiteLink('www.drall.com.br'), 'http://www.drall.com.br',"Test website url with www pattern");
        $this->assertEquals($this->obj->normalizeWebsiteLink('http://drall.com.br'), 'http://drall.com.br',"Test website url without www, but with http:// pattern");
        $this->assertEquals($this->obj->normalizeWebsiteLink('https://www.drall.com.br'), 'https://www.drall.com.br',"Test website url with https:// pattern");
        $this->assertEquals($this->obj->normalizeWebsiteLink('www.Drall.com.br'), 'http://www.drall.com.br',"Test website url with www pattern and to lower");
    }
    
    function test__default(){
        $obj = $this->obj;
        
        $this->assertEquals( $this->obj->_default(null, "oi"), "oi", "Checking if default filter is replacing null by default value");
        $this->assertEquals( $this->obj->_default(0, "oi"), 0, "Checking if default filter is not replacing integer zero by default value");
        $this->assertEquals( $this->obj->_default("", "oi"), "", "Checking if default filter is not replacing empty string by default value");
        $this->assertEquals( $this->obj->_default(" ", "oi"), " ", "Checking if default filter is not replacing string space by default value");
        $this->assertEquals( $this->obj->_default("", 0), "", "Checking if default filter is not replacing string space by default empty zero value");
        $this->assertEquals( $this->obj->_default(null, 0), 0, "Checking if default filter is replacing string space by default empty zero value");
    }
    
    function test_slug(){
        $obj = $this->obj;

        $this->assertEquals( $this->obj->slug("Testando isto daqui 2?. Vai tirar tudo"), "testando-isto-daqui-2-vai-tirar-tudo", "Checking slug function replacing interrogation point, number, spaces, etc");
        $this->assertEquals( $this->obj->slug("G.BRANCO"), "g-branco","Testing abbreviation replacement");
        
        $this->assertEquals( $this->obj->slug($this->obj->slug("Testando isto daqui 2?. Vai tirar tudo")), "testando-isto-daqui-2-vai-tirar-tudo", "Checking slug function slugified results as input and if return the same results on replacing interrogation point, number, spaces, etc");
        $this->assertEquals( $this->obj->slug($this->obj->slug("G.BRANCO")), "g-branco","Testing slugified results as input and if return the same results on abbreviation replacement");
        $this->assertEquals( $this->obj->slug($this->obj->slug("G_BRANCO")), "g_branco","Testing slugified results as input and if return the same results on abbreviation replacement");
    }
    
    function test_slug_postgresql_column_name(){
    	$obj = $this->obj;

        $this->assertEquals( $this->obj->slug_postgresql_column_name("Testando isto daqui 2?. Vai tirar tudo"), "testando_isto_daqui_2___vai_tirar_tudo", "Checking slug function replacing interrogation point, number, spaces, etc");
        $this->assertEquals( $this->obj->slug_postgresql_column_name("G.BRANCO"), "g_branco","Testing abbreviation replacement");
        
        $this->assertEquals( $this->obj->slug_postgresql_column_name($this->obj->slug_postgresql_column_name("Testando isto daqui 2?. Vai tirar tudo")), "testando_isto_daqui_2___vai_tirar_tudo", "Checking slug function slugified results as input and if return the same results on replacing interrogation point, number, spaces, etc");
        $this->assertEquals( $this->obj->slug_postgresql_column_name($this->obj->slug_postgresql_column_name("G.BRANCO")), "g_branco","Testing slugified results as input and if return the same results on abbreviation replacement");
        $this->assertEquals( $this->obj->slug_postgresql_column_name($this->obj->slug_postgresql_column_name("G_BRANCO")), "g_branco","Testing slugified results as input and if return the same results on abbreviation replacement");
        $this->assertEquals( $this->obj->slug_postgresql_column_name($this->obj->slug_postgresql_column_name("G_BRANCO-vamos_cortar_em-50-caracteres para eu ver que está funcionando corretamente")), "g_branco_vamos_cortar_em_50_caracteres_para_eu_ver","Testing slugified results as input and if return the same results on abbreviation replacement");
    }
    
    function test_clean_html(){
    	$obj = $this->obj;

    	/*
    	You might wonder why trim(html_entity_decode('&nbsp;')); doesn't reduce the string to an empty string, that's because the '&nbsp;' entity is not ASCII code 32 (which is stripped by trim()) but ASCII code 160 (0xa0) in the default ISO 8859-1 encoding.
    	&nbsp; = ' ' != ' '
    	*/
        $this->assertEquals( $this->obj->clean_html("Testando &nbsp;isto daqui <b>2</b>?. <p class='ok'>Vai tirar tudo</p>.Não"), "Testando  isto daqui 2?. Vai tirar tudo.Não", "Remove just the HTMK tags and not its contents");
        
    }
    
    function test_record_action2i_status(){
        $this->assertEquals( $this->obj->record_action2i_status("I"), "S", "Check convert 'I' to 'S'" );
        $this->assertEquals( $this->obj->record_action2i_status("U"), "S", "Check  convert 'U' to 'S'" );
        $this->assertEquals( $this->obj->record_action2i_status("D"), "D", "Check  convert 'D' to 'D'" );
        $this->assertEquals( $this->obj->record_action2i_status("drall"), "D", "Check  convert 'drall' to 'D'" );
    }
    
    function test_cpf(){
        $this->assertEquals( $this->obj->cpf("12345678901"), "123.456.789-01", "Check cpf convertion" );
        $this->assertEquals( $this->obj->cpf("00131415161"), "001.314.151-61", "Check cpf convertion" );
    }
    
    function test_cep(){
        $this->assertEquals( $this->obj->cep("32340040"), "32340-040", "Check cep convertion" );
        $this->assertEquals( $this->obj->cep("00131415"), "00131-415", "Check cep convertion" );
    }
    
    function test_cnpj(){
        $this->assertEquals( $this->obj->cnpj("12345678901234"), "12.345.678/9012-34", "Check cnpj convertion" );
        $this->assertEquals( $this->obj->cnpj("00131415161718"), "00.131.415/1617-18", "Check cnpj convertion" );
    }
    
    function test_datehour(){
    	$tests = [
    		'1420'=>'14:20'
    		,'20190405'=>'2019-04-05'
    		,'201904051420'=>'2019-04-05 14:20'
    		,'20190405 1420'=>'2019-04-05 14:20'
    		,'20190405142030'=>'2019-04-05 14:20:30'
    		,'20190405 142030'=>'2019-04-05 14:20:30'
    	];
    	
    	foreach ($tests as $test => $result) {
    		$output = $this->obj->datehour($test);
    		$this->assertEquals($output,$result);
    	}
    }
    
    function test_camelCase2snake_case(){
    	$tests = array(
			'simpleTest' => 'simple_test',
			'easy' => 'easy',
			'HTML' => 'html',
			'simpleXML' => 'simple_xml',
			'PDFLoad' => 'pdf_load',
			'startMIDDLELast' => 'start_middle_last',
			'AString' => 'a_string',
			'Some4Numbers234' => 'some4_numbers234',
			'TEST123String' => 'test123_string',
			'hello_world' => 'hello_world',
			'hello__world' => 'hello__world',
			'_hello_world_' => '_hello_world_',
			'hello_World' => 'hello_world',
			'HelloWorld' => 'hello_world',
			'helloWorldFoo' => 'hello_world_foo',
			'hello-world' => 'hello-world',
			'myHTMLFiLe' => 'my_html_fi_le',
			'aBaBaB' => 'a_ba_ba_b',
			'BaBaBa' => 'ba_ba_ba',
			'libC' => 'lib_c'
		);
		
		
		foreach ($tests as $test => $result) {
			$output = $this->obj->camelCase2snake_case($test);
			$this->assertEquals($output,$result);
		}
    }
    
    function test_monthEnglish2number(){
    	$tests = [
    		'jan'=>'01'
    		,'may'=>'05'
    		,'november'=>'11'
    		,'dec'=>'12'
    	];
    	
    	foreach ($tests as $test => $result) {
    		$output = $this->obj->monthEnglish2number($test);
    		$this->assertEquals($output,$result);
    	}
    	
    }
    
    function test_monthPtBR2number(){
    	$tests = [
    		'jan'=>'01'
    		,'mai'=>'05'
    		,'novembro'=>'11'
    		,'dez'=>'12'
    	];
    	
    	foreach ($tests as $test => $result) {
    		$output = $this->obj->monthPtBR2number($test);
    		$this->assertEquals($output,$result);
    	}
    }
    
    
    function test_between_str(){
    	$this->assertEquals($this->obj->between_str("<a>foo</a>","<a>", "</a>"),"foo");
    	//Sugestion should be the answer <a>foo</a>, but in the first step, I disagree
    	$this->assertEquals($this->obj->between_str("<a><a>foo</a></a>","<a>", "</a>"),"<a>foo");
    	$this->assertEquals($this->obj->between_str("Some strings } are very {weird}, dont you think?","{", "}"),"weird");
    	$this->assertEquals($this->obj->between_str("<a></a>","<a>", "</a>"),"");
    	$this->assertEquals($this->obj->between_str("<a>foo<a>","<a>", "<a>"),'foo');
    	$this->assertEquals($this->obj->between_str("<a>foo","<a>", "</a>"),null);
    	$this->assertEquals($this->obj->between_str("<a>foo</a>","<a>", "<a>"),null);
    }
    
    function test_ensure_left(){
		$this->assertEquals($this->obj->ensure_left("/subdir","/"),"/subdir");
		$this->assertEquals($this->obj->ensure_left("subdir","/"),"/subdir");
		$this->assertEquals($this->obj->ensure_left("/subdir/","/"),"/subdir/");
		$this->assertEquals($this->obj->ensure_left("subdir/","/"),"/subdir/");
    	
    }
    
    function test_ensure_right(){
		$this->assertEquals($this->obj->ensure_right("/subdir","/"),"/subdir/");
		$this->assertEquals($this->obj->ensure_right("subdir","/"),"subdir/");
		$this->assertEquals($this->obj->ensure_right("/subdir/","/"),"/subdir/");
		$this->assertEquals($this->obj->ensure_right("subdir/","/"),"subdir/");
    }
    
    
    function test_initials(){
    	$this->assertEquals($this->obj->initials("First"),"F");
    	$this->assertEquals($this->obj->initials("First Last"),"FL");
    	$this->assertEquals($this->obj->initials("First Middle1 Middle2 Middle3 Last"),"FMMML");
    }
}