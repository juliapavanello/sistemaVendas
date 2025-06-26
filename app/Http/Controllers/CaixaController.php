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
        $caixas = CaixaDAO::getAll();
        $usuarios = [];
        foreach ($caixas as $caixa) {
            $usuarios[$caixa->id] = UserDAO::getById($caixa->usuario_id);
        }

        $entrada30 = $this->calcularUltimos30Dias("Entrada");
        $saida30 = $this->calcularUltimos30Dias("Saída");

        $qtdPorPg = 7;
        return view("/caixa/dashboardCaixa", compact("caixas", 'usuarios', 'entrada30', 'saida30', 'qtdPorPg'));
    }

    public function create()
    {
        return view("/caixa/retiradaCaixa", ["action" => 'create']);
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $negativo = str_contains($data['dinheiro'], '-');
        $valor = preg_replace('/[^0-9.,]/', '', $data['dinheiro']);
        $valor = str_replace('.', '', $valor);
        $data['dinheiro'] = (double) str_replace(',', '.', $valor);

        //Descobre se é entrada ou saída.
        if ($negativo) {
            $data['tipo'] = "Saída";
        } else {
            $data['tipo'] = "Entrada";
        }

        //Define a fonte como retirada a mão
        if (!isset($data['fonte']) || $data['fonte'] === null) {
            $data['fonte'] = $negativo ? "Retirada a mão" : "Entrada a mão";
        }

        //Define o usuário logado como responsável
        $data['usuario_id'] = session('user')->id;

        $validator = Validator::make($request->all(), [
            'dinheiro' => 'required|not_in:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        //ver como funciona com a venda ou produto
        CaixaDAO::create($data);

        return redirect()->route('caixas.index');
    }

    public function edit($id)
    {
        $caixa = CaixaDAO::getById($id);
        return view("/caixa/retiradaCaixa", ["action" => 'edit', 'caixa' => $caixa]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $negativo = str_contains($data['dinheiro'], '-');
        $valor = preg_replace('/[^0-9.,]/', '', $data['dinheiro']);
        $valor = str_replace('.', '', $valor);
        $data['dinheiro'] = (double) str_replace(',', '.', $valor);

        //Descobre se é entrada ou saída.
        if ($negativo) {
            $data['tipo'] = "Entrada";
        } else {
            $data['tipo'] = "Saída";
        }

        //Define a fonte como retirada a mão
        $data['fonte'] = $negativo ? "Entrada a mão" : "Retirada a mão";

        //Define o usuário logado como responsável
        $data['usuario_id'] = session('user')->id;

        $validator = Validator::make($request->all(), [
            'dinheiro' => 'required|not_in:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        unset($data['_token']);
        unset($data['_method']);

        CaixaDAO::updateById($id, $data);

        return redirect()->route('caixas.index');
    }

    public function destroy($id)
    {
        CaixaDAO::delete($id);

        return redirect()->back();
    }

    public function calcularUltimos30Dias($tipo): float|int
    {
        $caixas = CaixaDAO::getLast30Days();

        $resultado = 0;
        foreach ($caixas as $caixa) {
            if ($caixa->tipo == $tipo) {
                $resultado = $resultado + $caixa->dinheiro;
            }
        }

        return $resultado;
    }
}
