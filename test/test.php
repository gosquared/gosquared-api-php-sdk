<?php
require_once(dirname(__FILE__) . '/simpletest/autorun.php');
require_once(dirname(__FILE__) . '/simpletest/unit_tester.php');
require __DIR__.'/../sdk.class.php';

class TestResponses extends UnitTestCase{
    function testFunctions(){
        // Lazy but quick
        $functions = array_map(function($e){return substr(basename($e), 0, -4);}, array_diff(glob(__DIR__.'/../lib/*.php'), array(__DIR__.'/../lib/gosquared_func.php')));
        foreach($functions as $function){
            $g = new gosquared\sdk('GSN-2194840-F');
            $r = $g->$function();
            $this->assertIsA(new stdClass, 'stdClass');
        }
    }
}
?>
