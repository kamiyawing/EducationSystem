<?php
    return [
        'register' => [
            'name.required' => 'ユーザーネームは必須です。',
            'name.unique' => 'このユーザーネームはすでに使用されています。',
            'kana.required' => 'カナは必須です。',
            'kana.regex' => 'カナは全角カタカナで入力してください。',
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => '有効なメールアドレスを入力してください。',
            'email.unique' => 'このメールアドレスは既に使用されています。',
            'password.required' => 'パスワードは必須です。',
            'password.min' => 'パスワードは8文字以上で入力してください。',
            'password.confirmed' => 'パスワードが一致しません。',
        ],
        
        'login' => [
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => 'そのメールアドレスは登録されていません。',
            'password.required' => '入力されたパスワードは登録のものと一致しませんでした。',
            'password.min' => 'パスワードは8文字以上で入力してください。',
        ],

        'banner' => [
            'required' => '画像を選択してください。',
            'max' => '画像サイズが大きすぎます。サイズを調整してください。',
        ]
    ];
    