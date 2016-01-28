@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Привет, {{ Auth::user()->name }}</div>

                <div class="panel-body">
                    <a class="bold" href="orders/">
                                       Мои заказы
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
