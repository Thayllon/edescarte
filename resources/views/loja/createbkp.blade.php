@extends('layouts.app') 
@section('title', 'Adicionar um produto')
@section('content')
    <h1>Criar uma Farmácia</h1>
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
    {{Form::open(['action' => 'LojasController@store'])}}
    {{Form::label('nome', 'Nome')}}
    {{Form::text('nome','',['class'=>'form-control','required','placeholder'=>'Nome'])}}
    {{Form::label('endereco', 'Endereço')}}
    {{Form::text('endereco','', ['class'=>'form-control','required','placeholder'=>'Endereço'])}}
    {{Form::label('numero', 'Número')}}
    {{Form::text('numero','', ['class'=>'form-control','required','placeholder'=>'Número'])}}
    {{Form::label('telefone', 'Telelfone')}}
    {{Form::text('telefone','', ['class' => 'form-control','required','placeholder' => 'Telefone'])}}
    {{Form::label('localizacao', 'Localização')}}
    {{Form::text('localizacao','', ['class' => 'form-control','placeholder' => 'Localização'])}}
    {{Form::label('status', 'Status')}}
    {{Form::text('status','', ['class' => 'form-control','placeholder' => 'Status'])}}
    <br/>
    {{Form::submit('Cadastrar', ['class' => 'btn btn-outline-dark'])}}
    {{Form::close()}}    
@endsection