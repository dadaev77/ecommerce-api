<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'email' => $this->resource->email,
            'created_at' => $this->resource->created_at->toDateTimeString(),
            'updated_at' => $this->resource->updated_at->toDateTimeString(),
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле имени обязательно.',
            'email.required' => 'Поле электронной почты обязательно.',
            'email.email' => 'Электронная почта должна быть действительным адресом электронной почты.',
            'email.unique' => 'Электронная почта уже зарегистрирована.',
            'password.required' => 'Поле пароля обязательно.',
            'password.min' => 'Пароль должен быть не менее 6 символов.',
            'password.confirmed' => 'Подтверждение пароля не совпадает.',
        ];
    }
}
