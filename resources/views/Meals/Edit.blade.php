@extends('main')

@section('menu')
<br>
@if(Session::has('typzalogowanego') && Session::get('typzalogowanego') == 1)
<a href="/menu/dodawanie" class="btn btn-primary"> Dodaj </a>
<a href="/menu" class="btn btn-primary"> Wszystkie </a>
<hr>
@endif

@endsection

@section('content')
<div class="container">
    @if(session('message'))
    <br>
    <div class="alert alert-danger">{{session('message')}}</div>
    @endif
    @if(Session::has('typzalogowanego') && Session::get('typzalogowanego') == 1)
    <form method="POST" action="/menu/edycja/{{ $model->Id }}">
        @csrf
        <div class="row gy-3">
            <div class="col-md-12 col-lg-6 col-xxl-4">
                <div class="input-group">
                    <label class="input-group-text">
                        Tytuł
                    </label>
                    <input name="Title" class="form-control validate" value="{{ $model->Title }}" required>
                </div>
            </div>

            <div class="col-md-12 col-lg-6 col-xxl-4">
                <div class="input-group">
                    <label class="input-group-text">
                        Nazwa
                    </label>
                    <input name="Name" class="form-control validate" value="{{ $model->Name }}" required>
                </div>
            </div>

            <div class="col-md-12 col-lg-6 col-xxl-4">
                <div class="input-group">
                    <label class="input-group-text">
                        Cena
                    </label>
                    <input name="Price" class="form-control validate" value="{{ $model->Price }}" required>
                </div>
            </div>


            <div class="col-md-12 col-lg-6 col-xxl-4">
                <label class="">
                    Rodzaj dania
                </label>
                <select class="form-select" name="MealTypesId">
                    <option selected>Wybierz rodzaj dania</option>
                    @foreach($types as $type)
                    <option {{ $type->Id == $model->MealTypesId ? "selected" : "" }} value="{{ $type->Id }}">{{ $type->Name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-12">
                <button class="btn btn-primary">Zmień</button>
            </div>
        </div>
    </form>
    @else
    <div class="alert alert-danger">
        Brak uprawnień do wyswietlenia strony.
    </div>
    @endif
</div>
@endsection