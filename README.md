# Tutorial

- the validate method will return an array if there is an error
- if there is no error, the return would be empty array

```php
  $errors = Validation::validate($data, $rules);
```

- example

```php
  $data = [
    "name" => "Jasper",
    "email" => "invalid@email",
    "password" => "123456",
    "confirm_password" => "12345"
  ];
  $rules = [
    "name" => "required",
    "email" => "required|email",
    "password" => "required|minlen:6|maxlen:15",
    "confirm_password" => "confirm:password"
	];
    
  $errors =  Validation::validate($data, $rules);
  
  print_r($errors);
```
- output : Array ( [email] => The field email must be a valid email. [confirm_password] => The password confirmation does not match. )


# list of rules
- required
the input is required
- email
