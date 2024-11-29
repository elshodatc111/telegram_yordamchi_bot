@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Bot topshiriqlari</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table id="example" class="table table-striped table-bordered text-center">
                        <thead>
                            <tr>
                                <th>1</th>
                                <th>Targ'ibot materiallari</th>
                                <th>Targ'ibot auditoriyalari(guruh va kanallar)</th>
                                <th>Targ'ibot yuborish kuni</th>
                                <th>Targ'ibot yuborish vaqti</th>
                                <th>Targ'ibot holati</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($PostJob as $item)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $item['description'] }}</td>
                                <td>{{ $item['name_group'] }}</td>
                                <td>{{ $item['day'] }}</td>
                                <td>{{ $item['time'] }}</td>
                                <td>{{ $item['status'] }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan=6 class="text-center">Bot topshiriqlari mavjud emas.</td>
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
