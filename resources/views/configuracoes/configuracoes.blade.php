@extends('layouts.painel')
@section('content')
    <div class="title">
        Configurações
    </div>
    <div class="card">
        <div class="card-header">Estoque</div>
        <div class="card-body">
            @if (Session::has('sucesso_configuracoes'))
                <div class="alert alert-success" id="success-alert">{{ Session::get('sucesso_configuracoes') }} </div>
            @endif
                <form method="POST" action="{{ route('regConfiguracoes') }}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6 {{ $errors->has('latitude') ? 'has-error' : '' }}">
                            <label for="inputName" class="font-weight-bold">latitude</label>
                            <input type="text" class="form-control" id="latitude" name="latitude" placeholder="latitude"  value="{{ old('latitude') }}" >
                            <span class="text-danger">{{ $errors->first('latitude') }}</span>
                        </div>
                        <div class="form-group col-md-6 {{ $errors->has('longitude') ? 'has-error' : '' }}">
                            <label for="inputName" class="font-weight-bold">longitude</label>
                            <input type="text" class="form-control" id="longitude" name="longitude" placeholder="longitude"  value="{{ old('longitude') }}" >
                            <span class="text-danger">{{ $errors->first('longitude') }}</span>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="adicionar" class="font-weight-bold" >Adicionar</label>
                            <button  class="btn btn-success form-control">Adicionar</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>


    <div class="card"><div class="card-header">Lista de Configurações</div>
        <div class="table-responsive " style="table-layout:fixed ;width:100%;  white-space: nowrap;">
            <table class="table table-bordered text-center ">
                <thead>
                <th>latitude</th>
                <th>longitude</th>
                <th>Deletar</th>
                </thead>
                <tbody>
                @foreach($configuracoes as $configuracao)
                    <tr>
                        <td>{{ $configuracao->latitude }}</td>
                        <td>{{ $configuracao->longitude }}</td>
                        <td>
                            <!-- GAMB PARA APAGAR -->
                            <form  method="POST" action="/configuracoes/deletar/{{$configuracao->id}}">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button class="btn btn-outline-danger" type="submit"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
  </div>
</div>
    <script type="text/javascript">
        //faz o alert sumir
        $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
            $("#success-alert").slideUp(500);
        });
        //faz mask nos inputs
        $("input[id*='latitude']").inputmask({
            mask: ['99.99999','-99.99999'],
            keepStatic: true
        });
        $("input[id*='longitude']").inputmask({
            mask: ['99.99999','-99.99999'],
            keepStatic: true
        });
    </script>
@endsection
