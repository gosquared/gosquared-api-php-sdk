<?php
require_once(dirname(__FILE__) . '/simpletest/autorun.php');
require_once(dirname(__FILE__) . '/simpletest/unit_tester.php');
require __DIR__.'/../sdk.class.php';
define('SITE_TOKEN', 'GSN-123456-X'); // Put the token of the site to test on the API here

class TestResponses extends UnitTestCase{
    function testFunctions(){
        // Lazy but quick
        $functions = array_map(function($e){return substr(basename($e), 0, -4);}, array_diff(glob(__DIR__.'/../lib/*.php'), array(__DIR__.'/../lib/gosquared_func.php')));
        foreach($functions as $function){
            $g = new gosquared\sdk(SITE_TOKEN);
            $r = $g->$function();
            $this->assertIsA(new stdClass, 'stdClass');
        }
    }
}
?>
