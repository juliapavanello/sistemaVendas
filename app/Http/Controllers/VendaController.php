<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\DAO\UserDAO;
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

        $validated = Validator::make($request->all(), [
            'usuario_id' => 'required',
        ]);

        //tem que rever o que acontece caso envie um dado inválido quando houver a view pronta
        if ($validated->fails()) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        }

        if(!UserDAO::getById($data['usuario_id'])){
            return redirect()->back()
            ->withErrors(['Usuário não encontrado'])
            ->withInput();
        }

        VendaDAO::create($data);
    }

    public function edit($id)
    {
        return view("/venda/createVenda", ["action" => 'edit']);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $validated = Validator::make($request->all(), [
            'usuario_id' => 'required',
        ]);

        //tem que rever o que acontece caso envie um dado inválido quando houver a view pronta
        if ($validated->fails()) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        }

        if(!UserDAO::getById($data['usuario_id'])){
            return redirect()->back()
            ->withErrors(['Usuário não encontrado'])
            ->withInput();
        }

        VendaDAO::updateById($id,$data);
    }

    public function delete($id)
    {
        VendaDAO::delete($id);
    }
}
