<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\ProdutoController;

use Illuminate\Support\Facades\Route;

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

// Rotas públicas (sem autenticação)
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login_submit', [AuthController::class, 'login_submit'])->name('login_submit');


// Grupo de rotas protegidas pelo middleware que valida o JWT na sessão
Route::middleware(['web.jwt.auth'])->group(function () {

    Route::get('/', [AuthController::class, 'index'])->name('index');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // inicio
    Route::get('/inicio', [ProdutoController::class, 'inicio'])->name('inicio');

    // produtos - inserir
    Route::get('/cadastra_produto', [ProdutoController::class, 'cadastra_produto'])->name('cadastra_produto');
    Route::post('/cadastra_produto_submit', [ProdutoController::class, 'cadastra_produto_submit'])->name('cadastra_produto_submit');

    // produtos - editar
    Route::get('/editar_produto/{id}', [ProdutoController::class, 'editar_produto'])->name('editar_produto');
    Route::post('/editar_produto_submit', [ProdutoController::class, 'editar_produto_submit'])->name('editar_produto_submit');

    // produtos - excluir
    Route::get('/delete_produto/{id}', [ProdutoController::class, 'delete_produto'])->name('delete_produto');
    Route::post('/delete_produto_submit', [ProdutoController::class, 'delete_produto_submit'])->name('delete_produto_submit');

});