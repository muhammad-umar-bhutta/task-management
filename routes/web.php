<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShowUsersController;
use App\Http\Controllers\StockController;
use App\Models\Stock;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $stocks = Stock::paginate(12);
    return view('dashboard', compact('stocks'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/show-users', [ShowUsersController::class, 'show'])->name('show.users');
    Route::post('/import', [StockController::class, 'import'])->name('stock.import');
    Route::get('/export', [StockController::class, 'export'])->name('stock.export');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
