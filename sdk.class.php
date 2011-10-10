<?php

namespace gosquared;

ini_set('display_errors', 'On');

require __DIR__.'/config.php';

define('API_ENDPOINT', 'api.gosquared.com');
define('SDK_NO_SUCH_FUNCTION', 1000);
define('API_EMPTY_OR_INVALID_RESPONSE', 1100);

function gosquared_autoload($class) {
    if(!$class)return false;
    $class = explode('\\', $class);
    if (count($class) > 1 && $class[0] == 'gosquared')
        array_shift($class);
    $class = implode('/', $class);
    $class = __DIR__ . "/$class.php";
    $success = @include($class);
    if (!$success)
        throw new autoload_exception("Could not locate lib for class $class");
}

spl_autoload_register(__NAMESPACE__ . '\gosquared_autoload');

class gosquared_exception extends \Exception {
    
}

;

class autoload_exception extends gosquared_exception {
    
}

;

class sdk_function_exception extends gosquared_exception {
    
}

;

class api_function_exception extends gosquared_exception {
    
}

;

class transport_exception extends gosquared_exception {
    
}

;

class sdk {
    private $protocol;
    private $api_key;
    private $site_id;
    
    function __construct($site_token, $api_key = false, $secure = false) {
        $this->protocol = $secure ? 'https' : 'http';
        $this->api_key = $api_key ? $api_key : API_KEY;
        $this->site_token = $site_token;
    }

    function __call($name, $args) {
        $class = "\gosquared\lib\\$name";
        try {
            $f = new $class();
            $f->site_token = $this->site_token;
            $f->api_key = $this->api_key;
            $f->protocol = $this->protocol;
            return call_user_func_array(array($f, 'exec'), $args);
        } catch (sdk_function_exception $e) {
            throw new gosquared_exception("Function encountered error: " . $e->getMessage(), $e->getCode(), $e);
        } catch (autoload_exception $e) {
            throw new gosquared_exception("No such function $name", SDK_NO_SUCH_FUNCTION, $e);
        }
    }

}
?>
