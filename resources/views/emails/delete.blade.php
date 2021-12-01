@extends('master')
@section('title', 'Delete email')
@section('content')
<div>
    <p class="text-muted">Oh no! {{$email->email}} ci dispiace che ci lasci!!</p>
</div>
<form method="post" action="{{action([\App\Http\Controllers\MailingController::class,'destroy' ],$email->id)}}" class="float-left mr-2">
    @csrf
    <div>
        <button class="btn btn-warning">
            Unsubscribe
        </button>
    </div>
</form>
@endsection
