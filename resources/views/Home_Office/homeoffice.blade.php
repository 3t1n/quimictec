@extends('layouts.painel')
@section('content')
    <div class="title">
        Home Office
    </div>
    <div class="card"><div class="card-header">Adicionar Home Office</div>
        @if (Session::has('sucesso_home'))
            <div class="alert alert-success" id="success-alert">{{ Session::get('sucesso_home') }} </div>
        @endif
        <div class="table-responsive " style="table-layout:fixed ;width:100%;  white-space: nowrap;">
            <table class="table table-bordered text-center ">
                <thead>
                <th>Nome</th>
                <th>Adicionar</th>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>
                            <a href="/home_office/status/{{ $user->id }}"><button class="btn btn-success" type="submit"><i class="fas fa-plus"></i></button></a>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card"><div class="card-header">Funcionários que estão em Home Office</div>
        <div class="table-responsive " style="table-layout:fixed ;width:100%;  white-space: nowrap;">
            <table class="table table-bordered text-center ">
                <thead>
                <th>Nome</th>
                <th>Data</th>
                <th>Deletar</th>
                </thead>
                <tbody>
                @foreach ($lista as $list)
                    <tr>
                        <td>{{ $list->name }}</td>
                        <td>{{ $list->data }}</td>
                        @if($list->data == $data)
                        <td>
                            <form  method="POST" action="/home_office/delete/{{$list->id}}">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                        @else
                            <td>
                                    <button class="btn btn-primmary" type="submit" disabled><i class="fas fa-times-circle"></i></button>
                            </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
  </div>
</div>
@endsection
