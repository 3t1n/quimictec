<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Painel</title>


    <!-- Custom CSS -->
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <!-- Custom JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
    <script src="https://rawgit.com/RobinHerbots/Inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
    <script src="{{asset('js/jquery.maskedinput.js')}}" type="text/javascript"></script>
    <!-- Custom JS
    <script src="{{ asset('js/jquery.js') }}"></script>-->
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/table-edit.js') }}"></script>
    <!-- Bootstrap CSS CDN -->
    <!-- Custom font -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script type="text/javascript">
        $(function() {
            $('.close').click(function() {
                $('.ad').css('display', 'none');
            })
        })
        $(document).ready(function() {
            $('.nav-trigger').click(function() {
                $('.side-nav').toggleClass('visible');
            });
        });
    </script>
</head>
<body>

    <div class="header">
        <div class="logo">
            <span>Painel</span>
        </div>
        <a href="#" class="nav-trigger"><span></span></a>
    </div>
    <div class="side-nav ">
        <div class="logo">
            <span>  Olá, {{ Auth::user()->name }}</span>
        </div>
        <nav>
            <ul id="menu-content list-unstyled components">
                <li>
                    <a href="{{ url('/home') }}">
                        <span><i class="fas fa-home"></i></span>
                        <span>Home</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('funcionarios') }}">
                        <span><i class="fas fa-users"></i></span>
                        <span>Funcionarios</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('controle_ponto') }}">
                        <span><i class="far fa-clock"></i></span>
                        <span>Controle de Ponto</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('fornecedores') }}">
                        <span><i class="fas fa-users"></i></span>
                        <span>Fornecedores</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('estoque') }}">
                        <span><i class="fas fa-box-open"></i></span>
                        <span>Estoque</span>
                    </a>
                </li>

                <li href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <a style="color: #fff;">
                        <span><i class="fas fa-sign-out-alt"></i></span>
                        <span>Sair</span>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <div class="main-content">
       @yield('content')
    </div>


<!-- jQuery CDN -->

<!-- Bootstrap Js CDN -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
