@extends('templates.header', ['menu' => 'admin'])

@section('conteudo')
    <div class="container">
        <h2 class="my-4">Pedidos</h2>
        <a href="{{ route('pedidos.create') }}" class="btn btn-primary">Adicionar Pedido</a>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Mesa</th>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Cliente</th>
                    <th>Atendente</th>
                    <th>Comentário</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pedidos as $pedido)
                    <tr>
                        <td>{{ $pedido->mesa->id }}</td>
                        <td>{{ $pedido->produto->nome }}</td>
                        <td>{{ $pedido->quantidade }}</td>
                        <td>{{ $pedido->cliente ? $pedido->cliente->nome : 'N/A' }}</td>
                        <td>{{ $pedido->user->name }}</td>
                        <td>{{ $pedido->comentario }}</td>
                        <td>
                            <a href="{{ route('pedidos.edit', $pedido->id) }}" class="btn btn-sm btn-primary">Editar</a>
                            <form action="{{ route('pedidos.destroy', $pedido->id) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
@endsection