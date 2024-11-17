<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Создание одного пользователя
        User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // Создание 10 пользователей
        User::factory(10)->create();

        // Создание 50 товаров
        Product::factory(50)->create();

        // Создание 3 методов оплаты
        PaymentMethod::factory(3)->create();
    }
}
