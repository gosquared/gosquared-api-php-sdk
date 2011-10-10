<?php

namespace gosquared\lib;

class gosquared_func{
    private $result_limit = 10;
    public $function_name = '';
    
    function __construct() {

    }

    public function _exec(){
        $response = $this->fetch();
        $response = json_decode($response);
        $this->check_response_errors($response);
        //$response = $response->{$this->function_name};
        return $response;
    }
    
    public function parse_function_name($name){
        return array_pop(explode('\\', $name));
    }
    
    public function check_response_errors($response){
        if(!$response){
            throw new \gosquared\api_function_exception("Empty or invalid response payload: $this->raw_response", API_EMPTY_OR_INVALID_RESPONSE);
        }
        
        if(isset($response->error)){
            throw new \gosquared\api_function_exception($response->error->message, $response->error->code);
        }
        
        $func_name = $this->function_name;
        if(isset($response->$func_name->error)){
            throw new \gosquared\api_function_exception($response->$func_name->error->message, $response->$func_name->error->code);
        }
        
        return $response;
    }
    
    protected function generate_request_url(){
        $request_url = $this->protocol . '://' .
                       API_ENDPOINT . '/' . 
                       $this->function_name . '?' .
                       $this->build_params()
        ;
        return $request_url;
    }
    
    protected function build_params(){
        $this->params['api_key'] = $this->api_key;
        $this->params['site_token'] = $this->site_token;
        $query = http_build_query($this->params);
        return $query;
    }
    
    protected function fetch(){
        $c = curl_init();
        
        curl_setopt($c, CURLOPT_URL, $this->generate_request_url());
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        
        $response = curl_exec($c);
        $this->raw_response = $response;
        if(!$response){
            throw new transport_exception(curl_error($c), curl_error($c));
        }
        
        return $response;
    }

}