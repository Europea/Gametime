<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ParentChildController;
use App\Http\Controllers\UserRelationController;
use App\Http\Controllers\ScreenTimePointsController;


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::get('/parent/addChild', [ParentChildController::class, 'showAddChildForm'])->name('parent.showAddChildForm');
    Route::post('/parent/addChild', [ParentChildController::class, 'addChild'])->name('parent.addChild');
    Route::get('/medegebruiker-toevoegen', [UserRelationController::class, 'index'])->name('medegebruiker.index');
    Route::post('/medegebruiker-toevoegen', [UserRelationController::class, 'store'])->name('medegebruiker.store');
});

Route::middleware('auth')->group(function () {
    Route::get('screen-time-points', [ScreenTimePointsController::class, 'index'])->name('screen-time-points.index');
    Route::post('screen-time-points', [ScreenTimePointsController::class, 'store'])->name('screen-time-points.store');
    Route::post('screen-time-points', [ScreenTimePointsController::class, 'verzilveren'])->name('screen-time-points.verzilveren');
    Route::delete('screen-time-points/{id}', [ScreenTimePointsController::class, 'destroy'])->name('screen-time-points.destroy');
});


require __DIR__.'/auth.php';
