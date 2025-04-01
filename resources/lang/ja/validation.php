<?php

return [
    'required' => ':attribute は必須項目です。',
    'unique' => ':attribute は既に使用されています。',
    'email' => ':attribute には有効なメールアドレスを入力してください。',
    'min' => [
        'string' => ':attribute は :min 文字以上で入力してください。',
    ],
    'confirmed' => ':attribute が確認用と一致しません。',
    
    'custom' => [
        'name' => [
            'required' => 'ユーザーネームは必須です。',
            'unique' => 'すでに使用されているユーザーネームです。',
        ],
        'kana' => [
            'required' => 'カナは必須です。',
            'regex' => '「カナ」で入力してください。',
        ],
        'email' => [
            'required' => '無効なメールアドレスです。',
            'unique' => 'このメールアドレスは既に使用されています。',
        ],
        'password' => [
            'required' => 'パスワードは必須です。',
            'min' => 'パスワードは8文字以上で入力してください。',
            'confirmed' => 'パスワード確認が一致しません。',
        ],
    ],
    
    'attributes' => [
        'name' => '名前',
        'kana' => 'カナ',
        'email' => 'メールアドレス',
        'password' => 'パスワード',
    ],
];