<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DAO\AvisoDAO;

class AvisoController extends Controller
{
    public function index()
    {
        return view("/produto/avisosProduto");
    }

    public function store(Request $request)
    {
        $data = $request->all();
        //Faça o processamente dos dados no $data e envie
        AvisoDAO::create($data);
    }

    public function delete($id)
    {
        AvisoDAO::delete($id);
    }
}
