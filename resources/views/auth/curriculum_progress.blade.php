@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <button type="button" onclick="location.href='{{ route('usersTop') }}'" class="btn btn-secondary">戻る</button>
        </div>
        <div>
            <table>
                <tr>
                    <th>
                    @if ($userData->profile_image === null)
                    <img src="{{ asset('storage/image/default.jpg') }}" width="100">
                    @else
                    <img src="{{ asset($userData->profile_image) }}" width="100">
                    @endif
                    </th>
                    <td>
                        <div>{{ $userData->name }}の授業進捗</div>
                        <div>現在の学年：{{ $userData->grade->name }}</div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="row">
            @foreach ($gradesWithCurriculums as $grade)
                <div class="col-md-4 mb-4">
                    <div>
                        <h5>{{ $grade->name }}</h5>
                        @foreach ($grade->curriculums as $curriculum)
                            <div style="display: flex; align-items: center;">
                                <div style="width: 80px;">
                                    @if (isset($userProgressStatus[$curriculum->id]) && $userProgressStatus[$curriculum->id] == 1)
                                        <span style="color: green;">受講済</span>
                                    @else
                                        <span style="visibility: hidden;">受講済</span>
                                    @endif
                                </div>
                                @if ($userData->grade_id >= $grade->id)
                                    <p class="curriculum-link" style="margin-bottom: 0; cursor: pointer;" data-curriculum-id="{{ $curriculum->id }}">{{ $curriculum->title }}</p>
                                @else
                                    <p style="margin-bottom: 0;" class="opacity-25">{{ $curriculum->title }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection