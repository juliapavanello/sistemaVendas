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
        $vendas = VendaDAO::getAll();
        $itensVenda = ItemVendaDAO::getAll();
        $caixas = CaixaDAO::getAll();
        $produtos = ProdutoDAO::getAll();
        $usuarios = [];
        foreach ($vendas as $venda) {
            $usuarios[$venda->id] = UserDAO::getById($venda->usuario_id);
        }

        $qtdPorPg = 7;
        if ($vendas->count() < 7)
            $qtdPorPg = $vendas->count();
        return view("/venda/historicoVendas", compact("vendas", 'usuarios', 'itensVenda', 'caixas', 'produtos', 'qtdPorPg'));
    }

    public function create()
    {
        $produtos = ProdutoDAO::getAll();
        $action = 'create';
        $qtdPorPg = 4;
        return view("/venda/createVenda", compact("produtos", "qtdPorPg", "action"));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        $data['usuario_id'] = session('user')->id;

        $validated = Validator::make($request->all(), [
            'itens_venda' => 'required|array|min:1',
        ]);

        //tem que rever o que acontece caso envie um dado inválido quando houver a view pronta
        if ($validated->fails()) {
            dd('' . $validated->errors());
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        }

        if (!UserDAO::getById($data['usuario_id'])) {
            dd('' . $validated->errors());
            return redirect()->back()
                ->withErrors(['Usuário não encontrado'])
                ->withInput();
        }

        $itensVenda = $data['itens_venda'];
        unset($data['itens_venda']);

        $vendaCriada = VendaDAO::create($data);
        //dd($vendaCriada);

        $total = 0;

        foreach ($itensVenda as $index => $item) {
            if ($item['quantidade'] > 0) {
                $controllerItemVenda = new ItemVendaController();
                $item['produto_id'] = $index;
                $item['venda_id'] = $vendaCriada->id;
                $request = new Request($item);
                $controllerItemVenda->store($request);

                $produto = ProdutoDAO::getById($index);
                //dd($produto);
                $total += $item['quantidade'] * $produto->preco;
            }
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

        return redirect()->route('vendas.index');
    }

    public function edit($id)
    {
        $venda = VendaDAO::getById($id);
        $itensVenda = ItemVendaDAO::getByIdVenda($id);
        $produtos = ProdutoDAO::getAll();
        foreach ($produtos as $index => $item) {
            $itemComprado = $itensVenda->first(function ($x) use ($item) {
                return $x->produto_id == $item->id;
            });

            $qtd = 0;
            if ($itemComprado) {
                $qtd = $itemComprado->quantidade;
            }
            $item['qtdComprada'] = $qtd;
        }
        $action = 'edit';
        $qtdPorPg = 4;
        return view("/venda/createVenda", compact("produtos", "qtdPorPg", "action","venda"));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        unset($data['_token']);
        unset($data['_method']);
        $data['usuario_id'] = session('user')->id;

        $validated = Validator::make($request->all(), [
            'itens_venda' => 'required|array|min:1',
        ]);

        //tem que rever o que acontece caso envie um dado inválido quando houver a view pronta
        if ($validated->fails()) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        }
        if (!UserDAO::getById($data['usuario_id'])) {
            return redirect()->back()
                ->withErrors(['Usuário não encontrado'])
                ->withInput();
        }

        // foreach($data['itens_venda'] as $item){
        //     $controllerItemVenda = new ItemVendaController();
        //     $request = new Request($item);
        //     $controllerItemVenda->update($request);
        // }

        $itensNovos = $data['itens_venda'];
        $itensAntigos = ItemVendaDAO::getByIdVenda($id);
        //dd($itensAntigos);

        $total = 0;
        foreach ($itensAntigos as $item) {
            //dd($item->venda_id);
            if ($item->venda_id == $id) {
                $produto = ProdutoDAO::getById($item->produto_id);
                $total += $item->quantidade * $produto->preco;
            }
        }

        $controllerIV = new ItemVendaController();
        foreach ($itensAntigos as $item) {
            $contApareceu = 0;
            foreach ($itensNovos as $iv) {
                if (isset($iv['id']) && $iv['id'] == $item->id) {
                    $contApareceu++;
                    $iv['venda_id'] = $id;
                    $request = new Request($iv);
                    //dd($request);
                    $controllerIV->update($request, $item->id);
                }
            }
            if ($contApareceu == 0) {
                $controllerIV->delete($item->id);
            }
        }

        $total = 0;

        foreach ($itensNovos as $index => $item) {
            if (!isset($item['id']) || $item['id'] == null) {
                $item['venda_id'] = $id;
                $request = new Request($item);
                $controllerIV->store($request);
            }

            $produto = ProdutoDAO::getById($index);
            $total += $item['quantidade'] * $produto->preco;
        }

        $idCaixa = CaixaDAO::getByIdVenda($id)->id;

        $request = new Request([
            'fonte' => 'Venda',
            'tipo' => 'Entrada',
            'dinheiro' => $total,
            'usuario_id' => $data['usuario_id'],
            'venda_id' => $id,
        ]);

        $controller = new CaixaController();
        $controller->update($request, $idCaixa);

        unset($data['itens_venda']);
        VendaDAO::updateById($id, $data);

        return redirect()->route('vendas.index');
    }

    public function destroy($id)
    {
        $itensTotais = ItemVendaDAO::getAll();
        //dd($itensTotais);
        foreach ($itensTotais as $item) {
            //dd($item->venda_id);
            if ($item->venda_id == $id) {
                $controllerItem = new ItemVendaController();
                //dd($item->id);
                $controllerItem->delete($item->id);
            }
        }

        $idCaixa = CaixaDAO::getByIdVenda($id)->id;
        $controller = new CaixaController();
        $controller->destroy($idCaixa);

        VendaDAO::delete($id);

        return redirect()->back();
    }
}
