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
                            <h4 class="card-title mb-0 pb-0">Auditoriya yangilash</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('catigore_update_name',$Catigory['id']) }}" method="post">
                        @csrf 
                        @method('put') 
                        <label for="">Auditoriya nomini</label>
                        <div class="row">
                            <div class="col-lg-9">
                                <input type="text" name="catigore_name" value="{{ $Catigory['catigore_name'] }}" class="form-control" required>
                            </div>
                            <div class="col-lg-3">
                                <button class="btn btn-primary w-100">Yangilash</button>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <div class="py-3 mx-4">
                                <label for="">Auditoriya guruhlari</label>
                                <hr>
                                <table class="table table-bordered text-center" style="font-size:14px;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Auditoriya guruhlari</th>
                                            <th>O'chirish</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($Guruh as $item)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{ $item['name_group'] }}</td>
                                            <td>
                                                <form action="{{ route('catigore_delete_group',$item['id']) }}" method="post">
                                                    @csrf 
                                                    @method('delete')
                                                    <input type="hidden" name="type" value="Group">
                                                    <input type="hidden" name="catigory_id" value="{{ $Catigory['id'] }}">
                                                    <button class="btn btn-danger p-0 px-1"><i class="bi bi-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="text-center">Guruhlar mavjud emas.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="py-3 mx-4">
                                <label for="">Auditoriya kanallari</label>
                                <hr>
                                <table class="table table-bordered text-center" style="font-size:14px;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Auditoriya kanallari</th>
                                            <th>O'chirish</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($Kanal as $item)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{ $item['name_group'] }}</td>
                                            <td>
                                                <form action="{{ route('catigore_delete_group',$item['id']) }}" method="post">
                                                    @csrf 
                                                    @method('delete')
                                                    <input type="hidden" name="type" value="Chanel">
                                                    <input type="hidden" name="catigory_id" value="{{ $Catigory['id'] }}">
                                                    <button class="btn btn-danger p-0 px-1"><i class="bi bi-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="text-center">Kanallar mavjud emas.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="w-100 text-center">
                        <button class="btn btn-primary w-50" data-bs-toggle="modal" data-bs-target="#exampleModal">Auditoriya guruh(kanal) qo'shish</button>
                    </div>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Auditoriya guruh(kanal) qo'shish</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('catigore_add_chanel',$Catigory['id']) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <label for="group_id" class="mb-2">Guruh yoki kanalni tanlang</label>
                                        <select id="searchSelect" name="group_id" class="form-select" required>
                                            <option value="">Tanlang...</option>
                                            @foreach($Group2 as $item)
                                                <option value="{{ $item['id'] }}">{{ $item['name_group'] }} ({{ $item['group_type'] }})</option>
                                            @endforeach
                                        </select>
                                        <button class="btn btn-primary w-100 mt-3" type="submit">Saqlash</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
