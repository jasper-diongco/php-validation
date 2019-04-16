<?php
	class Validation {
		public $errors;
		public $data;

		public static function validate($data=[],$rules=[]) {
			$validation = new Validation();
			$validation->validateData($data, $rules);

			return $validation->getErrors();
		}

		public function getErrors() {
			return $this->errors;
		}

		public function validateData($data=[],$rules=[]) {
			$this->data = $data;
			//iterate through rules
			foreach ($rules as $field => $rules_str) {
				$rules_arr = explode("|", $rules_str);

				//iterate through rules_arr
				foreach($rules_arr as $rule) {
					//check if has argument
					if(preg_match('/:/', $rule)) {
						//with argument

						//explode to get the rule and the args
						$rule_with_args = explode(':', $rule);

						//get the rule, which is the first element
						$rule = $rule_with_args[0];
						//get the args, second element
						$args = $rule_with_args[1];

						//test the field

						$is_valid = $this->$rule($field, $data[$field], $args);

						//break the loop if not valid
						if(!$is_valid) {
							break;
						}
					} else {
						//without argument

						//test the field

						$is_valid = $this->$rule($field, $data[$field]);

						//break the loop if not valid
						if(!$is_valid) {
							break;
						}
					}
				}
			}
		}

		public function required($key, $value) {
			if(empty(trim($value))) {
				$this->errors[$key] = 'The field ' . $key . ' is required.';
				return false;
			}
			return true;
		}

		public function email($key, $value) {
			if(!filter_var($value,FILTER_VALIDATE_EMAIL)) {
				$this->errors[$key] = 'The field ' . $key . ' must be a valid email.';
				return false;
			}
			return true;
		}
		public function minlen($key, $value, $param) {
			if(!(strlen(trim($value)) >= $param)) {
				$this->errors[$key] = 'The field ' . $key . ' must be atlest ' . $param . ' characters.';
				return false;
			}
			return true;
		}
		public function maxlen($key, $value, $param) {
			if(strlen(trim($value)) > $param) {
				$this->errors[$key] = 'The field ' . $key . ' may not be greater than ' . $param . ' characters.';
				return false;
			}
			return true;
		}
		public function confirm($key, $value, $param) {
			if($value != $this->data[$param]) {
				$this->errors[$key] = 'The ' . $param . ' confirmation does not match.';
				return false;
			}
			return true;
		}
	}