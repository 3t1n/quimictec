@extends('layouts.painel')
@section('content')
    <div class="title">
        Controle de Ponto
    </div>
    <div class="card">
            <div class="card-header">Controle de Ponto</div>
        <div class="card-body">
        	<div class="table-responsive " style="table-layout:fixed ;width:100%;  white-space: nowrap;">
            <table class="table table-bordered text-center ">
              <thead>
                <th>ID</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Usuario</th>
                <th>Data</th>
                <th>Horário</th>
                <th>Controle</th>
              </thead>
              <tbody>
              @foreach ($ponto as $p)
                  <tr>
                      <td>{{ $p->id }}</td>
                      <td>{{ $p->latitude }}</td>
                      <td>{{ $p->longitude }}</td>
                      <td>{{ $p->nome }}</td>
                      <td>{{ $p->data }}</td>
                      <td>{{ $p->horario }}</td>
                      <td>{{ $p->controle }}</td>
                  </tr>
              @endforeach
              </tbody>
            </table>

        </div>
    </div>
@endsection
