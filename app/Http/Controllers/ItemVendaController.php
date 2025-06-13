<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DAO\ItemVendaDAO;

class ItemVendaController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();
        //Faça o processamente dos dados no $data e envie
        ItemVendaDAO::create($data);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        //Faça o processamente dos dados no $data e envie
        ItemVendaDAO::updateById($id, $data);
    }

    public function delete($id)
    {
        ItemVendaDAO::delete($id);
    }
}
