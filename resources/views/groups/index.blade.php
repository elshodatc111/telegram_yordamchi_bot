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
                            <h4 class="card-title mb-0 pb-0">Targ'ibot auditoriyalari(guruh va kanallar)</h4>
                        </div>
                        <div class="col-6" style="text-align:right">
                            <a href="#" class="btn btn-warning"><i class="bi bi-arrow-counterclockwise"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Telegram ID</th>
                                <th>Guruh(Kanal) nomi</th>
                                <th>Foydalanuvchilar soni</th>
                                <th>Guruh turi</th>
                                <th>Guruh(Kanal) manzili</th>
                            </tr>
                        </thead>
                        <thead>
                            @foreach($Group as $item)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $item['tg_id'] }}</td>
                                <td>{{ $item['name_group'] }}</td>
                                <td>{{ $item['members_count'] }}</td>
                                <td>{{ $item['group_type'] }}</td>
                                <td>{{ $item['url_group'] }}</td>
                            </tr>
                            @endforeach
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
