<?php

use App\Http\Controllers\AJAX\FilterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailsController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogOutController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PDF\PDFDanfeController;
use App\Http\Controllers\Teste\TesteController;
use App\Http\Controllers\Theme\ThemeController;
use App\Http\Middleware\LoginAcc;
use App\Http\Middleware\Theme;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'showLogin'])
    ->name('login');
Route::post('/', [LoginController::class, 'Login'])
    ->name('login');

Route::fallback(function () {
        return response()->view('errors.fallback', [
            'code' => 404,
            'message' => 'Página não encontrada!',
        ], 404);
    });

Route::middleware([LoginAcc::class, Theme::class])->group(function () { // needed authentication
    // Route::get('/Dashboard', [DashboardController::class, 'Dashboard'])
    //     ->name('dashboard');

    // Pedidos
    Route::get('/Orders', [OrdersController::class, 'orders'])
        ->name('orders');
    Route::post('/Orders', [OrdersController::class, 'filter'])
        ->name('orders');

    // Detalhes
    Route::get('/Detalhes/{idpedido}', [DetailsController::class, 'details'])
        ->name('details');

    // Etiqueta
    Route::get('/Etiqueta/{idpedido}', [LabelController::class, 'label'])
        ->name('label');
    // DANFE
    Route::get('/Nota-Fiscal/{idpedido}', [PDFDanfeController::class, 'danfe'])
        ->name('danfe');

    // finalizar sessão
    Route::get('/logout', [LogOutController::class, 'logout'])
        ->name('logout');

    // Testes
    Route::get('/Teste', [TesteController::class, 'teste'])
        ->name('teste');
    Route::post('/Teste', [TesteController::class, 'teste'])
        ->name('teste');

    // Api ajax
    Route::post('/theme', [ThemeController::class, 'theme'])
        ->name('theme');
    Route::post('/filter', [FilterController::class, 'filter'])
        ->name('filter');
});


