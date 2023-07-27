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
    @if(session('message'))
    <br>
    <div class="alert alert-danger">{{session('message')}}</div>
    @endif
    @if(Session::has('typzalogowanego') && Session::get('typzalogowanego') == 1)
    <form method="POST" action="/menu/dodawanie">
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
                    <input name="Price" id="Cena" onchange="validateModel('Cena')" class="form-control validate" value="{{ $model->Price }}" required>
                </div>
                <span id="Cena-error" class="text-danger"></span>
            </div>
            <br>
            <br>
            <br>
            <div class="col-md-12 col-lg-6 col-xxl-4">
                <label class="">
                    Rodzaj dania
                </label>
                <select class="form-select" name="MealTypesId" required>
                    <option selected>Wybierz rodzaj dania</option>
                    @foreach($types as $type)
                    <option {{ $type->Id == $model->MealTypesId ? "selected" : "" }} value="{{ $type->Id }}">{{ $type->Name }}</option>
                    @endforeach
                </select>
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

@section("scripts")
<script>
    function validateModel(propertyId)
    {
        var element = document.getElementById(propertyId);
        var value = element.value;
        $.ajax(
            {
                url: "/menu/dodawanie/validateModel",

                type: "POST",

                dataType: "html",

                data:{
                    property: propertyId,
                    value: value,
                    _token: document.getElementsByName("_token")[0].value
                },

                success: function(data){
                    var response = JSON.parse(data);
                    document.getElementById(propertyId+"-error").innerHTML = response.error;
                }
            }
        )

    }
</script>

@endsection