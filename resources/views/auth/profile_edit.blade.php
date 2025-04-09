@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <button type="button" onclick="location.href='{{ route('usersTop') }}'" class="btn btn-secondary">戻る</button>
        </div>
        <div>
            <h1>プロフィール設定</h1>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('usersUpdate', ['id' => $userData->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div>
                    <table class="table table-sm">
                        <tr>
                            <th>
                            @if ($userData->profile_image === null)
                            <img src="{{ asset('storage/image/default.jpg') }}" width="100">
                            @else
                            <img src="{{ asset($userData->profile_image) }}" width="20">
                            @endif
                            </th>
                            <td>
                                <div>プロフィール画像</div>
                                <div><input type="file" name="profile_image" accept="image/*"></div>
                                @error('profile_image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <th>ユーザーネーム</th>
                            <td>
                                <input type="text" name="name" value="{{ $userData->name }}">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <th>カナ</th>
                            <td>
                                <input type="text" name="name_kana" value="{{ $userData->name_kana }}">
                                @error('name_kana')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <th>メールアドレス</th>
                            <td>
                                <input type="email" name="email" value="{{ $userData->email }}">
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <th>パスワード</th>
                            <td>
                            <button type="button" onclick="location.href='{{ route('usersPassEdit', ['id' => $userData->id]) }}'">パスワードを変更する</button>
                            </td>
                        </tr>
                    </table>
                    <div>
                        <button type="submit" class="btn btn-primary">登録</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection