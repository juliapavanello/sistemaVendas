<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\DAO\ProdutoDAO;

class ProdutoController extends Controller
{
    public function index()
    {
        return view("/produto/dashboardProduto");
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
        ]);

        if ($validated->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        ProdutoDAO::create($data);
    }

    public function edit($id)
    {
        return view("/produto/createProduto", ["action" => 'edit']);
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
        $qtd =(int) $data['quantidade'] ?? 0;
        $data['quantidade'] = $produto->quantidade + $qtd;
        if($data['quantidade'] < 0){
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

        ProdutoDAO::updateById($id,$data);
    }

    public function delete($id)
    {
        ProdutoDAO::delete($id);
    }
}
