@extends('main')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-7 col-lg-4">
        @if(session('message'))
        <br>
        <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="login-wrap p-4 p-md-5">
            <div class="icon d-flex align-items-center justify-content-center">
                <span class="fa fa-user-o"></span>
            </div>
            <h3 class="text-center mb-4">Logowanie</h3>
            <form method="POST" action="/logowanie" class="login-form">
                @csrf
                <div class="form-group" style="margin-top: 10px;">
                    <input type="text" class="form-control rounded-left" placeholder="Nazwa użytkownika" name="Name" required>
                </div>
                <div class="form-group d-flex" style="margin-top: 10px;">
                    <input type="password" class="form-control rounded-left" placeholder="Hasło" name="Password" required>
                </div>
                <div class="form-group" style="margin-top: 10px;">
                    <button type="submit" class="form-control btn btn-primary rounded submit px-3">Zaloguj</button>
                </div>
                @if ($message != "")
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
                @endif

                <div class="form-group d-md-flex">
                    <div class="w-50 text-md-right">
                        Nie masz konta?
                        <a href="/rejestracja">Zarejestruj się!</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection