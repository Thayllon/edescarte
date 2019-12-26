@extends('layouts.app')
@section('title', $loja->nome)
@section('content')
<div class="conteiner">
    <h1 style="padding-top: 15px;">Farmácia {{$loja->nome}}</h1>
    <div class="row">
        <div class="col-md-6 col-md-3">
            <ul>
                <li> Nome: {{$loja->nome}} </li>
                <li> Endereço: {{$loja->endereco}} </li>
                <li> Número: {{$loja->numero}} </li>  
                <li> Telefone: {{$loja->telefone}} </li>
                <li> Status: {{$loja->status}} </li>
                <li> Localização: {{$loja->localizacao}} </li>
                <li> Criado em: {{ date("d/m/Y", strtotime($loja->created_at))}} </li>
            </ul>
        </div>
        @if(file_exists("./img/lojas/" . md5($loja->id) . ".jpg"))
        <div class="col-md-6 col-md-3">
            <a href="{{asset('img/lojas/' . md5($loja->id) . '.jpg')}}" class="thumbnail">
                {{Html::image(asset("img/lojas/" . md5($loja->id) . ".jpg"))}}
            </a>
        </div>        
        @endif
    </div>
</div>
    <a href="javascript:history.go(-1)" class="btn btn-outline-dark">Voltar</a>
    <!--Função javascript elemento voltar uma pagina -->
@endsection


