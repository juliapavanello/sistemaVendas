<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\DAO\UserDAO;
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
        
        $valor = preg_replace('/[^0-9.,]/', '', $data['dinheiro']);
        $valor = str_replace('.', '', $valor);
        $data['dinheiro'] = str_replace(',', '.', $valor);

        $validator = Validator::make($request->all(), [
            'dinheiro' => 'required',
            'tipo' => 'required|in:Entrada,Saída',
            'usuario_id' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if(!UserDAO::getById($data['usuario_id'])){
            return redirect()->back()
            ->withErrors(['Usuário não encontrado'])
            ->withInput();
        }

        //ver como funciona com a venda ou produto
        CaixaDAO::create($data);
    }

    public function edit($id)
    {
        return view("/caixa/retiradaCaixa", ["action" => 'edit']);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        
        $valor = preg_replace('/[^0-9.,]/', '', $data['dinheiro']);
        $valor = str_replace('.', '', $valor);
        $data['dinheiro'] = str_replace(',', '.', $valor);

        $validator = Validator::make($request->all(), [
            'dinheiro' => 'required',
            'fonte' => 'required',
            'tipo' => 'required|in:Entrada,Saída',
            'usuario_id' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if(!UserDAO::getById($data['usuario_id'])){
            return redirect()->back()
            ->withErrors(['Usuário não encontrado'])
            ->withInput();
        }

        CaixaDAO::updateById($id,$data);
    }

    public function delete($id)
    {
        CaixaDAO::delete($id);
    }

    public function calcularUltimos30Dias($tipo){
        $caixas = CaixaDAO::getLast30Days();

        $resultado = 0;
        foreach($caixas as $caixa){
            if($caixa->tipo == $tipo){
                $resultado = $resultado + $caixa->dinheiro;
            }
        }

        return $resultado;
    }
}
