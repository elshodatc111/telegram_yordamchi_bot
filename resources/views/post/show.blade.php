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
                            <a href="#" class="btn btn-success"><i class="bi bi-plus"></i></a>
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
                        <thead>
                            <tr>
                                <td>1</td>
                                <td>Guruhlar_nomlanishi</td>
                                <td>5</td>
                                <td>4</td>
                                <td>
                                    <a href="#" class="btn btn-primary m-0 p-0 px-1"><i class="bi bi-pencil"></i></a> 
                                    <a href="#" class="btn btn-success m-0 p-0 px-1"><i class="bi bi-eye"></i></a> 
                                    <form action="" method="post" style="display: inline;">
                                        <button type="submit" class="btn btn-danger m-0 p-0 px-1"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
