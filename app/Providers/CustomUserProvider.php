<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;

class CustomUserProvider implements UserProvider
{
    private $testUser;

    public function __construct()
    {
        $this->testUser = [
            'email' => 'teste@teste.com',
            'password' => bcrypt('teste')
        ];
    }

    public function retrieveById($identifier)
    {
        return $this->getGenericUser($this->testUser);
    }

    public function retrieveByToken($identifier, $token)
    {
        // Not needed for this example
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        // Not needed for this example
    }

    public function retrieveByCredentials(array $credentials)
    {
        if ($credentials['email'] === $this->testUser['email']) {
            return $this->getGenericUser($this->testUser);
        }

        return null;
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return Hash::check($credentials['password'], $user->getAuthPassword());
    }

    protected function getGenericUser(array $user)
    {
        if (!is_null($user)) {
            return new \App\Models\GenericUser((array) $user);
        }
    }
}
