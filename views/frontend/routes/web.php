<?php

use App\Http\Controllers\FamilyCardController;
use App\Http\Controllers\CitizenController;
use Illuminate\Support\Facades\Route;


// family card
Route::get('/fam-card', [FamilyCardController::class, 'index'])->name('fam-card');
Route::get('/fam-card/create', [FamilyCardController::class, 'create'])->name('fam-card.create');
Route::post('/fam-card/store', [FamilyCardController::class, 'store'])->name('fam-card.store');
Route::get('/fam-card/edit/{id}', [FamilyCardController::class, 'edit'])->name('fam-card.edit');
Route::put('/fam-card/update/{id}', [FamilyCardController::class, 'update'])->name('fam-card.update');
Route::delete('/fam-card/delete/{id}', [FamilyCardController::class, 'destroy'])->name('fam-card.destroy');

// Citizen
Route::get('/citizen', [CitizenController::class, 'index'])->name('citizen');
