@extends('layouts.app')
@section('title', 'Listagem das Farmácias')
@section('content') 
<br/> 
<h1>Farmácias</h1>
    @if(Session::has('mensagem'))
        <div class="alert alert-success">{{Session::get('mensagem')}}</div>
    @endif
    {{Form::open(['url' => ['lojas/buscar']])}}
    <div class="row">
        <div class="col-lg-12">
            <div class="input-group">
                {{Form::text('busca', $busca ,['class'=>'form-control','placeholder'=>'Buscar'])}}
                <span class="input-group-btn">
                    {{Form::submit('Buscar', ['class' => 'btn btn-outline-dark'])}}
                </span>
            </div>
        </div>
    </div>
    <br/>
    {{Form::close()}}
    <div class="row">
        @foreach ($lojas as $loja)
            <div class="col-md-3">
                <h4>{{$loja->nome}}</h4>
                @if(file_exists("./img/lojas/" . md5($loja->id) . ".jpg"))
                    <a class="thumbnail" href="{{ url('lojas/'. $loja->id) }}">
                        {{Html::image(asset("img/lojas/" . md5($loja->id) . ".jpg"))}}
                    </a>
                @else
                    <a class="thumbnail" href="{{ url('lojas/'. $loja->id) }}">
                        {{$loja->nome}}}
                    </a>
                @endif
                @if(Auth::check())
                    {{Form::open(['route' => ['lojas.destroy', $loja->id], 'method' => 'DELETE'])}}
                        <a class='btn btn-secondary' href="{{ url('lojas/' . $loja->id . '/edit') }}">Editar</a>
                    {{Form::submit('Excluir', ['class' => 'btn btn-dark'])}}
                    {{Form::close()}}
                @endif
            </div>
        @endforeach
    </div>
<br/>
{{ $lojas->links() }}
@endsection