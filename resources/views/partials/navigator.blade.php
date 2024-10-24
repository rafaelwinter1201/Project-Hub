<header class="navbar navbar-expand-lg bg-body-tertiary fixed">
    <div class="container-fluid">
        <!-- Logo à esquerda -->
        {{-- <a class="navbar-brand" href="{{ route('dashboard') }}"> --}}
        <a class="navbar-brand" href="{{ route('orders') }}">
            <img class="imagem-grande" src="{{ asset('images/logo.png') }}" alt="Logo do site" />
            Sway Hub
        </a>

        <!-- Ícones do menu à direita -->
        <div class="collapse navbar-collapse justify-content-end">
            <ul>
                <a id="theme-toggle">
                    @if ($theme == 'dark')
                        <img src="{{ asset('images/sun.png') }}" alt="Tema do site (dark/light)"
                            class="h-1_5 m-2 hover-pointer" data-bs-toggle="tooltip" data-bs-placement="bottom"
                            data-bs-title="Alternar tema">
                    @else
                        <img src="{{ asset('images/moon.png') }}" alt="Tema do site (dark/light)"
                            class="h-1_5 m-2 hover-pointer" data-bs-toggle="tooltip" data-bs-placement="bottom"
                            data-bs-title="Alternar tema">
                    @endif
                </a>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown exit">
                    <a class="nav-link dropdown-togle" role="button" data-bs-toggle="dropdown" id="dropdownMenuLink"
                        aria-expanded="false">
                        <spam class="username">{{ ucfirst(strtolower($username)) }}</spam><br />
                        <small class="perfil">{{ ucfirst(strtolower($perfil)) }}</small>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                        <li>
                            <a class="dropdown-item text-exit" href="{{ route('logout') }}">
                                <img class="h-1_3 color-line" src="{{ asset('images/logout.png') }}"
                                    alt="Imagem de logOut" />
                                Sair
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</header>
<div class="nav-separator"></div>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav my-auto">
                {{-- <a class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}"
                    href="{{ route('dashboard', request()->query()) }}">
                    <div class="conteudo">
                        <img class="nav-image {{ Route::is('dashboard') ? 'brilho' : '' }}"
                            src="{{ asset('images/home.png') }}" alt="Logo Home" />
                        <span>Dashboard</span>
                    </div>
                </a> --}}
                <a class="nav-link {{ Route::is('orders') ? 'active' : '' }}" href="{{ route('orders') }}">
                    <div class="conteudo">
                        <img class="nav-image {{ Route::is('orders') ? 'brilho' : '' }}"
                            src="{{ asset('images/way.png') }}" alt="Logo Pedidos" />
                        <span>Pedidos</span>
                    </div>
                </a>
                @if (Route::is('details'))
                    <a class="nav-link {{ Route::is('details') ? 'active' : 'disabled' }}">
                        <div class="conteudo">
                            <img class="nav-image {{ Route::is('details') ? 'brilho' : '' }}"
                                src="{{ asset('images/viewdetails.png') }}" alt="Logo Pedidos" />
                            <span>Detalhes</span>
                        </div>
                    </a>
                @endif
            </div>
        </div>
    </div>
</nav>
