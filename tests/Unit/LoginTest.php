<?php

namespace Tests\Unit;

use App\Http\Controllers\Api\v1\AuthController;
use Tests\TestCase;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_successful_login()
    {
        // Создаем пользователя
        $user = \Mockery::mock(User::class)->makePartial();
        $user->expects('createToken')
             ->with('authToken')
             ->andReturns((object) ['plainTextToken' => 'mocked_token']);

        // Мокаем LoginRequest
        $request = $this->createMock(LoginRequest::class);
        $request->expects($this->once())
            ->method('only')
            ->with('email', 'password')
            ->willReturn([
                'email' => 'test@example.com',
                'password' => 'password123',
            ]);

        // Мокаем Auth::attempt
        \Illuminate\Support\Facades\Auth::shouldReceive('attempt')
            ->once()
            ->with(['email' => 'test@example.com', 'password' => 'password123'])
            ->andReturnTrue();

        // Мокаем Auth::user
        \Illuminate\Support\Facades\Auth::shouldReceive('user')
            ->once()
            ->andReturn($user);

        // Вызываем метод контроллера
        $controller = new AuthController();
        $response = $controller->login($request);

        // Проверяем статус ответа
        $this->assertEquals(200, $response->getStatusCode());

        // Проверяем содержимое ответа
        $responseData = $response->getData(true);
        $this->assertArrayHasKey('user', $responseData);
        $this->assertArrayHasKey('token', $responseData);
        $this->assertEquals('mocked_token', $responseData['token']);
    }


    public function test_login_failure()
    {
        // Мокаем LoginRequest
        $request = $this->createMock(LoginRequest::class);
        $request->expects($this->once())
            ->method('only')
            ->with('email', 'password')
            ->willReturn([
                'email' => 'test@example.com',
                'password' => 'wrong_password',
            ]);

        // Мокаем Auth::attempt
        Auth::shouldReceive('attempt')
            ->once()
            ->with(['email' => 'test@example.com', 'password' => 'wrong_password'])
            ->andReturnFalse();

        // Вызываем метод контроллера
        $controller = new AuthController();
        $response = $controller->login($request);

        // Проверяем статус ответа
        $this->assertEquals(401, $response->getStatusCode());

        // Проверяем содержимое ответа
        $responseData = $response->getData(true);
        $this->assertEquals('Неверные учетные данные', $responseData['message']);
    }
}
