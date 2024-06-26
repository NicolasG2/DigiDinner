<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingsController;

Route::get('/', 'AtendimentoController@main')->name('main');

Route::get('/main', 'AtendimentoController@main')->name('main');

Route::prefix('pedidos')->name('pedidos.')->group(function () {
    Route::get('/', 'PedidoController@main')->name('main');
    Route::get('/main', 'PedidoController@main')->name('main');
});

Route::get('/settings/settings', function () {
    return view('settings.settings');
})->name('settings.settings');

Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');

Route::prefix('settings')->group(function () {
    Route::resource('/mesas', 'MesaController');
});

Route::post('/atendimentos', 'AtendimentoController@store');
Route::resource('/vendas', 'VendaController');
Route::resource('/despesas', 'DespesaController');
Route::resource('/estoque', 'EstoqueController');
Route::resource('/categorias', 'CategoriaController');
Route::resource('/clientes', 'ClienteController');
Route::resource('/produtos', 'ProdutoController');
Route::resource('/ingredientes', 'IngredienteController');
Route::resource('/fornecedores', 'FornecedorController');
Route::resource('/users', 'UserController');

Route::post('/estoque/update', ['EstoqueController', 'update'])->name('estoque.update');