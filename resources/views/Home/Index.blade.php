@extends('main')

@section('content')

<div class="container mt-5 text-center">
    @if ($message != "")
    <div class="alert alert-success">
        {{ $message }}
    </div>
    @endif
    <h1>Witaj w Laravelicious!</h1>
    <p>Zapraszamy do naszej restauracji, gdzie możesz spróbować pysznych dań przygotowywanych z najwyższą starannością.</p>
    <a class="btn btn-primary" href="/menu" role="button">Zobacz nasze menu</a>
</div>

@endsection