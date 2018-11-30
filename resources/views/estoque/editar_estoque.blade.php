@extends('layouts.painel')
@section('content')
    <div class="title">
        Editar Estoque
    </div>
    <div class="card">
        <div class="card-header">Estoque</div>
        <div class="card-body">
            @if (Session::has('sucesso_estoque'))
                <div class="alert alert-success" id="success-alert">{{ Session::get('sucesso_estoque') }} </div>
            @endif
            <form method="POST" action="{{ route('edtEstoque') }}">
                 @csrf
                 <div class="form-row">
                     <!--  nome e email -->
                     <div class="form-group col-md-6 {{ $errors->has('quantidade') ? 'has-error' : '' }}">
                         <label for="inputName" class="font-weight-bold">Quantidade</label>
                         <input type="text" class="form-control" id="inputName" name="quantidade" placeholder="Quantidade"  value="{{ old('quantidade') }}" >
                         <span class="text-danger">{{ $errors->first('quantidade') }}</span>
                     </div>
                     <div class="form-group col-md-4">
                         <label for="produto" class="font-weight-bold">Produto</label>
                         <select id="produto"  name="produto" class="form-control">
                             <option selected>Produto</option>
                             <option value="Acetona" @if(old('produto') == 'Acetona')selected @endif>Acetona</option>
                             <option value="Ácido Acético Glacial" @if(old('produto') == 'Ácido Acético Glacial')selected @endif>Ácido Acético Glacial</option>
                             <option value="Butanol" @if(old('produto') == 'Butanol')selected @endif>Butanol</option>
                             <option value="Hexano" @if(old('produto') == 'Hexano')selected @endif>Hexano</option>
                             <option value="Melamina" @if(old('produto') == 'Melamina')selected @endif>Melamina</option>
                             <option value="Poliol" @if(old('produto') == 'Poliol')selected @endif>Poliol</option>
                             <option value="Tricloroetileno" @if(old('produto') == 'Tricloroetileno')selected @endif>Tricloroetileno</option>
                             </select>
                         <span class="text-danger">{{ $errors->first('produto') }}</span>
                     </div>
                     <div class="form-group col-md-2">
                         <label for="adicionar" class="font-weight-bold" >Adicionar</label>
                         <button  class="btn btn-success form-control">Adicionar</button>
                     </div>
                     </div>

                 </div>

       </form>

  @endsection
