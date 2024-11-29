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
                            <form action="{{ route('card_run') }}" method="post">
                                @csrf 
                                <input type="hidden" name="card_id" value="{{$Card['id']}}">
                                <button class="btn btn-success" type="submit"><i class="bi bi-play"></i></button>
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
                            <input type="text" value="{{ $Post }}" disabled class="form-control">
                            <label for="">Targ'ibot turi</label>
                            @if($Card['card_type']=='week_data')
                                <input type="text" value="Belgilangan hafta kunlarida" disabled class="form-control">
                            @elseif($Card['card_type']=='one_data')
                                <input type="text" value="Belgilangan kun" disabled class="form-control">
                            @else
                                <input type="text" value="Belgilangan kunlar" disabled class="form-control">
                            @endif 
                            <label for="">Targ'ibot holati</label>
                            <input type="text" value="@if($Card['status']=='0') Kutilmoqda @else Bajarilmoqda @endif" disabled class="form-control">
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
    @if($Card['count_group'] == 0)
    <div class="row mt-3 justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8"><h5 class="card-title mb-0">Targ'ibot guruhlarini tanlang</h5></div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('card_groups_plus') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="hidden" name="card_id" value="{{ $Card['id'] }}">
                                <label for="group_type">Guruh turlari</label>
                                <select name="group_type" id="group_type" required class="form-select my-2" onchange="showUser(this.value)">
                                    <option value="">Tanlang...</option>
                                    <option value="all_channels_groups">Barcha guruh(kanal)lar</option>
                                    <option value="all_channels">Barcha kanallar</option>
                                    <option value="all_groups">Barcha guruhlar</option>
                                    <option value="audience_groups">Auditoriya guruhlar</option>
                                </select>
                            </div>
                            <div class="col-12 p-3">
                                <div id="txtHint">
                                    
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary w-100">Saqlash</button>
                            </div>
                        </div>
                    </form>
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                        function showUser(groupType) {
                            if (groupType === "") {
                                $('#txtHint').empty();
                                return;
                            }
                            $.ajax({
                                url: '/fetch-groups/' + groupType,
                                type: 'GET',
                                success: function(response) {
                                    var checkboxesHtml = '';
                                    response.forEach(function(group) {
                                        checkboxesHtml += `
                                            <div class="row p-1">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" name="week_days[]" id="${group.id}" value="${group.id}">
                                                    <label class="form-check-label" for="${group.id}">${group.name}</label>
                                                </div>
                                            </div>
                                        `;
                                    });
                                    $('#txtHint').html(checkboxesHtml);
                                },
                                error: function() {
                                    alert('An error occurred while loading the groups.');
                                }
                            });
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="row mt-3 justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8"><h5 class="card-title mb-0">Targ'ibot uchun tangangan guruh va kanallar</h5></div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>tg_id</th>
                                <th>Guruh/Kanal</th>
                                <th>Guruh/Kanal nomi</th>
                                <th>Foydalanuvchilar soni</th>
                                <th>O'chirish</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($CardItem as $item)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $item['tg_id'] }}</td>
                                <td>{{ $item['group_type'] }}</td>
                                <td>{{ $item['name_group'] }}</td>
                                <td>{{ $item['members_count'] }}</td>
                                <td>
                                    @if($Card['status'] == 0)
                                    <form action="{{ route('card_groups_delete',$item['id']) }}" method="post">
                                        @csrf 
                                        @method('delete')
                                        <input type="hidden" name="card_id" value="{{$Card['id']}}">
                                        <button class="btn btn-danger p-0 px-1"><i class="bi bi-trash"></i></button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                
                </div>
            </div>
        </div>
    </div>
    @endif
</div>



@endsection
