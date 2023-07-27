@extends('main')

@section('menu')

<br>
@if(Session::has('typzalogowanego'))
<a href="/zamowienia" class="btn btn-primary"> Wszystkie </a>
<hr>
@endif

@endsection

@section('content')

<div class="container">
    @if(Session::has('typzalogowanego'))
    <div class="text-center">
        <label style="font-size : 3em" class="text-center">Menu</label>
    </div>

    <form method="POST" action="">
        @csrf
        @foreach($types as $type)
        <div class="row gy-3">
            <h2>{!! $type->Name !!}</h2>
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
                            @php
                            $amount = 0
                            @endphp
                            @foreach($modelDetails as $meal)
                            @if($meal->MealsId == $item -> Id && $meal->OrdersId == $model ->Id)
                            @php
                            $amount = $meal->Amount
                            @endphp
                            @endif
                            @endforeach
                            <input class="quantity" min="0" max="10" name="orderedMeal[ilosc][]" value='{!! $amount !!}' type="number">

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
        <button type="submit" class="form-control zamow-button submit px-3">Modyfikuj</button>
        @endif
    </form>
    @else
    <div class="alert alert-success">
        Brak uprawnień do edycji!
    </div>
    <a href="/logowanie" class="btn btn-primary">Zaloguj się</a>
    @endif
</div>

@endsection