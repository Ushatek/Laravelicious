@extends('main')

@section('menu')

<br>
<a href="/zamowienia" class="btn btn-primary"> Wszystkie zamówienia </a>
<hr>

@endsection

@section('content')
@if(Session::has('typzalogowanego') && (Session::get('typzalogowanego') == 1 || Session::get('typzalogowanego') == 2))
<div class="container">
    <div class="text-center">
        <label style="font-size : 3em" class="text-center">Szczegóły zamówienia</label><br>
        <p class="card-title h5">{{ $model->Title }}</p><br>
    </div>
    <div class="row gy-3">
        @php
        $suma = 0
        @endphp
        @foreach($items as $item)
        @php
        $amount = 0
        @endphp
        @foreach($modelDetails as $meal)
        @if($meal->MealsId == $item -> Id && $meal->OrdersId == $model ->Id)
        @php
        $amount = $meal->Amount;
        $suma += $amount * $meal->Price
        @endphp
        @endif
        @endforeach
        @if($item -> IsActive == true && $amount != 0)
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <p class="card-title h5">{{ $item->Name }}</p>
                    {!! $item->Price !!} zł
                </div>
                <div class="card-footer">
                    <p class="card-title h5">Zamówiona ilość: {{ $amount }}</p>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
    <hr>
    <div class="text-center">
        <p class="card-title h5">Łączna kwota zamówienia: {{ $suma }} zł</p><br>
    </div>

    <hr>
    <br>
</div>
@else
<div class="alert alert-danger">
    Brak uprawnień do przeglądania tego zamówienia.
</div>
@endif
@endsection