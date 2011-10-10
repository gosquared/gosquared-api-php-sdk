<?php

namespace gosquared;
ini_set('display_errors', 'On');

// Define config
define('API_KEY', '');
define('SDK_NO_SUCH_FUNCTION', 1000);

function gosquared_autoload($class){
    $class = explode('\\', $class);
    if($class[0] == 'gosquared') array_shift ($class);
    $class = implode('/', $class);
    $class = __DIR__."/$class.php";
    //echo $class;
    //$class = str_replace('\\', '/', $class);
    $success = @include($class);
    if(!$success) throw new autoload_exception("Could not locate lib for class $class");
}

spl_autoload_register(__NAMESPACE__.'\gosquared_autoload');

class gosquared_exception extends \Exception{};
class autoload_exception extends gosquared_exception{};
class sdk_function_exception extends gosquared_exception{};
class api_function_exception extends gosquared_exception{};

class gosquared {
    
    function __construct($api_key = false){
	$this->api_key = $api_key ? $api_key : API_KEY;
    }
    
    function __call($name, $args){
	$class = "\gosquared\lib\\$name";
	try{
	    $f = new $class($args);
	}
	catch(autoload_exception $e){
	    throw new gosquared_exception("No such function $name", SDK_NO_SUCH_FUNCTION, $e);
	}
    }
}

$g = new gosquared;
$g->visitors();

?>
