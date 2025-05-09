<?php

return [

    'accepted' => ':attribute უნდა იყოს მიღებული.',
    'accepted_if' => ':attribute უნდა იყოს მიღებული, როდესაც :other არის :value.',
    'active_url' => ':attribute არ არის სწორი URL.',
    'after' => ':attribute უნდა იყოს თარიღი :date-ის შემდეგ.',
    'after_or_equal' => ':attribute უნდა იყოს თარიღი, რომელიც არის :date-ის შემდეგ ან ტოლი.',
    'alpha' => ':attribute უნდა შეიცავდეს მხოლოდ ასოებს.',
    'alpha_dash' => ':attribute უნდა შეიცავდეს მხოლოდ ასოებს, ციფრებს, ტირეებს და ქვედატირეებს.',
    'alpha_num' => ':attribute უნდა შეიცავდეს მხოლოდ ასოებს და ციფრებს.',
    'array' => ':attribute უნდა იყოს მასივი.',
    'before' => ':attribute უნდა იყოს თარიღი :date-მდე.',
    'before_or_equal' => ':attribute უნდა იყოს თარიღი, რომელიც არის :date-მდე ან ტოლი.',
    'between' => [
        'numeric' => ':attribute უნდა იყოს :min და :max შორის.',
        'file' => ':attribute უნდა იყოს :min და :max კილობაიტს შორის.',
        'string' => ':attribute უნდა იყოს :min და :max სიმბოლოს შორის.',
        'array' => ':attribute უნდა შეიცავდეს :min-დან :max-მდე ელემენტებს.',
    ],
    'boolean' => ':attribute ველი უნდა იყოს true ან false.',
    'confirmed' => ':attribute ვერ დადასტურდა.',
    'current_password' => 'პაროლი არასწორია.',
    'date' => ':attribute არ არის სწორი თარიღი.',
    'date_equals' => ':attribute უნდა იყოს :date-ის ტოლი თარიღი.',
    'date_format' => ':attribute არ ემთხვევა ფორმატს: :format.',
    'declined' => ':attribute უნდა იყოს უარყოფილი.',
    'declined_if' => ':attribute უნდა იყოს უარყოფილი, როდესაც :other არის :value.',
    'different' => ':attribute და :other უნდა იყოს სხვადასხვა.',
    'digits' => ':attribute უნდა შეიცავდეს :digits ციფრს.',
    'digits_between' => ':attribute უნდა შეიცავდეს :min-დან :max-მდე ციფრებს.',
    'dimensions' => ':attribute-ს აქვს არასწორი სურათის ზომები.',
    'distinct' => ':attribute ველს აქვს დუბლირებული მნიშვნელობა.',
    'email' => ':attribute უნდა იყოს სწორი ელ.ფოსტის მისამართი.',
    'ends_with' => ':attribute უნდა მთავრდებოდეს შემდეგიდან ერთ-ერთით: :values.',
    'enum' => 'არჩეული :attribute არასწორია.',
    'exists' => 'არჩეული :attribute არასწორია.',
    'file' => ':attribute უნდა იყოს ფაილი.',
    'filled' => ':attribute ველს უნდა ჰქონდეს მნიშვნელობა.',
    'gt' => [
        'numeric' => ':attribute უნდა იყოს უფრო დიდი ვიდრე :value.',
        'file' => ':attribute უნდა იყოს უფრო დიდი ვიდრე :value კილობაიტი.',
        'string' => ':attribute უნდა შეიცავდეს უფრო მეტ სიმბოლოს ვიდრე :value.',
        'array' => ':attribute უნდა შეიცავდეს უფრო მეტ ელემენტს ვიდრე :value.',
    ],
    'gte' => [
        'numeric' => ':attribute უნდა იყოს :value-ზე დიდი ან ტოლი.',
        'file' => ':attribute უნდა იყოს :value კილობაიტზე მეტი ან ტოლი.',
        'string' => ':attribute უნდა შეიცავდეს მინიმუმ :value სიმბოლოს.',
        'array' => ':attribute უნდა შეიცავდეს მინიმუმ :value ელემენტს.',
    ],
    'image' => ':attribute უნდა იყოს სურათი.',
    'in' => 'არჩეული :attribute არასწორია.',
    'in_array' => ':attribute ველი არ არსებობს :other-ში.',
    'integer' => ':attribute უნდა იყოს მთელი რიცხვი.',
    'ip' => ':attribute უნდა იყოს სწორი IP მისამართი.',
    'ipv4' => ':attribute უნდა იყოს სწორი IPv4 მისამართი.',
    'ipv6' => ':attribute უნდა იყოს სწორი IPv6 მისამართი.',
    'mac_address' => ':attribute უნდა იყოს სწორი MAC მისამართი.',
    'json' => ':attribute უნდა იყოს სწორი JSON ტექსტი.',
    'lt' => [
        'numeric' => ':attribute უნდა იყოს ნაკლები ვიდრე :value.',
        'file' => ':attribute უნდა იყოს ნაკლები ვიდრე :value კილობაიტი.',
        'string' => ':attribute უნდა შეიცავდეს ნაკლებ სიმბოლოს ვიდრე :value.',
        'array' => ':attribute უნდა შეიცავდეს ნაკლებ ელემენტს ვიდრე :value.',
    ],
    'lte' => [
        'numeric' => ':attribute უნდა იყოს :value-ზე ნაკლები ან ტოლი.',
        'file' => ':attribute უნდა იყოს :value კილობაიტზე ნაკლები ან ტოლი.',
        'string' => ':attribute უნდა შეიცავდეს მაქსიმუმ :value სიმბოლოს.',
        'array' => ':attribute არ უნდა შეიცავდეს :value-ზე მეტ ელემენტს.',
    ],
    'max' => [
        'numeric' => ':attribute არ უნდა აღემატებოდეს :max-ს.',
        'file' => ':attribute არ უნდა აღემატებოდეს :max კილობაიტს.',
        'string' => ':attribute არ უნდა შეიცავდეს :max-ზე მეტ სიმბოლოს.',
        'array' => ':attribute არ უნდა შეიცავდეს :max-ზე მეტ ელემენტს.',
    ],
    'min' => [
        'numeric' => ':attribute უნდა იყოს მინიმუმ :min.',
        'file' => ':attribute უნდა იყოს მინიმუმ :min კილობაიტი.',
        'string' => ':attribute უნდა შეიცავდეს მინიმუმ :min სიმბოლოს.',
        'array' => ':attribute უნდა შეიცავდეს მინიმუმ :min ელემენტს.',
    ],
    'numeric' => ':attribute უნდა იყოს რიცხვი.',
    'regex' => ':attribute ფორმატი არასწორია.',
    'required' => ':attribute ველი აუცილებელია.',
    'unique' => ':attribute უკვე არსებობს.',
    'url' => ':attribute უნდა იყოს სწორი URL.',
    'uuid' => ':attribute უნდა იყოს სწორი UUID.',

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'მომხმარებლის შეტყობინება',
        ],
    ],

    'attributes' => [
        'old_password' => 'მიმდინარე პაროლი',
        'new_password' => 'ახალი პაროლი',
        'password_confirmation' => 'პაროლის დადასტურება',
    ],
];
