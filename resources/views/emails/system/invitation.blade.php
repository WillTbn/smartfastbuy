<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Primeiro passo</title>
</head>
<body>
    <h3>Olá {{$name}}</h3>

    <p>Aqui seu password: {{$password}}</p>
    <i> lembrando que pode substitui-lo quando quiser!</i>

    <p>Acesse <a href="{{env('APP_URL_C').'/login'}}" > clique auqi</a> finalize seu cadastro.</p>
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <img src="{{env('APP_URL_C')}}/logo-sfb.png" alt="Smart Fast Buy" srcset="">
    </div>

</body>
</html>
