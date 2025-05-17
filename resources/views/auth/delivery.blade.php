@extends('layouts.app')

@section('content')

<div class="container">
        <div>
            <button type="button" onclick="location.href='{{ route('userProgress') }}'" class="btn btn-secondary">授業進捗へ戻る</button>
        </div>
        <div>
            <h1>検証用動画配信画面</h1>
            <p>{{ $curriculumData->id }}</p>
            <p>{{ $curriculumData->title }}</p>
        </div>
</div>

@endsection