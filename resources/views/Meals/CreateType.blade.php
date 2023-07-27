@extends('main')

@section('menu')
<br>
@if(Session::has('typzalogowanego') && Session::get('typzalogowanego') == 1)
<a href="/menu" class="btn btn-primary"> Wszystkie </a>
<hr>
@endif

@endsection

@section('content')

<div class="container">
    @if(Session::has('typzalogowanego') && Session::get('typzalogowanego') == 1)
    <form method="POST" action="/menu/dodawanierodzaju">
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
            <div class="col-sm-12">
                <button class="btn btn-primary">Dodaj</button>
            </div>
        </div>
    </form>
    @else
    <div class="alert alert-danger">
        Brak uprawnień do wyswietlenia strony.
    </div>
    @endif
    @endsection
</div>