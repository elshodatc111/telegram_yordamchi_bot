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
                            <h4 class="card-title mb-0 pb-0">Auditoriya nomi</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h6 class="w-100 text-center">Auditoriya guruhlari</h6>
                            <table class="table table-bordered text-center">
                                <thead>
                                    <th>#</th>
                                    <th>Guruh nomi</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>1-guruh</td>
                                        <td>
                                            <form action="@" method="post">
                                                <button class="btn btn-danger p-0 px-1"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>2-guruh</td>
                                        <td>
                                            <form action="@" method="post">
                                                <button class="btn btn-danger p-0 px-1"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>3-guruh</td>
                                        <td>
                                            <form action="@" method="post">
                                                <button class="btn btn-danger p-0 px-1"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-6">
                            <h6 class="w-100 text-center">Auditoriya kanalari</h6>
                            <table class="table table-bordered text-center">
                                <thead>
                                    <th>#</th>
                                    <th>Kanal nomi</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>1-kanal</td>
                                        <td>
                                            <form action="@" method="post">
                                                <button class="btn btn-danger p-0 px-1"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>2-kanal</td>
                                        <td>
                                            <form action="@" method="post">
                                                <button class="btn btn-danger p-0 px-1"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>3-kanal</td>
                                        <td>
                                            <form action="@" method="post">
                                                <button class="btn btn-danger p-0 px-1"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
