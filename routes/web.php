<?php
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/chirps', [ChirpController::class, 'index'])->name('chirps.index');

Route::post('/chirps', [ChirpController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('chirps.store');

Route::middleware(['auth', 'verified'])->group(function () {
Route::resource('chirps', ChirpController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy']);
    Route::post(
        '/chirps/{chirp}/addToFavourites',
        [ChirpController::class, 'addToFavourites']
     )->name('chirps.favourites.add');
     Route::get(
        '/chirps/favourites',
        [ChirpController::class, 'favourites']
     )->name('chirps.favourites');
  });
  


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
