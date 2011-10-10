<?php

namespace gosquared\lib;

class list_functions extends gosquared_func {
    protected $params;
    
    public function __construct() {
        parent::__construct();
        $this->function_name = $this->parse_function_name(__CLASS__);
    }

    public function exec($params = array()){
        $this->params = $params;
        return $this->_exec();
    }
    
}

?>