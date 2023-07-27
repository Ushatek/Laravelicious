@extends('main')

@section('menu')

<br>
@if(Session::has('typzalogowanego') && Session::get('typzalogowanego') == 1)
<a href="/menu/dodawanie" class="btn btn-primary"> Dodaj </a>
<a href="/menu/dodawanierodzaju" class="btn btn-primary"> Dodaj nowy rodzaj</a>
<hr>
@endif

@endsection

@section('content')

<div class="container">
    <div class="text-center">
        <form class="form-inline my-2 my-lg-0" method="POST" action="/menu" name="search">
        @csrf
            <label style="font-size : 3em" class="text-center">Menu</label>
            <input style="position: absolute; right: 30%" class=" mr-sm-2" type="search" placeholder="Wyszukaj" aria-label="Search" name="search">
            <button style="position: absolute; right: 26%" class="btn btn-outline-success my-2 my-sm-0" type="submit">Szukaj</button>
        </form>
    </div>
    @if(session('message'))
    <br>
    <div class="alert alert-danger">{{session('message')}}</div>
    @endif

    <form method="POST" action="/menu" name="order">
        @csrf
        @foreach($types as $type)
        <div class="row gy-3">
            <h2>{!! $type->Name !!}
                @if(Session::has('typzalogowanego') && Session::get('typzalogowanego') == 1)
                <a href="{{ url() -> current() }}/edycjarodzaju/{{ $type->Id }}" class="btn btn-primary">Edytuj</a>
                @endif
            </h2>

            @foreach($type -> Meals as $item)
            @if($item -> IsActive == true)
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title h5">{{ $item->Name }}</p>
                        {!! $item->Price !!} zł
                    </div>
                    <div class="card-footer">
                        @if(Session::has('typzalogowanego') && Session::get('typzalogowanego') == 1)
                        <a href="{{ url() -> current() }}/edycja/{{ $item->Id }}" class="btn btn-primary">Edytuj</a>
                        <a href="{{ url() -> current() }}/usun/{{ $item->Id }}" class="btn btn-danger">Usuń</a>
                        @elseif(Session::has('typzalogowanego') && Session::get('typzalogowanego') == 2)
                        <div class="number-input">
                            <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="minus"></button>
                            <input class="quantity validate" min=0 max=10 name="orderedMeal[ilosc][]" value="0" type="number">
                            <input type="hidden" name="orderedMeal[MealId][]" value="{!! $item->Id !!}">
                            <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
                        </div>

                        @else
                        <a href="/logowanie" class="btn btn-primary">Zamów</a>
                        @endif

                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
        <hr>
        <br>
        @endforeach
        @if(Session::has('typzalogowanego') && Session::get('typzalogowanego') == 2)
        <button type="submit" class="form-control zamow-button submit px-3">Zamów</button>
        @endif
    </form>
</div>

@endsection