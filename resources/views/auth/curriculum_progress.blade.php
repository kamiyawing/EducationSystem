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
        <div style="display: flex; flex-wrap: wrap;">
            @foreach ($gradesWithCurriculums->chunk(3) as $gradeGroup)
                <div style="width: calc(100% / 3); padding: 15px; box-sizing: border-box;">
                    @foreach ($gradeGroup as $grade)
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
                                    <p style="margin-bottom: 0;">{{ $curriculum->title }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>

@endsection