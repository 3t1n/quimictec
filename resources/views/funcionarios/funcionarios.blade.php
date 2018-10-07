@extends('layouts.painel')
@section('content')
    <div class="title">
        Funcionarios
    </div>
    <div class="card">
        <div class="card-header">Funcionarios</div>
        <div class="card-body">
            @if (Session::has('sucesso_funcionario'))
                <div class="alert alert-success" id="success-alert">{{ Session::get('sucesso_funcionario') }} </div>
            @endif
            <form method="POST" action="{{ route('regFuncionarios') }}">
                @csrf

                <div class="form-group row {{ $errors->has('nome') ? 'has-error' : '' }}">
                    <label for="inputname" class="col-sm-2 col-form-label font-weight-bold">Nome</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nome" name='nome' placeholder="Nome" value="{{ old('nome') }}">
                        <span class="text-danger">{{ $errors->first('nome') }}</span>
                    </div>
                </div>
                <div class="form-group row  {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="inputEmail" class="col-sm-2 col-form-label font-weight-bold">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name='email' placeholder="Email" value="{{ old('email') }}">
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    </div>
                </div>
                <div class="form-group row {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label for="inputPassword" class="col-sm-2 col-form-label font-weight-bold">Senha</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name='password' placeholder="Senha">
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Adcionar</button>
                    </div>
                </div>
            </form>
                <script type="text/javascript">
                    //faz o alert sumir
                    $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
                        $("#success-alert").slideUp(500);
                    });
                </script>

        </div>
    </div>
@endsection

