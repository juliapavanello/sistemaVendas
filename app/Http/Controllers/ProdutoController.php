<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        //Faça o processamente dos dados no $data e envie
        ProdutoDAO::create($data);
    }

    public function edit($id)
    {
        return view("/produto/createProduto", ["action" => 'edit']);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        //Faça o processamente dos dados no $data e envie
        ProdutoDAO::updateById($id,$data);
    }

    public function delete($id)
    {
        ProdutoDAO::delete($id);
    }
}
