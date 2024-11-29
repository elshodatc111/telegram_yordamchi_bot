@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8"><h5 class="card-title mb-0">Yangi targ'ibot rejasi</h5></div>
                        <div class="col-4" style="text-align:right">
                            @if($Card['count_group'] != 0 AND $Card['status'] == 0 )
                            <form action="#" method="post">
                                <button class="btn btn-success"><i class="bi bi-play"></i></button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="">Targ'ibot nomi</label>
                            <input type="text" value="{{ $Card['card_name'] }}" disabled class="form-control">
                            <label for="">Targ'ibot manbasi</label>
                            <input type="text" value="{{ $Card['card_type'] }}" disabled class="form-control">
                            <label for="">Targ'ibot turi</label>
                            <input type="text" value="{{ $Card['card_type'] }}" disabled class="form-control">
                            <label for="">Targ'ibot holati</label>
                            <input type="text" value="{{ $Card['status'] }}" disabled class="form-control">
                        </div>
                        <div class="col-lg-4">
                            <label for="">Targ'ibot boshlanish sanasi</label>
                            <input type="text" value="{{ $Card['start_date'] }}" disabled class="form-control">
                            <label for="">Targ'ibot tugash sanasi</label>
                            <input type="text" value="{{ $Card['end_date'] }}" disabled class="form-control">
                            <label for="">Targ'ibot vaqti</label>
                            <input type="text" value="{{ $Card['time'] }}" disabled class="form-control">
                            <label for="">Targ'ibot guruhlar soni</label>
                            <input type="text" value="{{ $Card['count_group'] }}" disabled class="form-control">
                        </div>
                        <div class="col-lg-4">
                            <label for="">Hafta kunlari</label>
                            <table class="table table-bordered text-center" style="font-size:12px">
                                <tr>
                                    <th class="p-1">Dushanba</th>
                                    <td class="p-1">{{ $Card['monday'] }}</td>
                                </tr>
                                <tr>
                                    <th class="p-1">Seshanba</th>
                                    <td class="p-1">{{ $Card['tuesday'] }}</td>
                                </tr>
                                <tr>
                                    <th class="p-1">Chorshanba</th>
                                    <td class="p-1">{{ $Card['wednesday'] }}</td>
                                </tr>
                                <tr>
                                    <th class="p-1">Payshanba</th>
                                    <td class="p-1">{{ $Card['thursday'] }}</td>
                                </tr>
                                <tr>
                                    <th class="p-1">Juma</th>
                                    <td class="p-1">{{ $Card['friday'] }}</td>
                                </tr>
                                <tr>
                                    <th class="p-1">Shanba</th>
                                    <td class="p-1">{{ $Card['saturday'] }}</td>
                                </tr>
                                <tr>
                                    <th class="p-1">Yakshanba</th>
                                    <td class="p-1">{{ $Card['sunday'] }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3 justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8"><h5 class="card-title mb-0">Targ'ibot guruhlarini tanlang</h5></div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="#" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="group_type">Guruh turlari</label>
                                <select name="group_type" id="group_type" required class="form-select my-2" onchange="showUser(this.value)">
                                    <option value="">Tanlang...</option>
                                    <option value="all_channels_groups">Barcha guruh(kanal)lar</option>
                                    <option value="all_channels">Barcha kanallar</option>
                                    <option value="all_groups">Barcha guruhlar</option>
                                    <option value="audience_groups">Auditoriya guruhlar</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <div id="txtHint">Bu yerda tanlangan turga mos inputlar chiqadi</div>
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary w-100">Saqlash</button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
