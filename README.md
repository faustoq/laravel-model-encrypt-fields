# Laravel Model Encrypt Fields

Encrypt and decrypt Laravel model fields

## Installation

```
composer require faustoq/laravel-model-encrypt-fields
```

Note: The package will be autoregistered thanks to the Laravel Package Auto-Discovery.

## Usage

```php
<?php

namespace App\User;

use Illuminate\Database\Eloquent\Model;
use ModelEncryptFields\EncryptsAttributes;

class User extends Model
{
    // Add EncryptAttributes trait
    use EncryptsAttributes;

    // List of fields that should be encrypted in your database
    protected $encrypts = [
        'email',
        'name',
    ];
}

```

That's it! Now you can automatically encrypt/decrypt the fields specified in the `$encrypts` property in your model.

### Examples:

Auto-Encrypt the field `name`:
```
$user->name = "John Doe"; 
$user->save();
```

Auto-Decrypt the field `name`:
```
echo "Hello, " . $user->name;
```

