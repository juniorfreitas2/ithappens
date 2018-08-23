<?php

namespace App\Http\Controllers;

use App\Filial;
use App\ItemPedidoEstoque;
use App\PedidoEstoque;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = PedidoEstoque::all();

        return view('pedidos.index', compact('pedidos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $filiais = Filial::all();

        return view('pedidos.create', compact('filiais'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();

            $pedido = PedidoEstoque::create($data);

            if (!$pedido) {
                return redirect()->back()->withInput()->withErrors(['error' => 'Erro ao cadastrar pedido']);
            }

            return redirect(url("/ithappens/pedidos/view/{$pedido->ped_id}"));
        } catch (\Exception $e) {
            if (config('app.debug')) {
                throw $e;
            }

            return redirect()->back()->withErrors(['exception' => 'Desculpe, ocorreu um erro interno']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function view($id)
    {
        $pedido = PedidoEstoque::find($id);

        if (!$pedido) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Pedido não encontrado']);
        }

        return view('pedidos.view', compact('pedido'));
    }

    public function addProduct($id)
    {
        $pedido = PedidoEstoque::find($id);

        if (!$pedido) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Pedido não encontrado']);
        }

        $produtos = $pedido->filial->produtos;

        return view('pedidos.addproduto', compact('pedido', 'produtos'));

    }

    public function storeProduct(Request $request)
    {
        try {
            $data = $request->all();

            $itemPedido = ItemPedidoEstoque::create($data);

            if (!$itemPedido) {
                return redirect()->back()->withInput()->withErrors(['error' => 'Erro ao cadastrar item']);
            }

            return redirect(url("/ithappens/pedidos/view/{$itemPedido->ipe_ped_id}"));
        } catch (\Exception $e) {
            if (config('app.debug')) {
                throw $e;
            }

            return redirect()->back()->withErrors(['exception' => 'Desculpe, ocorreu um erro interno']);
        }

    }
}
