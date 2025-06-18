<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\DAO\ItemVendaDAO;
use App\DAO\ProdutoDAO;
use App\DAO\VendaDAO;

class ItemVendaController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();
        
        $validated = Validator::make($request->all(), [
            'produto_id' => 'required',
            'venda_id' => 'required',
            'quantidade' => 'required|gt:0',
        ]);

        //tem que rever o que acontece caso envie um dado inválido quando houver a view pronta
        if ($validated->fails()) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        }

        if(!ProdutoDAO::getById($data['produto_id'])){
            return redirect()->back()
            ->withErrors(['Produto não encontrado'])
            ->withInput();
        }

        if(!VendaDAO::getById($data['venda_id'])){
            return redirect()->back()
            ->withErrors(['Venda não encontrada'])
            ->withInput();
        }

        ItemVendaDAO::create($data);

        $controllerProduto = new ProdutoController();
        if(!$controllerProduto->realizarVenda($data['produto_id'], $data['quantidade'])){
            return redirect()->back()
            ->withErrors(['Não há estoque para essa quantidade de produto'])
            ->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        
        $validated = Validator::make($request->all(), [
            'produto_id' => 'required',
            'venda_id' => 'required',
            'quantidade' => 'required|gt:0',
        ]);

        //tem que rever o que acontece caso envie um dado inválido quando houver a view pronta
        if ($validated->fails()) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        }

        if(!ProdutoDAO::getById($data['produto_id'])){
            return redirect()->back()
            ->withErrors(['Produto não encontrado'])
            ->withInput();
        }

        if(!VendaDAO::getById($data['venda_id'])){
            return redirect()->back()
            ->withErrors(['Venda não encontrada'])
            ->withInput();
        }

        //ver a verificação para o estoque
        $itemVendaExistente = ItemVendaDAO::getById($id);
        $quantidadeExistente = $itemVendaExistente->quantidade;
        $novaQuantidade = $data['quantidade'];
        $quantidadeEstoque;
        $controllerProduto = new ProdutoController();

        if($quantidadeExistente > $novaQuantidade){
            $quantidadeEstoque = $quantidadeExistente - $novaQuantidade;
            $controllerProduto->desfazerVenda($itemVendaExistente->produto_id, $quantidadeEstoque);

        } else if($quantidadeExistente < $novaQuantidade){
            $quantidadeEstoque = $novaQuantidade - $quantidadeExistente;
            if(!$controllerProduto->realizarVenda($itemVendaExistente->produto_id, $quantidadeEstoque)){
                return redirect()->back()
                ->withErrors(['Não há estoque para essa quantidade de produto'])
                ->withInput();
            }
        }

        ItemVendaDAO::updateById($id, $data);
    }

    public function delete($id)
    {
        $itemVenda = ItemVendaDAO::getById($id);
        $quantidade = $itemVenda->quantidade;
        $controllerProduto = new ProdutoController();
        $controllerProduto->desfazerVenda($itemVenda->produto_id, $quantidade);
        ItemVendaDAO::delete($id);
    }
}
