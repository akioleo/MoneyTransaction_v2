<?php

namespace Http\Controllers;

use App\Http\Controllers\UserController;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
      @test
     */

    public function autenticateJwt()
    {
        $formData = [
            'email' => 'admin@admin.com',
            'password' => 'password'
        ];

        $response = $this->json('POST', 'api/auth/login', $formData)->decodeResponseJson();
    }
    $formdata


}
