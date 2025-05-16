@extends('admin.layouts.app')
@section('content')
  <div class="mt-3">
    <a class="link-secondary d-inline link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover fs-4" 
    href="{{ route('admin.show.curriculum.list') }}">
      戻る
    </a>
  </div>

  <div class="d-flex flex-column gap-3 my-4">
    <h1 class="display-6">配信日時設定</h1>
  </div>

  <div class="d-flex flex-column gap-3 my-4">
   <p class="fs-3">　{{ $curriculum->title }}</p>
  </div>

  @if ($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <form method="POST" action="{{ route('admin.exe.delivery.store', ['id' => $curriculum->id] ) }}" enctype="multipart/form-data"> 
    @csrf
    <div class="d-flex flex-column gap-3 my-4" id="delivery-container">
      @php
        $oldDeliveryTimes = old('delivery_times');
      @endphp
    
      @if (is_array($oldDeliveryTimes))
        @foreach ($oldDeliveryTimes as $i => $time)
          <div class="row align-items-center g-2">
            <div class="col-auto">
              <input type="date" name="delivery_times[{{ $i }}][from_date]"
                value="{{ $time['from_date'] ?? '' }}"
                class="form-control form-control-lg" style="border-color:gray; border-width: 2px;" placeholder="年月日">
            </div>
    
            <div class="col-auto">
              <input type="time" name="delivery_times[{{ $i }}][from_time]"
                value="{{ $time['from_time'] ?? '' }}"
                class="form-control form-control-lg" style="border-color:gray; border-width: 2px;" placeholder="時間">
            </div>
    
            <div class="col-auto">
              <span class="fs-3">　～　</span>
            </div>
    
            <div class="col-auto">
              <input type="date" name="delivery_times[{{ $i }}][to_date]"
                value="{{ $time['to_date'] ?? '' }}"
                class="form-control form-control-lg" style="border-color:gray; border-width: 2px;" placeholder="年月日">
            </div>
    
            <div class="col-auto">
              <input type="time" name="delivery_times[{{ $i }}][to_time]"
                value="{{ $time['to_time'] ?? '' }}"
                class="form-control form-control-lg" style="border-color:gray; border-width: 2px;" placeholder="時間">
            </div>
          </div>
        @endforeach
      @else
        @if (isset($curriculum->delivery_times) && $curriculum->delivery_times instanceof \Illuminate\Support\Collection && $curriculum->delivery_times->isNotEmpty())
          @foreach ($curriculum->delivery_times as $i => $time)
            <div class="row align-items-center g-2">
              <div class="col-auto">
                <input type="date" name="delivery_times[{{ $i }}][from_date]"
                  value="{{ $time->from_date }}"
                  class="form-control form-control-lg" style="border-color:gray; border-width: 2px;" placeholder="年月日">
              </div>
      
              <div class="col-auto">
                <input type="time" name="delivery_times[{{ $i }}][from_time]"
                  value="{{ $time->from_time }}"
                  class="form-control form-control-lg" style="border-color:gray; border-width: 2px;" placeholder="時間">
              </div>
      
              <div class="col-auto">
                <span class="fs-3">　～　</span>
              </div>
      
              <div class="col-auto">
                <input type="date" name="delivery_times[{{ $i }}][to_date]"
                  value="{{ $time->to_date }}"
                  class="form-control form-control-lg" style="border-color:gray; border-width: 2px;" placeholder="年月日">
              </div>
      
              <div class="col-auto">
                <input type="time" name="delivery_times[{{ $i }}][to_time]"
                  value="{{ $time->to_time }}"
                  class="form-control form-control-lg" style="border-color:gray; border-width: 2px;" placeholder="時間">
              </div>
      
              <div class="col-auto">
                @if ($time->id)
                  <button type="button" class="btn btn-danger delete-btn"
                    data-id="{{ $time->id }}"
                    data-url="{{ route('admin.exe.delivery.destroy', ['id' => $time->id]) }}">削除</button>
                @endif
              </div>
            </div>
          @endforeach
        @endif
      @endif
      </div>

      <div class="my-4">
        <button type="button" class="btn btn-success" onclick="add()">追加</button>
      </div>

      <div class="text-center mt-3">
        <button type="submit" class="btn btn-primary fs-3">登録</button>
      </div>
    </form>

@endsection