@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title mb-0 pb-0">Targ'ibot rejalar</h4>
                        </div>
                        <div class="col-6" style="text-align:right">
                            <a href="{{ route('card_create') }}" class="btn btn-success"><i class="bi bi-plus"></i></a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-bordered text-center" style="font-size:14px;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Targ'ibot rejasi</th>
                                <th>Targ'ibot turi</th>
                                <th>Targ'ibot boshlanish kuni</th>
                                <th>Targ'ibot yakunlanish kuni</th>
                                <th>Targ'ibot vaqti</th>
                                <th>Targ'ibot holat</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($Card as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $item['card_name'] }}</td>
                                    <td>
                                        @if($item['card_type']=='week_data')
                                            Belgilangan hafta kunlarida
                                        @elseif($item['card_type']=='one_data')
                                            Belgilangan kun
                                        @else
                                            Belgilangan kunlar
                                        @endif 
                                    </td>
                                    <td>{{ $item['start_date'] }}</td>
                                    <td>{{ $item['end_date'] }}</td>
                                    <td>{{ $item['time'] }}</td>
                                    <td>
                                        @if($item['status'])
                                            Aktiv 
                                        @else 
                                            Padding 
                                        @endif
                                    </td>
                                    <td>
                                        @if($item['status'])
                                            <a href="#" class="btn btn-primary m-0 p-0 px-1"><i class="bi bi-eye"></i></a> 
                                        @else 
                                            <a href="{{ route('card_show_play',$item['id']) }}" class="btn btn-primary m-0 p-0 px-1"><i class="bi bi-eye"></i></a>
                                            <form action="{{ route('card_delete',$item['id']) }}" method="post" style="display: inline;">
                                                @csrf 
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger m-0 p-0 px-1"><i class="bi bi-trash"></i></button>
                                            </form> 
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan=8 class="text-center">Targ'ibot rejalar mavjud emas.</td>
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
