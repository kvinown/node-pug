<?php

use App\Http\Controllers\FamilyCardController;
use App\Http\Controllers\CitizenController;
use Illuminate\Support\Facades\Route;

// home
Route::get('/', function () {
    return view('home');
});


// family card
Route::get('/fam-card', [FamilyCardController::class, 'index'])->name('fam-card');
Route::get('/fam-card/create', [FamilyCardController::class, 'create'])->name('fam-card.create');
Route::post('/fam-card/store', [FamilyCardController::class, 'store'])->name('fam-card.store');
Route::get('/fam-card/edit/{id}', [FamilyCardController::class, 'edit'])->name('fam-card.edit');
Route::post('/fam-card/update', [FamilyCardController::class, 'update'])->name('fam-card.update');
Route::delete('/fam-card/delete/{id}', [FamilyCardController::class, 'destroy'])->name('fam-card.destroy');

// Citizen
Route::get('/citizen', [CitizenController::class, 'index'])->name('citizen');
Route::get('/citizen/create', [CitizenController::class, 'create'])->name('citizen.create');
Route::post('/citizen/store', [CitizenController::class, 'store'])->name('citizen.store');
Route::get('/citizen/edit/{nik}', [CitizenController::class, 'edit'])->name('citizen.edit');
Route::post('/citizen/update', [CitizenController::class, 'update'])->name('citizen.update');
Route::get('/citizen/delete/{nik}', [CitizenController::class, 'destroy'])->name('citizen.delete');
