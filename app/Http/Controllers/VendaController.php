<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\DAO\UserDAO;
use App\DAO\VendaDAO;
use App\DAO\ItemVendaDAO;
use App\DAO\ProdutoDAO;
use App\DAO\CaixaDAO;

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
            'itens_venda' => 'required|array|min:1',
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

        $itensVenda = $data['itens_venda'];
        unset($data['itens_venda']);

        $vendaCriada = VendaDAO::create($data);

        $total = 0;

        foreach($itensVenda as $item){
            $controllerItemVenda = new ItemVendaController();
            $item['venda_id'] = $vendaCriada->id;
            $request = new Request($item);
            $controllerItemVenda->store($request);

            $produto = ProdutoDAO::getById($item['produto_id']);
            $total += $item['quantidade'] * $produto->preco;
        }

        // $itensTotais = ItemVendaDAO::getAll();

        // $total = 0;
        // foreach($itensTotais as $item){
        //     if($item->venda_id == $vendaCriada->id){
        //         $produto = ProdutoDAO::getById($item->produto_id);
        //         $total += $item->quantidade * $produto->preco;
        //     }
        // }

        $requestC = new Request([
            'usuario_id' => $vendaCriada->usuario_id,
            'fonte' => 'Venda',
            'dinheiro' => $total,
            'venda_id' => $vendaCriada->id,
        ]);

        //dd($request->all());

        $controllerC = new CaixaController();
        $controllerC->store($requestC);
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
            'itensVenda' => 'required|array|min:1',
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

        // foreach($data['itens_venda'] as $item){
        //     $controllerItemVenda = new ItemVendaController();
        //     $request = new Request($item);
        //     $controllerItemVenda->update($request);
        // }

        $itensTotais = ItemVendaDAO::getAll();

        $total = 0;
        foreach($itensTotais as $item){
            if($item->venda_id == $id){
                $produto = ProdutoDAO::getById($item->produto_id);
                $total += $item->quantidade * $produto->preco;
            }
        }

        $idCaixa = $CaixaDAO::getByIdVenda($id)->id;

        $request = new Request([
            'fonte' => 'Venda',
            'tipo' => 'Entrada',
            'dinheiro' => $total,
            'usuario_id' => $data['usuario_id'],
            'venda_id' => $id,
        ]);

        $controller = new CaixaController();
        $controller->update($request, $idCaixa);

        VendaDAO::updateById($id,$data);
    }

    public function delete($id)
    {
        $itensTotais = ItemVendaDAO::getAll();
        //dd($itensTotais);
        foreach($itensTotais as $item){
            //dd($item->venda_id);
            if($item->venda_id == $id){
                $controllerItem = new ItemVendaController();
                //dd($item->id);
                $controllerItem->delete($item->id);
            }
        }

        $idCaixa = CaixaDAO::getByIdVenda($id)->id;
        $controller = new CaixaController();
        $controller->destroy($idCaixa);

        VendaDAO::delete($id);
    }
}
