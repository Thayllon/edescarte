@extends('layouts.app')
@section('title', 'Editar uma Farmácia')
@section('content')
    <h1 style="padding-top: 15px;">Alterando a {{$loja->nome}}</h1>
    @if(Session::has('mensagem'))
        <div class="alert alert-success">
            {{Session::get('mensagem')}}
        </div>
    @endif
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{Form::open(['route' => ['lojas.update', $loja->id], 'enctype' => 'multipart/form-data', 'method' => 'PUT'])}}
    {{Form::label('nome', 'Nome', ['class' => 'prettyLabels'])}}
    {{Form::text('nome', $loja->nome, ['class'=>'form-control','required','placeholder'=>'Nome'])}}
    {{Form::label('endereco', 'Endereço')}}
    {{Form::text('endereco', $loja->endereco, ['class'=>'form-control','required','placeholder'=>'Endereço'])}}
    {{Form::label('numero', 'Número')}}
    {{Form::text('numero', $loja->numero, ['class'=>'form-control','required','placeholder'=>'Número'])}}
    {{Form::label('telefone', 'Telelfone')}}
    {{Form::text('telefone', $loja->telefone, ['class' => 'form-control','required','placeholder' => 'Telefone'])}}
    {{Form::label('localizacao', 'Localização')}}
    {{Form::text('localizacao', $loja->localizacao, ['class' => 'form-control','required','placeholder' => 'Localização'])}}
    {{Form::label('status', 'Status')}}
    {{Form::text('status', $loja->status, ['class' => 'form-control','placeholder' => 'Status'])}}
    {{Form::label('fotoproduto', 'Foto')}}
    {{Form::file('fotoproduto', ['class' => 'form-control','id' => 'fotoproduto'])}}
    <br/>
    {{Form::submit('Alterar', ['class' => 'btn btn-outline-dark'])}}
    {{Form::close()}}
    <div id="footer" style="padding-bottom: 30px;">    
    </div> 
@endsection