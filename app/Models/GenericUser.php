<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class GenericUser implements AuthenticatableContract
{
    use Authenticatable;

    protected $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function getAuthIdentifierName()
    {
        return 'email';
    }

    public function getAuthIdentifier()
    {
        return $this->attributes['email'];
    }

    public function getAuthPassword()
    {
        return $this->attributes['password'];
    }

    public function getRememberToken()
    {
    }

    public function setRememberToken($value)
    {
        // Not needed for this example
    }

    public function getRememberTokenName()
    {
    }
}
