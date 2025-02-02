<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioDeleteController; // Importa controller de deletar usuario
use App\Http\Controllers\UsuarioEditController; // Importa controller de editar usuario
use App\Http\Controllers\EquipamentoDeleteController;
use App\Http\Controllers\EquipamentoEditController;
use App\Http\Controllers\OperacaoEditController;
use App\Http\Controllers\MarcaDeleteController;
use App\Http\Controllers\MarcaEditController;
use App\Http\Controllers\CategoriaDeleteController;
use App\Http\Controllers\CategoriaEditController;
use App\Http\Controllers\EstabelecimentoDeleteController;
use App\Http\Controllers\EstabelecimentoEditController;
use App\Http\Controllers\SetorDeleteController;
use App\Http\Controllers\SetorEditController;
use App\Http\Controllers\SalaDeleteController;
use App\Http\Controllers\SalaEditController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('insertUsuario','UsuarioInsertController@insertform')->name('insertUsuario');
Route::post('createUsuario','UsuarioInsertController@insert');
Route::get('insertEquipamento','EquipamentoInsertController@insertform')->name('insertEquipamento');
Route::post('createEquipamento','EquipamentoInsertController@insert');
Route::get('insertMarca','MarcaInsertController@insertform')->name('insertMarca');
Route::post('createMarca','MarcaInsertController@insert');
Route::get('insertEstabelecimento','EstabelecimentoInsertController@insertform')->name('insertEstabelecimento');
Route::post('createEstabelecimento','EstabelecimentoInsertController@insert');
Route::get('insertCategoria','CategoriaInsertController@insertform')->name('insertCategoria');
Route::post('createCategoria','CategoriaInsertController@insert');
Route::get('insertSala','SalaInsertController@insertform')->name('insertSala');
Route::post('createSala','SalaInsertController@insert');
Route::get('insertSetor','SetorInsertController@insertform')->name('insertSetor');
Route::post('createSetor','SetorInsertController@insert');
Route::get('/insertManutencao/{id_equipamento}','OperacaoInsertController@insertManutencaoForm'); 
Route::post('/insertManutencao', 'App\Http\Controllers\OperacaoInsertController@insertManutencao')->name('insertManutencao');
Route::get('/insertMovimentacao/{id_equipamento}','OperacaoInsertController@insertMovimentacaoForm'); 
Route::post('/insertMovimentacao', 'App\Http\Controllers\OperacaoInsertController@insertMovimentacao')->name('insertMovimentacao');
Route::get('/insertEmprestimo/{id_equipamento}','OperacaoInsertController@insertEmprestimoForm'); 
Route::post('/insertEmprestimo', 'App\Http\Controllers\OperacaoInsertController@insertEmprestimo')->name('insertEmprestimo');
Route::post('/insertBaixa', 'App\Http\Controllers\OperacaoInsertController@insertBaixa')->name('insertBaixa');

Route::get('/viewOperacao/{id_equipamento}', function ($id_equipamento) {
    // Find the equipment based on the ID
    $equipamento = DB::table('equipamento')
        ->where('id_equipamento', $id_equipamento)
        ->first();

    // Pass the equipment data to the "operacoes_view" blade template
    return view('operacao_view', compact('equipamento'));
})->name('viewOperacao');

Route::post('/deletarOperacao/{id_operacao}/{id_equipamento}','App\Http\Controllers\OperacaoDeleteController@deletarOperacao')->name('delete.operacao');

Route::get('/editarManutencao/{id_operacao}', [OperacaoEditController::class, 'editManutencao']); //Define rota de editar manutencao
Route::put('/updateManutencao/{id_operacao}/{id_equipamento}', 'OperacaoEditController@updateManutencao')->name('updateManutencao');

Route::get('/editarEmprestimo/{id_operacao}', [OperacaoEditController::class, 'editEmprestimo']); //Define rota de editar manutencao
Route::put('/updateEmprestimo/{id_operacao}/{id_equipamento}', 'OperacaoEditController@updateEmprestimo')->name('updateEmprestimo');

Route::get('/editarMovimentacao/{id_operacao}', [OperacaoEditController::class, 'editMovimentacao']); //Define rota de editar movimentacao
Route::put('/updateMovimentacao/{id_operacao}/{id_equipamento}', 'OperacaoEditController@updateMovimentacao')->name('updateMovimentacao');

Route::post('/deletarUsuario/{id_usuario}', [UsuarioDeleteController::class, 'deletarUsuario'])->name('delete.usuario');
Route::get('viewUsuario','UsuarioViewController@Index')->name('viewUsuario'); //Define rota de listar usuarios
Route::get('/editarUsuario/{id_usuario}', [UsuarioEditController::class, 'edit']); //Define rota de editar usuario
Route::put('/updateUsuario/{id_usuario}', [UsuarioEditController::class, 'update']);

Route::post('/deletarEquipamento/{id_equipamento}', [EquipamentoDeleteController::class, 'deletarEquipamento'])->name('delete.equipamento');
Route::get('/viewEquipamento','EquipamentoViewController@Index')->name('viewEquipamento'); //Define rota de listar equipamentos
Route::get('/editarEquipamento/{id_equipamento}', [EquipamentoEditController::class, 'edit']); //Define rota de editar equipamento
Route::put('/updateEquipamento/{id_equipamento}', [EquipamentoEditController::class, 'update']);

Route::post('/deletarMarca/{id_marca}', [MarcaDeleteController::class, 'deletarMarca'])->name('delete.marca');
Route::get('/viewMarca','MarcaViewController@Index')->name('viewMarca');
Route::get('/editarMarca/{id_marca}', [MarcaEditController::class, 'edit']);
Route::put('/updateMarca/{id_marca}', [MarcaEditController::class, 'update']);

Route::post('/deletarCategoria/{id_categoria}', [CategoriaDeleteController::class, 'deletarCategoria'])->name('delete.categoria');
Route::get('/viewCategoria','CategoriaViewController@Index')->name('viewCategoria');
Route::get('/editarCategoria/{id_categoria}', [CategoriaEditController::class, 'edit']);
Route::put('/updateCategoria/{id_categoria}', [CategoriaEditController::class, 'update']);

Route::post('/deletarSetor/{id_setor}', [SetorDeleteController::class, 'deletarSetor'])->name('delete.setor');
Route::get('/viewSetor','SetorViewController@Index')->name('viewSetor');
Route::get('/editarSetor/{id_setor}', [SetorEditController::class, 'edit']);
Route::put('/updateSetor/{id_setor}', [SetorEditController::class, 'update']);

Route::post('/deletarSala/{id_sala}', [SalaDeleteController::class, 'deletarSala'])->name('delete.sala');
Route::get('/viewSala','SalaViewController@Index')->name('viewSala');
Route::get('/editarSala/{id_sala}', [SalaEditController::class, 'edit']);
Route::put('/updateSala/{id_sala}', [SalaEditController::class, 'update']);

Route::post('/deletarEstabelecimento/{id_estabelecimento}', [EstabelecimentoDeleteController::class, 'deletarEstabelecimento'])->name('delete.estabelecimento');
Route::get('/viewEstabelecimento','EstabelecimentoViewController@Index')->name('viewEstabelecimento');
Route::get('/editarEstabelecimento/{id_estabelecimento}', [EstabelecimentoEditController::class, 'edit']);
Route::put('/updateEstabelecimento/{id_estabelecimento}', [EstabelecimentoEditController::class, 'update']);

Route::get('/', function () {
    return view('pagina_inicial');
});