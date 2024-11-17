<?php

namespace Tests\Unit;

use App\Http\Controllers\Api\v1\AuthController;
use Tests\TestCase;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_successful_registration()
    {
        $data = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
        ];

        $request = $this->createMock(RegisterRequest::class);
        $request->expects($this->once())
            ->method('validated')
            ->willReturn($data);

        $controller = new AuthController();
        $response = $controller->register($request);

        // Проверка статуса ответа
        $this->assertEquals(201, $response->getStatusCode());

        // Проверка содержимого ответа
        $responseData = $response->getData(true); // Преобразуем JSON в массив
        $this->assertTrue($responseData['success']);
        $this->assertEquals('Регистрация прошла успешно!', $responseData['message']);

        // Проверяем, что пользователь записан в базу
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);
    }

    public function test_registration_failure()
    {
        // Подготавливаем данные
        $data = [
            'name' => 'Test User',
            'email' => 'invalid-email',
            'password' => 'password123',
        ];

        // Создаем мок RegisterRequest
        $request = $this->createMock(RegisterRequest::class);

        // Настраиваем мок для выброса исключения
        $request->expects($this->once())
            ->method('validated')
            ->willThrowException(ValidationException::withMessages([
                'email' => ['The email field must be a valid email address.'],
            ]));

        // Выполнение метода контроллера
        $controller = new AuthController();
        $response = $controller->register($request);

        // Проверка статуса ответа
        $this->assertEquals(500, $response->getStatusCode());

        // Проверка содержимого ответа
        $responseData = $response->getData(true);
        $this->assertFalse($responseData['success']);
        $this->assertStringContainsString('Регистрация не удалась', $responseData['message']);
        $this->assertArrayHasKey('error', $responseData);
    }
}