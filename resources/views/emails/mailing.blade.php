<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mailing List</title>
</head>
<body>
<h2>Lucio Ticali</h2>
<div>
    <p>Welcome to Mailing list: {{$email->email}} !</p>
    <p>
    <form method="post" action="{{action([\App\Http\Controllers\MailingController::class,'destroy' ],$email->id)}}" class="float-left mr-2">
        @csrf
        <div>
            <button class="btn btn-warning">
                Unsubscribe
            </button>
        </div>
    </form>
    </p>
</div>
</body>
</html>
