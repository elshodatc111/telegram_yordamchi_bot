@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success" role="alert"><i class="bi bi-check"></i> {{ session('status') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title mb-0 pb-0">Yangi auditoriya</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body"> 
                    <form action="{{ route('catigore_create_story') }}" method="post">
                        @csrf 
                        <label for="catigore_name">Auditoriya nomini</label>
                        <input type="text" name="catigore_name" class="form-control" required>
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <div class="py-3 mx-4">
                                    <label for="">Auditoriya uchun guruhlarni tanlang</label>
                                    <hr>
                                    @foreach($Group as $item)
                                        <div class="form-check">
                                            <input class="form-check-input" name="groups[]" type="checkbox" value="{{ $item['id'] }}" id="group{{ $item['id'] }}">
                                            <label class="form-check-label" for="group{{ $item['id'] }}">{{ $item['name_group'] }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="py-3 mx-4">
                                    <label for="">Auditoriya uchun kanallarni tanlang</label>
                                    <hr>
                                    @foreach($Chanel as $item)
                                        <div class="form-check">
                                            <input class="form-check-input" name="channels[]" type="checkbox" value="{{ $item['id'] }}" id="chanel{{ $item['id'] }}">
                                            <label class="form-check-label" for="chanel{{ $item['id'] }}">{{ $item['name_group'] }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="w-100 text-center">
                            <button class="btn btn-primary w-50">Auditoriya saqlash</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
