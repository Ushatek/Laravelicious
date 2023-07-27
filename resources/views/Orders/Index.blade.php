@extends('main')

@section('menu')

<br>

@endsection

@section('content')

<div class="container">
    @csrf
    @if(Session::has('typzalogowanego') && Session::get('typzalogowanego') == 2)
    @if(session('message'))
    <div class="alert alert-danger">{{session('message')}}</div>
    @endif
    @if(session('messageok'))
    <div class="alert alert-success">{{session('messageok')}}</div>
    @endif
    <div class="row gy-3">
        <div class="text-center">
            <label style="font-size : 3em" class="text-center">Zamówienia</label>
        </div>
        @foreach($models as $model)
        @if($model -> IsActive == true && $model -> UsersId == Session::get('idzalogowanego'))
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <p class="card-title h5">{{ $model->Title }}</p>
                    Data złożenia zamówienia: {!! $model->CreationDateTime !!}
                    <br>
                    Status zamówienia: {!! $model->OrderStatuts -> Name !!}
                </div>
                <div class="card-footer">
                    <a href="{{ url() -> current() }}/zobacz/{{ $model->Id }}" class="btn btn-primary">Szczegóły</a>
                    @if($model->OrderStatuts -> Name == "Złożone")
                    <a href="{{ url() -> current() }}/edycja/{{ $model->Id }}" class="btn btn-secondary">Edytuj</a>
                    <a href="{{ url() -> current() }}/oplac/{{ $model->Id }}" class="btn btn-success">Opłać</a>
                    <a href="{{ url() -> current() }}/anuluj/{{ $model->Id }}" class="btn btn-danger">Anuluj</a>
                    @endif
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
    @elseif(Session::has('typzalogowanego') && Session::get('typzalogowanego') == 1)
    <div class="row gy-3">
        <div class="text-center">
            <label style="font-size : 3em" class="text-center">Zamówienia</label>
        </div>
        @foreach($models as $model)
        @if($model -> IsActive == true)
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <p class="card-title h5">{{ $model->Title }}</p>
                    Zamówienie złożone przez: {!! $model-> Users -> Name !!}
                    <br>
                    Data złożenia zamówienia: {!! $model->CreationDateTime !!}
                    <br>
                    Status zamówienia: {!! $model->OrderStatuts -> Name !!}
                </div>
                <div class="card-footer">
                    <a href="{{ url() -> current() }}/zobacz/{{ $model->Id }}" class="btn btn-primary">Szczegóły</a>
                    <a href="{{ url() -> current() }}/usun/{{ $model->Id }}" class="btn btn-danger">Usuń</a>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
    @else
    <div class="text-center">
        Zaloguj się by zobaczyć swoje zamówienia: <a href="/logowanie" class="btn btn-primary">Logowanie</a>
    </div>
    @endif
    <hr>
    <br>
</div>

@endsection