<?php

namespace App\Http\Controllers;

use App\DAO\AvisoDAO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\DAO\ProdutoDAO;
use App\DAO\UserDAO;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = ProdutoDAO::getAll();
        $avisos = AvisoDAO::getAll();

        $qtdPorPg = 7;
        return view("/produto/dashboardProduto", compact("produtos","avisos","qtdPorPg"));
    }

    public function create()
    {
        return view("/produto/createProduto", ["action" => 'create']);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        //Guarda apenas o inteiro do aviso
        if (preg_match('/\d+/', $data['avisoLeve'], $matches)) {
            $data['avisoLeve'] = (int) $matches[0];
        } else {
            $data['avisoLeve'] = 0; // valor padrão caso nenhum número seja encontrado
        }

        if (preg_match('/\d+/', $data['avisoGrave'], $matches)) {
            $data['avisoGrave'] = (int) $matches[0];
        } else {
            $data['avisoGrave'] = 0; // valor padrão caso nenhum número seja encontrado
        }

        //valor padrão da quantidade é 0 caso seja nula
        $data['quantidade'] = $data['quantidade'] ?? 0;

        $validated = Validator::make($request->all(), [
            'nome' => 'required',
            'custo' => 'required|gt:0',
            'unidade' => 'required|string'
        ]);

        if ($validated->fails()) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        }

        //Define algumas coisas
        if ($data['preco'] == null || $data['preco'] == 0) {
            $data['paraVenda'] = false;
        }

        if (!$data['paraVenda']) {
            $data['descontarEstoque'] = false;
        }

        if ($data['ativarAvisos'] == 'false') {
            $data['avisoLeve'] = 0;
            $data['avisoGrave'] = 0;
        }

        ProdutoDAO::create($data);

        return redirect()->route('produtos.index');
    }

    public function edit($id)
    {
        $produto = ProdutoDAO::getById($id);
        return view("/produto/createProduto", ["action" => 'edit','produto'=> $produto]);
    }

    public function update(Request $request, $id)
    {
        $produto = ProdutoDAO::getById($id);

        if (!$produto) {
            return redirect()->back()->withErrors(['Produto não encontrado.']);
        }

        $data = $request->all();

        //Guarda apenas o inteiro do aviso
        if (preg_match('/\d+/', $data['avisoLeve'], $matches)) {
            $data['avisoLeve'] = (int) $matches[0];
        } else {
            $data['avisoLeve'] = 0; // valor padrão caso nenhum número seja encontrado
        }

        if (preg_match('/\d+/', $data['avisoGrave'], $matches)) {
            $data['avisoGrave'] = (int) $matches[0];
        } else {
            $data['avisoGrave'] = 0; // valor padrão caso nenhum número seja encontrado
        }

        //add qtd
        $qtd = (int) $data['quantidade'] ?? 0;
        $data['quantidade'] = $produto->quantidade + $qtd;
        if ($data['quantidade'] < 0) {
            $data['quantidade'] = 0;
        }

        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'custo' => 'required|gt:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        //Define algumas coisas
        if ($data['preco'] == null || $data['preco'] == 0) {
            $data['paraVenda'] = false;
        }

        if($data['paraVenda'])

        if (!$data['paraVenda']) {
            $data['descontarEstoque'] = false;
        }

        if ($data['ativarAvisos'] == 'false') {
            $data['avisoLeve'] = 0;
            $data['avisoGrave'] = 0;
        }

        unset($data['ativarAvisos']);
        unset($data['ativarAvisoLeve']);
        unset($data['ativarAvisoGrave']);
        unset($data['_token']);
        unset($data['_method']);

        ProdutoDAO::updateById($id, $data);

        return redirect()->route('produtos.index');
    }

    public function destroy($id)
    {
        ProdutoDAO::delete($id);

        return redirect()->back();
    }

    public function realizarVenda($idProduto, $quantidade)
    {
        $produto = ProdutoDAO::getById($idProduto);

        if ($quantidade > $produto->quantidade) {
            return false;
        }

        $novaQuantidade = $produto->quantidade - $quantidade;

        ProdutoDAO::atualizarEstoque($idProduto, $novaQuantidade);
        return true;
    }

    public function desfazerVenda($idProduto, $quantidade)
    {
        $produto = ProdutoDAO::getById($idProduto);

        $novaQuantidade = $produto->quantidade + $quantidade;

        ProdutoDAO::atualizarEstoque($idProduto, $novaQuantidade);
    }
}
