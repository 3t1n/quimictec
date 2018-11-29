@extends('layouts.painel')
@section('content')
    <div class="title">
        Estoque
    </div>
    <div class="card">
            <div class="card-header">Estoque</div>
        <div class="card-body">
        	<div class="table-responsive " style="table-layout:fixed ;width:100%;  white-space: nowrap;">
            <table class="table table-bordered text-center ">
              <thead>
                <th>ID</th>
                <th>Produto</th>
                <th>Quantidade</th>
                </thead>
              <tbody>
              @foreach ($estoque as $e)
                  <tr>
                      <td>{{ $e->id }}</td>
                      <td>{{ $e->nome_prod }}</td>
                      <td>{{ $e->qtd_prod }}</td>
                      </tr>
              @endforeach
              </tbody>
            </table>

        </div>
    </div>
@endsection
