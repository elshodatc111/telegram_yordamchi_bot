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
                            <h4 class="card-title mb-0 pb-0">Targ'ibot materiallari</h4>
                        </div>
                        <div class="col-6" style="text-align:right">
                            <a href="{{ route('post_create') }}" class="btn btn-success"><i class="bi bi-plus"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>chat_id</th>
                                <th>message_id</th>
                                <th>description</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($Post as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->chat_id }}</td>
                                <td>{{ $item->message_id }}</td>
                                <td>{{ $item->description }}</td>
                                <td>
                                    <a href="{{ route('post_update', $item->id) }}" class="btn btn-primary m-0 p-0 px-1"><i class="bi bi-pencil"></i></a> 
                                    <form action="{{ route('post_create_delete', $item->id) }}" method="post" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger m-0 p-0 px-1"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">Targ'ibot materiallari mavjud emas.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
