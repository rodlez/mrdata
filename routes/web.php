<?php

use Illuminate\Support\Facades\Route;
// Controllers
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;

Route::get('/', function () {
    return view('welcome');
});


// Notes
Route::middleware(['auth', 'verified'])->group(function () {
    /*
    Route::get('/note', [NoteController::class, 'index'])->name('note.index');   
    Route::get('/note/create', [NoteController::class, 'create'])->name('note.create');
    Route::post('/note', [NoteController::class, 'store'])->name('note.store');
    Route::get('/note/{id}', [NoteController::class, 'show'])->name('note.show');
    Route::get('/note/{id}/edit', [NoteController::class, 'edit'])->name('note.edit');
    Route::put('/note/{id}', [NoteController::class, 'update'])->name('note.update');
    Route::delete('/note/{id}', [NoteController::class, 'destroy'])->name('note.destroy');
    */
    // Using this line generate the same as the 7 lines above
    Route::resource('note', NoteController::class);
});

Route::get('/note/{id}/image', [ImageController::class, 'index'])->name('image.index')->middleware(['auth', 'verified']);
Route::post('/note/{id}/image', [ImageController::class, 'store'])->name('image.store')->middleware(['auth', 'verified']);
Route::delete('/note/{id}/image/{imageId}', [ImageController::class, 'destroy'])->name('image.destroy')->middleware(['auth', 'verified']);
Route::get('/note/{id}/image/{imageId}/{imageDown}', [ImageController::class, 'download'])->name('image.download')->middleware(['auth', 'verified']);

// CATEGORIES
Route::middleware(['auth', 'verified'])->group(function () {
    /*
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');   
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');
    Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    */
    // Using this line generate the same as the 7 lines above
    Route::resource('category', CategoryController::class);
});

// TAGS
Route::middleware(['auth', 'verified'])->group(function () {
    /*
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');   
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');
    Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    */
    // Using this line generate the same as the 7 lines above
    Route::resource('tag', TagController::class);
});

// Middleware auth and verified email, if one of them fails we can NOT access to the dashboard 
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// To access the profile page the user must be authenticated
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
