<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * Copyright © 2011 - 2013 Modernized Media, LLC.
 * All Rights Reserved. No part of this code may be reproduced without Modernized Media's express consent.
 * http://www.modernizedmedia.com
 */

class Object_Validator {
    private $name = null;
    private $value = null;
    private $errors = array();
    
    private $allow_null = array();
    private $allow_empty = array();
    
    public function __construct() {}
    
    public function set_attribute($name, $value) {
        $this->name = $name;
        $this->value = $value;
    }
    
    public function run(&$errors) {
        foreach($this->allow_null as $field=>$value) {
            if($value === null && array_key_exists($field, $this->allow_null)) {
                unset($this->errors[$field]);
            }
        }
        
        foreach($this->allow_empty as $field=>$value) {
            if($value === null && array_key_exists($field, $this->allow_null)) {
                // nothing to do here, it's already allowed to be null
            }
            else if($value === "") {
                // no more errors, "" is allowed
                unset($this->errors[$field]);
            } 
        }
        if($this->value === null && !$this->allow_null) {
            $this->errors = array(); // reset the errors, none of the validations apply if the value is null
            $this->log_error('null', "$this->name must not be null.");
        } else if($this->value === "" && !$this->allow_empty) {
            $this->errors = array(); // reset the errors, none of the validations apply if the value is empty
            $this->log_error('empty', "$this->name must not be empty.");
        }
        
        $errors = $this->errors;
        return empty($errors);
    }
    
    /* settings */
    public function allow_empty($opt=true) {
        if($opt == true) {
            $this->allow_empty[$this->name] = $this->value;
        }
        
        return $this;
    }
    public function allow_null($opt=true) {
        if($opt == true) {
            $this->allow_null[$this->name] = $this->value;
        }
        return $this;
    }
    
    /* Validations */
    
    public function min_length($length) {
        if(strlen($this->value) < abs($length)) {
            $this->log_error('length', "$this->name must be at least $length characters long.");
        }
        
        return $this;
    }
    
    public function max_length($length) {        
        if(strlen($this->value) > abs($length)) {
            $this->log_error('length', "$this->name must be fewer than $length characters long.");
        }
        
        return $this;
    }
    
    public function matches($pattern) {
        $match = @preg_match($pattern, $this->value);
        
        if ( $match === false) {
            // pattern is not a regex, so check string equality 
            if($this->value != $pattern) {
                $this->log_error('match', "$this->name is of invalid format.");
            }
        } else {
            // preg_match worked
            if($match == 0) { // no match
                $this->log_error('match', "$this->name is of invalid format.");
            }
        }
        
        return $this;
    }
    
    public function strictly_matches($pattern) {
        if($this->value === $pattern) {
            $this->log_error('match', "$this->name is of invalid format.");
        }
            
        return $this;
    }
    
    public function matches_regex($pattern) {
        $match = @preg_match($pattern, $this->value);
        if($match == 0) { // no match
            $this->log_error('match', "$this->name is of invalid format.");
        }
            
        return $this;
    }
    
    public function is_email() {
        if(!filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
            $this->log_error('email', "$this->name must be a valid email address.");
        }
        
        return $this;
    }
    
    public function is_boolean() {
        if(!is_bool($this->value)) {
            $this->log_error('type', "$this->name must be boolean");
        }
        
        return $this;
    }
    
    public function is_date($format='Y-m-d H:i:s') {
        if($this->value != date($format, strtotime($this->value))) {
            $this->log_error('format', "$this->name must be a date in the format '$format'");
        }
        
        return $this;
    }
    
    public function is_integer() {
        if(!is_int($this->value)) {
            $this->log_error('type', "$this->name must be an integer");
        }
        
        return $this;
    }
    
    public function is_number() {
        if(!is_numeric($this->value)) {
            $this->log_error('type', "$this->name must be numeric");
        }
        
        return $this;
    }
    
    public function is_required() {
        if(empty($this->value)) {
            $this->log_error('required', "$this->name is required");
        }
        return $this;
    }
    
    public function param_is_true($param, $message="") {
        if($param !== TRUE) {
            if(empty($message)) {
                $message = "$this->name has a param error";
            }
            $this->log_error('param',$message);
        }
        return $this;
    }
    public function param_is_false($param, $message="") {
        if($param !== FALSE) {
            if(empty($message)) {
                $message = "$this->name has a param error";
            }
            $this->log_error('param',$message);
        }
        return $this;
    }
    public function is_unique($model, $except=array(), $column = null) {
        if($column == null) $column = $this->name;
        
        $test = $model->get_by(array($column=>$this->value));
        if(!empty($test)) {
            foreach($except as $key=>$value) {
                if($test->$key == $value) {
                    // matches an exception
                    return $this;
                }
            }
            
            $this->log_error('unique', "$this->name must be unique.  '$this->value' is already taken.");
        }
        
        return $this;
    }
    
    public function is_greater_than($number, $name='') {
        if(!($this->value > $number)) {
            if(empty($name)) $name = $number;
            $this->log_error('greater', "$this->name must be greater than $name");
        }
        
        return $this;
    }
    
    public function is_less_than($number, $name='') {
        if(!($this->value < $number)) {
            if(empty($name)) $name = $number;
            $this->log_error('less', "$this->name must be less than $name");
        }
    }
    
    private function log_error($type, $message) {
        if(!isset($this->errors[$this->name])) 
            $this->errors[$this->name] = array();
        
        $this->errors[$this->name][$type] = $message;
    }
    
    public function is_core_id() {
        if(strlen($this->value) != 36) {
            $this->log_error('id', "$this->name is not a core id");
        }
        return $this;
    }
}

/**
 *
 * @author Lea
 */
abstract class Validateable {
    
    abstract protected function validate();
    
    final public function validation_errors($for_display = false) {
        if(isset($this->_validation_errors)) {
            if($for_display) {
                $errors = array();
                foreach($this->_validation_errors as $field=>$error) {
                    foreach($error as $type=>$message) {
                        $errors[] = ucfirst($message);
                    }
                }
                
                return implode(', ',$errors);
            } else {
                return $this->_validation_errors;
            }
        } else return array();
    }
    
    final public function is_valid() {
        $this->validate();
        return $this->run_validator();
    }
    
    final public function is_invalid() {
        return !$this->is_valid();
    }
    
    final protected function validates($attribute, $name='', $value=null) {
        if(empty($name)) $name = $attribute;
        if($value === null) {
            $value = $this->{$attribute};
        }
        if(!isset($this->_object_validator) || $this->_object_validator == null) {
            $this->_object_validator = new Object_Validator();
        }
        
        $this->_object_validator->set_attribute($name, $value);
        
        return $this->_object_validator;
    }
    
    final public function run_validator() {
        $errors = array();
        $valid = $this->_object_validator->run($errors);
        
        unset($this->_object_validator);
        unset($this->_validation_errors);
        
        if(!empty($errors)) {
            $this->_validation_errors = $errors;
        }
        
        return $valid;
    }
}
