<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Mesa;
use App\Models\Produto;
use App\Models\Cliente;
use App\Models\User;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::all();
        return view('pedidos.index', compact('pedidos'));
    }

    public function main()
    {
        $pedidos = Mesa::orderBy('numero')->get();
        $clientes = Cliente::orderBy('nome')->get();
        $atendentes = User::orderBy('nome')->get();

        return view('templates.main', compact('pedidos', 'clientes', 'atendentes'));
    }

    public function create()
    {
        $mesas = Mesa::all();
        $produtos = Produto::all();
        $clientes = Cliente::all();
        $users = User::all();
        return view('pedidos.create', compact('mesas', 'produtos', 'clientes', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mesa_id' => 'required|exists:mesas,id',
            'produto_id' => 'required|exists:produtos,id',
            'num_pessoas' => 'required|integer',
            'user_id' => 'required|exists:users,id',
            'cliente_id' => 'nullable|exists:clientes,id',
        ]);

        Pedido::create($request->all());

        return redirect()->route('pedidos.index')->with('success', 'Pedido criado com sucesso!');
    }

    public function edit(Pedido $pedido)
    {
        $mesas = Mesa::all();
        $produtos = Produto::all();
        $clientes = Cliente::all();
        $users = User::all();
        return view('pedidos.edit', compact('pedido', 'mesas', 'produtos', 'clientes', 'users'));
    }

    public function update(Request $request, Pedido $pedido)
    {
        $request->validate([
            'mesa_id' => 'required|exists:mesas,id',
            'produto_id' => 'required|exists:produtos,id',
            'num_pessoas' => 'required|integer',
            'user_id' => 'required|exists:users,id',
            'cliente_id' => 'nullable|exists:clientes,id',
        ]);

        $pedido->update($request->all());

        return redirect()->route('pedidos.index')->with('success', 'Pedido atualizado com sucesso!');
    }

    public function destroy(Pedido $pedido)
    {
        $pedido->delete();

        return redirect()->route('pedidos.index')->with('success', 'Pedido excluído com sucesso!');
    }
}
