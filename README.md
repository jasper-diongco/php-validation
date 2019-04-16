# Tutorial

- the validate method of Validation class will return an array if there is an error
- if there is no error, the return would be empty array

```php
  $errors = Validation::validate($data, $rules);
```
