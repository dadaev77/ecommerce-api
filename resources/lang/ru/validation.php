<?php

return [
    'accepted'             => 'Вы должны принять :attribute.',
    'active_url'           => ':attribute не является допустимым URL.',
    'after'                => ':attribute должен быть датой после :date.',
    'after_or_equal'       => ':attribute должен быть датой, которая не меньше :date.',
    'alpha'                => ':attribute может содержать только буквы.',
    'alpha_dash'           => ':attribute может содержать только буквы, цифры, дефисы и подчеркивания.',
    'alpha_num'            => ':attribute может содержать только буквы и цифры.',
    'array'                => ':attribute должен быть массивом.',
    'before'               => ':attribute должен быть датой до :date.',
    'before_or_equal'      => ':attribute должен быть датой, которая не позднее :date.',
    'between'              => [
        'numeric' => ':attribute должно быть между :min и :max.',
        'file'    => ':attribute должно быть между :min и :max килобайт.',
        'string'  => ':attribute должно быть между :min и :max символами.',
        'array'   => ':attribute должно содержать от :min до :max элементов.',
    ],
    'boolean'              => ':attribute должно быть истинным или ложным.',
    'confirmed'            => 'Подтверждение пароля не совпадает.',
    'date'                 => ':attribute не является допустимой датой.',
    'date_equals'          => ':attribute должно быть датой, равной :date.',
    'date_format'          => ':attribute не соответствует формату :format.',
    'different'            => ':attribute и :other должны различаться.',
    'digits'               => ':attribute должно быть :digits цифр.',
    'digits_between'       => ':attribute должно быть между :min и :max цифрами.',
    'dimensions'           => ':attribute имеет недопустимые размеры изображения.',
    'distinct'             => ':attribute имеет повторяющееся значение.',
    'email'                => ':attribute должно быть действительным электронным адресом.',
    'ends_with'            => ':attribute должно заканчиваться одним из следующих значений: :values.',
    'exists'               => 'Выбранное значение для :attribute неверно.',
    'file'                 => ':attribute должно быть файлом.',
    'filled'               => ':attribute обязательно для заполнения.',
    'gt'                   => [
        'numeric' => ':attribute должно быть больше :value.',
        'file'    => ':attribute должно быть больше :value килобайт.',
        'string'  => ':attribute должно быть больше :value символов.',
        'array'   => ':attribute должно содержать больше чем :value элементов.',
    ],
    'gte'                  => [
        'numeric' => ':attribute должно быть больше или равно :value.',
        'file'    => ':attribute должно быть больше или равно :value килобайт.',
        'string'  => ':attribute должно быть больше или равно :value символам.',
        'array'   => ':attribute должно содержать :value или больше элементов.',
    ],
    'image'                => ':attribute должно быть изображением.',
    'in'                   => 'Выбранное значение для :attribute неверно.',
    'in_array'             => ':attribute не существует в :other.',
    'integer'              => ':attribute должно быть целым числом.',
    'ip'                   => ':attribute должно быть действительным IP-адресом.',
    'ipv4'                 => ':attribute должно быть действительным IPv4-адресом.',
    'ipv6'                 => ':attribute должно быть действительным IPv6-адресом.',
    'json'                 => ':attribute должно быть допустимой строкой JSON.',
    'lt'                   => [
        'numeric' => ':attribute должно быть меньше :value.',
        'file'    => ':attribute должно быть меньше :value килобайт.',
        'string'  => ':attribute должно быть меньше :value символов.',
        'array'   => ':attribute должно содержать меньше чем :value элементов.',
    ],
    'lte'                  => [
        'numeric' => ':attribute должно быть меньше или равно :value.',
        'file'    => ':attribute должно быть меньше или равно :value килобайт.',
        'string'  => ':attribute должно быть меньше или равно :value символам.',
        'array'   => ':attribute должно содержать :value или меньше элементов.',
    ],
    'max'                  => [
        'numeric' => ':attribute не может быть больше :max.',
        'file'    => ':attribute не может быть больше :max килобайт.',
        'string'  => ':attribute не может быть длиннее :max символов.',
        'array'   => ':attribute не может содержать больше чем :max элементов.',
    ],
    'mimes'                => ':attribute должно быть файлом одного из типов: :values.',
    'mimetypes'            => ':attribute должно быть файлом одного из типов: :values.',
    'min'                  => [
        'numeric' => ':attribute должно быть не меньше :min.',
        'file'    => ':attribute должно быть не меньше :min килобайт.',
        'string'  => ':attribute должно содержать хотя бы :min символов.',
        'array'   => ':attribute должно содержать хотя бы :min элементов.',
    ],
    'not_in'               => 'Выбранное значение для :attribute неверно.',
    'not_regex'            => ':attribute имеет недопустимый формат.',
    'numeric'              => ':attribute должно быть числом.',
    'password'             => 'Пароль неверный.',
    'present'              => ':attribute должно присутствовать.',
    'regex'                => ':attribute имеет недопустимый формат.',
    'required'             => ':attribute обязательно для заполнения.',
    'required_if'          => ':attribute обязательно, когда :other равно :value.',
    'required_unless'      => ':attribute обязательно, если :other не равно :value.',
    'required_with'        => ':attribute обязательно, когда присутствует :values.',
    'required_with_all'    => ':attribute обязательно, когда присутствуют :values.',
    'required_without'     => ':attribute обязательно, когда отсутствует :values.',
    'required_without_all' => ':attribute обязательно, когда отсутствуют :values.',
    'same'                 => ':attribute и :other должны совпадать.',
    'size'                 => [
        'numeric' => ':attribute должно быть :size.',
        'file'    => ':attribute должно быть размером :size килобайт.',
        'string'  => ':attribute должно быть длиной :size символов.',
        'array'   => ':attribute должно содержать :size элементов.',
    ],
    'starts_with'          => ':attribute должно начинаться с одного из следующих значений: :values.',
    'string'               => ':attribute должно быть строкой.',
    'timezone'             => ':attribute должно быть допустимой временной зоной.',
    'unique'               => ':attribute уже существует.',
    'url'                  => ':attribute имеет недопустимый формат URL.',
    'uuid'                 => ':attribute должно быть допустимым UUID.',
];