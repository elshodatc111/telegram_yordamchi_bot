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
                            <h4 class="card-title mb-0 pb-0">Targ'ibot materialini yangilash</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('post_update_post',$Post->id) }}" method="post">
                        @csrf 
                        @method('put')
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="chat_id" class="my-2">chat_id</label>
                                <input type="number" name="chat_id" value="{{ $Post['chat_id'] }}" required class="form-control">
                            </div>
                            <div class="col-lg-6">
                                <label for="message_id" class="my-2">message_id</label>
                                <input type="number" name="message_id" value="{{ $Post['message_id'] }}" required class="form-control">
                            </div>
                            <div class="col-lg-12">
                                <label for="description" class="my-2">description</label>
                                <textarea name="description" class="form-control">{{ $Post['description'] }}</textarea>
                            </div>
                            <div class="col-12 text-center">
                                <button class="btn btn-primary w-50 mt-3" type="submit">Saqlash</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
