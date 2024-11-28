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
                    <form action="#" method="post">
                        <label for="">Auditoriya nomini</label>
                        <input type="text" name="catigore_name" value="Auditoriya nomini" class="form-control" required>
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <div class="py-3 mx-4">
                                    <label for="">Auditoriya uchun guruhlarni tanlang</label>
                                    <hr>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="option1" id="checkbox1">
                                        <label class="form-check-label" for="checkbox1">
                                            1-guruh nomi
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="option2" id="checkbox2">
                                        <label class="form-check-label" for="checkbox2">
                                            2-guruh nomi
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="option3" id="checkbox3">
                                        <label class="form-check-label" for="checkbox3">
                                            3-guruh nomi
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="option4" id="checkbox4">
                                        <label class="form-check-label" for="checkbox4">
                                            4-guruh nomi
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="py-3 mx-4">
                                    <label for="">Auditoriya uchun kanallarni tanlang</label>
                                    <hr>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="option1" id="checkbox1">
                                        <label class="form-check-label" for="checkbox1">
                                            1-kanal nomi
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="option2" id="checkbox2">
                                        <label class="form-check-label" for="checkbox2">
                                            2-kanal nomi
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="option3" id="checkbox3">
                                        <label class="form-check-label" for="checkbox3">
                                            3-kanal nomi
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="option4" id="checkbox4">
                                        <label class="form-check-label" for="checkbox4">
                                            4-kanal nomi
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="w-100 text-center">
                            <button class="btn btn-primary w-50">Auditoriya yangilashni saqlash</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
