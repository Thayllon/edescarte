<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Htpp\Requests;
use App\Loja; //trazendo model Loja
use Session;
use Illuminate\Support\Facades\Storage;

class LojasController extends Controller
{
    //metodo que mostrar todas as farmacias
    public function index()
    {
        $loja = Loja::paginate(4);
        return view('loja.index', array('lojas' => $loja, 'busca' => null));
    }

    //metodo para mostrar detalhes das farmacias cadastradas
    public function show($id)
    {
        $loja = Loja::find($id);
        return view('loja.show', ['loja' => $loja]);
    }

    //metodo para levar ate a pagina de criação de uma nova farmacia lojas/create
    public function create()
    {
        if (Auth::check()) {
            return view('loja.create');//nome da pasta.nome do arquivo
        } else {
            return redirect('login');
        }
    }

    //metodo para gravar os dados vindo de create e salvando no banco de dados
    public function store(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required|unique:lojas|min:3', //campo unico no banco
            'endereco' => 'required|min:3',
        ]);

        //salvando a imagem
        if ($request->hasFile('fotoproduto')) {
            $imagem = $request->file('fotoproduto');
            $nomearquivo = md5($id) .".". $imagem->getClientOriginalExtension();
            $request->file('fotoproduto')->move(public_path('./img/lojas/'), $nomearquivo);
        }

        $loja = new Loja();
        $loja->nome = $request->input('nome');
        $loja->endereco = $request->input('endereco');
        $loja->numero = $request->input('numero');
        $loja->telefone = $request->input('telefone');
        $loja->localizacao = $request->input('localizacao');
        $loja->status = $request->input('status');
        if ($loja->save()) {
            return redirect('lojas');
        }
    }

    //metodo para levar ate a pagina de edição de uma nova farmacia lojas/edit
    public function edit($id)
    {
        $loja = Loja::find($id);
        return view('loja.edit', array('loja' => $loja));
    }

    //metodo para gravar os dados vindo de edit e salvando no banco de dados
    public function update($id, Request $request)
    {
        //validando a requisição
        $loja = Loja::find($id);
        $this->validate($request, [
            'nome' => 'required|min:3', 
            'endereco' => 'required|min:3',
            'numero' => 'required|unique:lojas', //campo unico no banco
        ]);

        //salvando a imagem
        if ($request->hasFile('fotoproduto')) {
            $imagem = $request->file('fotoproduto');
            $nomearquivo = md5($id) .".". $imagem->getClientOriginalExtension();
            $request->file('fotoproduto')->move(public_path('./img/lojas/'), $nomearquivo);
        }

        //trocando os dados e salvando
        $loja->nome = $request->input('nome');
        $loja->endereco = $request->input('endereco');
        $loja->numero = $request->input('numero');
        $loja->telefone = $request->input('telefone');
        $loja->localizacao = $request->input('localizacao');
        $loja->status = $request->input('status');
        $loja->save();

        Session::flash('mensagem', 'Farmácia alterada com sucesso!');
        return redirect('lojas');
    }

    //metodo para deletar um dado do banco de dados
    public function destroy($id)
    {
        //ainda tenho que excluir a imagem que salva com cadastro
        
        $loja = Loja::find($id);
        $loja->delete();
        Session::flash('mensagem', 'Farmácia excluída com sucesso!');
        return redirect('lojas');
    }

    //metodo que tras os dados da barra de busca
    public function buscar(Request $request)
    {
        $loja = Loja::where(
            'nome',
            'LIKE',
            '%' . $request->input('busca') . '%'
        )->orwhere(
            'endereco',
            'LIKE',
            '%' . $request->input('busca') . '%'
        )->paginate(4);
        return view('loja.index', array('lojas' => $loja, 'busca' => $request->input('busca')));
    }
}
