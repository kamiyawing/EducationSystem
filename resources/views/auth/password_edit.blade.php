@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <button type="button" onclick="location.href='{{ route('usersEdit') }}'" class="btn btn-secondary">戻る</button>
        </div>
        <div>
            <h1>パスワード変更</h1>
            <form method="post" action="{{ route('usersPassUpdate', ['id' => $userData->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div>
                    <table class="table table-sm">
                        <tr>
                            <th>旧パスワード</th>
                            <td>
                                <input type="password" name="old_password" required>
                                @error('old_password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <th>新パスワード</th>
                            <td>
                                <input type="password" name="new_password" required>
                                @error('new_password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <th>新パスワード確認</th>
                            <td>
                                <input type="password" name="new_password_confirmation" required>
                                @error('new_password_confirmation')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
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