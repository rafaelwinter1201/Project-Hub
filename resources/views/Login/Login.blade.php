<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Sway Hub</title>
  <link href="{{ asset('css/login.css') }}" rel="stylesheet">
  <link rel="shortcut icon" type="imagex/png" href="{{ asset('images/icon.ico') }}" />
  <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
</head>
<body>

<div class="circulo amarelo"></div>
<div class="circulo laranja pequeno abaixo"></div>
<section class="conteudo naoSelecionavel">
  <form method="POST">
    @csrf
    <div class="bloco text-center">
      <h5 class="text-center text-black-50">Faça o seu Login:</h5>
      <div class="input-group">
        <div class="form-floating mb-3">
          <input
            required
            type="text"
            name="username"
            value="{{ isset($user) ? $user : '' }}"
            class="
              form-control
              {{ $mensagem ? 'invalid' : '' }}
            "
            id="login"
            placeholder="Login"
            id="floatingPassword"
            data-error="Preencha aqui."
            title="Preencha aqui."
            oninvalid="this.setCustomValidity('Preencha aqui.')"
            onchange="try{setCustomValidity('')}catch(e){}"
            type="login"
            minlength="3"
            maxlength="50"
          />
          <label for="login">Usuário</label>
          <div class="input-group-append">
            <img
              src="{{ asset('images/close.png') }}"
              class="apaga"
              id="apaga"
              onclick="limparCampo()"
              alt="limpar campo"
            />
          </div>
        </div>
      </div>
      <div class="form-floating">
        <input
          required
          type="password"
          name="password"
          class="
            form-control
            {{ $mensagem ? 'invalid' : '' }}
          "
          id="senha"
          placeholder="******"
          minlength="3"
          maxlength="50"
          data-error="Preencha aqui."
          title="Preencha aqui."
          oninvalid="this.setCustomValidity('Preencha aqui.')"
          onchange="try{setCustomValidity('')}catch(e){}"
        />
        <label for="senha">Senha</label>
        <div class="input-group-append">
          <img
            src="{{ asset('images/eye-open.png') }}"
            class="olho"
            id="olho"
            alt="Mostrar Senha"
          />
        </div>
      </div>
      <p class="senhaIncorreta">{{ $mensagem }}</p>
      <div class="butaum">
        <button class="btn btn-three">
          <span>ENTRAR</span>
        </button>
      </div>
    </div>
  </form>
</section>

<div class="circulo laranja leftone"></div>
<div class="circulo amarelo pequeno lefttwo"></div>
<div class="circulo amarelo pequeno"></div>
<script
  src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
  crossorigin="anonymous"
></script>
<script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
      var senha = $("#senha");
      var olho = $("#olho");

      olho.mousedown(function () {
        senha.attr("type", "text");
      });

      olho.mouseup(function () {
        senha.attr("type", "password");
      });
      // para evitar o problema de arrastar a imagem e a senha continuar exposta,
      //citada pelo nosso amigo nos comentários
      $("#olho").mouseout(function () {
        $("#senha").attr("type", "password");
      });

      function limparCampo() {
        document.getElementById("login").value = "";
      }
    </script>
  </body>
</html>