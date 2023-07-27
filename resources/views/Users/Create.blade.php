@extends('main')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-7 col-lg-4">
        <div class="login-wrap p-4 p-md-5">
            <div class="icon d-flex align-items-center justify-content-center">
                <span class="fa fa-user-o"></span>
            </div>
            <h3 class="text-center mb-4">Rejestracja</h3>
            @if(session('message'))
            <br>
            <div class="alert alert-danger">{{session('message')}}</div>
            @endif
            <form method="POST" action="/rejestracja" class="login-form">
                @csrf
                <div class="form-group" style="margin-top: 10px;">
                    <input type="text" class="form-control rounded-left" id="Name" onchange="validateModel('Name')" placeholder="Nazwa użytkownika" name="Name" value="{{ $model->Name }}" required>
                </div>
                <span id="Name-error" class="text-danger"></span>
                <div class="form-group d-flex" style="margin-top: 10px;">
                    <input type="password" class="form-control rounded-left" id="Pass" onchange="validateModel('Pass')" placeholder="Hasło" name="Password" value="{{ $model->Password }}" required>
                </div>
                <span id="Pass-error" class="text-danger"></span>
                <div class="form-group" style="margin-top: 10px;">
                    <button type="submit" class="form-control btn btn-primary rounded submit px-3">Rejestruj</button>
                </div>
                <div class="form-group d-md-flex">
                    <div class="w-50 text-md-right">
                        Masz już konto?
                        <a href="/logowanie">Zaloguj się!</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section("scripts")
<script>
    function validateModel(propertyId)
    {
        var element = document.getElementById(propertyId);
        var value = element.value;
        $.ajax(
            {
                url: "/rejestracja/validateModel",

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