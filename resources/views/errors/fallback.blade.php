<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $code }} - {{ $message }}</title>
    <link rel="shortcut icon" type="imagex/png" href="{{ asset('images/icon.ico') }}">
    <style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background-color: #f0f6fc; /* Azul claro */
        color: #333; /* Preto */
    }

    .error-container {
        width: 80%;
        max-width: 600px;
        margin: 100px auto;
        padding: 20px;
        background-color: #fff; /* Branco */
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    h1 {
        color: #007bff; /* Azul */
    }

    p {
        margin-bottom: 10px;
    }
</style>
</head>
<body>
    <div class="error-container">
        <img src="{{ asset('images/cat.gif') }}" height="200rem" alt="gif de um gato">
        <h1>Ops!</h1>
        <h1>{{ $code }} - {{ $message }}</h1>
        <p>Desculpe-nos, ocorreu um erro inesperado.</p>
        <p>Tente novamente mais tarde.</p>
        <p><a href="{{ route('dashboard') }}">Voltar para a página anterior</a></p>
    </div>
</body>
</html>
