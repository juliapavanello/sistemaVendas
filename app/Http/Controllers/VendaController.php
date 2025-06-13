<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DAO\VendaDAO;

class VendaController extends Controller
{
    public function index()
    {
        return view("/venda/historicoVendas");
    }

    public function create()
    {
        return view("/venda/createVenda", ["action" => 'create']);
    }
    public function store(Request $request)
    {
        $data = $request->all();
        //Faça o processamente dos dados no $data e envie
        VendaDAO::create($data);
    }

    public function edit($id)
    {
        return view("/venda/createVenda", ["action" => 'edit']);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        //Faça o processamente dos dados no $data e envie
        VendaDAO::updateById($id,$data);
    }

    public function delete($id)
    {
        VendaDAO::delete($id);
    }
}
