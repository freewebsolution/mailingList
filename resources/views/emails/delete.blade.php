@extends('master')
@section('title', 'Delete email')
@section('content')
    <div class="container mx-auto">
        <p class="text-muted text-center">Oh no! {{$email->email}} ci dispiace che ci lasci!!</p>

        <form method="post" action="{{action([\App\Http\Controllers\MailingController::class,'destroy' ],$email->id)}}" class="float-left mr-2 text-center">
            @csrf

            <button class="btn btn-warning">
                Unsubscribe
            </button>
        </form>
    </div>

@endsection
