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
                            <h4 class="card-title mb-0 pb-0">Auditoriya guruhlari</h4>
                        </div>
                        <div class="col-6" style="text-align:right">
                            <a href="{{ route('catigore_create') }}" class="btn btn-success"><i class="bi bi-plus"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Auditoriya nomlanishi</th>
                                <th>Guruhlar soni</th>
                                <th>Kanallar soni</th>
                                <th></th>
                            </tr>
                        </thead>
                        <thead>
                            @forelse($Groups as $item)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['gurops'] }}</td>
                                <td>{{ $item['chanels'] }}</td>
                                <td>
                                    <a href="{{ route('catigore_update',$item['id']) }}" class="btn btn-primary m-0 p-0 px-1"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('catigore_delete',$item['id']) }}" method="post" style="display: inline;">
                                        @csrf 
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger m-0 p-0 px-1"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan=5 class="text-center">Auditoriya mavjud emas.</td>
                            </tr>
                            @endforelse
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
