<?php

use App\Http\Controllers\Adm\ApartmentController;
use App\Http\Controllers\Adm\BlockController;
use App\Http\Controllers\Adm\CondominiaController;
use App\Http\Controllers\Adm\ContractCondominiaController;
use App\Http\Controllers\Adm\InvitationController;
use App\Http\Controllers\Adm\ProductsController;
use App\Http\Controllers\Adm\ResponsibleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('/users', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('users');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('/users')->name('users.')->middleware(['auth'])->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::post('/', [UserController::class, 'create'])->name('create');
    Route::delete('/{id}', [UserController::class, 'deleted'])->name('delete');
});

Route::middleware(['auth'])->group(function(){

    Route::controller(BlockController::class)->prefix('/blocks')->as('blocks.')->group(function() {
        Route::post('/', 'created')->name('create');
        Route::post('/floors', 'createFloorsBlocks')->name('floorsBlock');
        Route::delete('/{block}', 'deleted')->name('delete');
    });

    Route::controller(ApartmentController::class)->prefix('/apartments')->as('apartment.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::post('/', 'created')->name('create');
        Route::delete('/{apto}', 'delete')->name('delete');
    });
    // ->middleware('can:viewAny,App\Models\Condominia')
    Route::controller(CondominiaController::class)->prefix('/condominia')->as('condominia.')->group(function (){
        Route::get('/', 'index')->name('index');
        Route::get('/created','storeCondominia')->name('storeCondominia')->middleware('can:create,condominia');
        // ->middleware('can:create,App\Models\Condominia');
        Route::post('/', 'create')->name('create');
        Route::get('/{condominia}','getOne')->name('getOne')->middleware('can:view,condominia');
        Route::get('/view/{condominia}','storeOne')->name('storeOne')->middleware('can:view,condominia');

    });
    Route::controller(InvitationController::class)->prefix('/invites')->as('invites.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::post('/', 'create')->name('create');
        Route::delete('/{invitation}', 'delete')->name('delete');
        Route::put('/resend-email/{invitation}', 'resend')->name('resend');
    });

    Route::controller(ProductsController::class)->prefix('/products')->as('products.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::get('/{product}', 'getOne')->name('oneproduct');
        Route::post('/imageOne/{product}', 'imageOne')->name('imageOne');
        Route::delete('/{product}', 'deleted')->name('delete');
    });

    Route::controller(ResponsibleController::class)->prefix('/responsable')->as('responsable.')->group(function () {
        Route::post('/', 'create')->name('create');
    });
    Route::controller(ContractCondominiaController::class)->prefix('/contract')->as('contract.')->group(function() {
        Route::get('/{condominia}', 'viewCreateContract')->name('viewCreateContract');
        Route::post('/', 'create')->name('create');
    });
});



require __DIR__.'/auth.php';
