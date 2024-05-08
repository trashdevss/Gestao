<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use App\Models\Produto;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index()
    {
        

        return view("app.fornecedor.index");
    }

    public function listar(Request $request){

        $fornecedores = Fornecedor::where('nome', 'like', '%'.$request->input('nome').'%')
        ->where('site', 'like', '%'.$request->input('site').'%')
        ->where('uf', 'like', '%'.$request->input('uf').'%')
        ->where('email', 'like', '%'.$request->input('email').'%')
        ->simplePaginate(4);

        return view("app.fornecedor.listar", ['fornecedores' => $fornecedores, 'request' => $request->all()]);
    }

    public function adicionar(Request $request){

        $msg = '';
        // inclusão dos dados

        if($request->input('_token') != '' && $request->input('id') == ''){
            // validação dos dados

            $regras = [
                'nome' => 'required|min:4|max:40',
                'site' => 'required',
                'uf' => 'required|min:2|max:2',
                'email' => 'email'
            ];

            $msgFeedback = [
                'required' => 'O campo :attribute deve ser preenchido.',
                'nome.min' => 'O campo nome deve ter no minimo 4 caracteres.',
                'nome.max' => 'O campo nome deve ter no maximo 40 caracteres.',
                'uf.min' => 'O campo UF deve ter no minimo 2 caracteres.',
                'uf.max' => 'O campo UF deve ter no maximo 2 caracteres.',
                'email' => 'O email digitado não é valido'
            ];

            $request->validate($regras, $msgFeedback);

            $fornecedor = new Fornecedor(); // cria o obj fornecedor
            $fornecedor->create($request->all()); // cria dados no bd

            $msg = "Cadastro realizado com SUCESSO!!";
        }
        // edição de dados
        if($request->input('_token') != '' && $request->input('id') != ''){

            $fornecedor = Fornecedor::find($request->input('id'));
            $update = $fornecedor->update($request->all());

            if($update){
                $msg = "Fornecedor atualizado com sucesso!!";
            }else{
                $msg = "Erro na atualização dos dados";
            }
            return redirect()->route("app.fornecedor.editar", ['id' =>$request->input('id'), 'msg' => $msg]);
        }
        return view("app.fornecedor.adicionar", ['msg' => $msg]);
    }

    public function editar($id, $msg = ''){

        $fornecedor = Fornecedor::find($id);

        return view('app.fornecedor.adicionar', ['fornecedor' => $fornecedor, 'msg' => $msg]);
    }

    public function excluir($id){
        Fornecedor::find($id)->delete();

        return redirect()->route('app.fornecedor');
    }
}
