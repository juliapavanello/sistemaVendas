<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DAO\CaixaDAO;

class CaixaController extends Controller
{
    public function index()
    {
        return view("/caixa/dashboardCaixa");
    }

    public function create()
    {
        return view("/caixa/retiradaCaixa", ["action" => 'create']);
    }
    public function store(Request $request)
    {
        $data = $request->all();
        //Faça o processamente dos dados no $data e envie
        CaixaDAO::create($data);
    }

    public function edit($id)
    {
        return view("/caixa/retiradaCaixa", ["action" => 'edit']);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        //Faça o processamente dos dados no $data e envie
        CaixaDAO::updateById($id,$data);
    }

    public function delete($id)
    {
        CaixaDAO::delete($id);
    }
}
