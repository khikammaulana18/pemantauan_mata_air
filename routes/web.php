<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\LaporanController;
use App\Http\Controllers\Back\MataAirController;
use App\Http\Controllers\Back\PelaporanController;
use App\Http\Controllers\Back\PemantauanController;
use App\Http\Controllers\Back\PetaController;
use App\Http\Controllers\Back\UsersController;
use App\Http\Controllers\Front\PageController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;


// Front
Route::get('/',[PageController::class,'index'])->name('home');

Route::get('/map',[PageController::class,'peta'])->name('map');
Route::get('/map/{id}/show',[PageController::class,'detailMap'])->name('map.show');

Route::middleware(['auth'])->group(function(){
    Route::get('/lapor',[PageController::class,'lapor'])->name('lapor');
    Route::post('/lapor/save',[PageController::class,'saveLapor'])->name('lapor.save');
});

// Register
Route::get('/signup',[RegisterController::class,'index'])->name('register');
Route::post('/signup/store',[RegisterController::class,'store'])->name('register.store');

// Auth
Route::get('/signin',[AuthController::class,'index'])->name('login');
Route::post('/signin/auth',[AuthController::class,'auth'])->name('auth');
Route::get('/signout',[AuthController::class,'signout'])->name('logout');

//Backend

Route::middleware(['auth'])->group(function(){
    //Dashboard
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    
    //Profile
    Route::get('/profile',[DashboardController::class,'profile'])->name('profile');
    Route::post('/profile/save',[DashboardController::class,'saveProfile'])->name('profile.save');
    
    //Mata Air
    Route::prefix('/mata_air')->group(function(){
        Route::get('/',[MataAirController::class,'index'])->name('mata_air');
       
        Route::get('/{id}/show',[MataAirController::class,'show'])->name('mata_air.show');
        Route::get('/create',[MataAirController::class,'create'])->name('mata_air.create');
        Route::get('/{id}/edit',[MataAirController::class,'edit'])->name('mata_air.edit');
        Route::post('/store',[MataAirController::class,'store'])->name('mata_air.store');
        Route::put('/{id}/update',[MataAirController::class,'update'])->name('mata_air.update');
        Route::delete('/{id}/destroy',[MataAirController::class,'destroy'])->name('mata_air.destroy');

        Route::post('/image/save',[MataAirController::class,'saveImage'])->name('mata_air.save_image');
        Route::delete('/image/{id}/delete',[MataAirController::class,'deleteImage'])->name('mata_air.delete_image');
    });

    //Peta
    Route::prefix('/peta')->group(function(){
       Route::get('/',[PetaController::class,'index'])->name('peta');
    });

    //Pemantauan
    Route::prefix('/pemantauan')->group(function(){
        Route::get('/',[PemantauanController::class,'index'])->name('pemantauan');
        Route::get('/create',[PemantauanController::class,'create'])->name('pemantauan.create');
        Route::get('/{id}/edit',[PemantauanController::class,'edit'])->name('pemantauan.edit');
        Route::post('/store',[PemantauanController::class,'store'])->name('pemantauan.store');
        Route::put('/{id}/update',[PemantauanController::class,'update'])->name('pemantauan.update');
        Route::delete('/{id}/destroy',[PemantauanController::class,'destroy'])->name('pemantauan.destroy');
        
        Route::post('/image/save',[PemantauanController::class,'saveImage'])->name('pemantauan.save_image');
        Route::delete('/image/{id}/delete',[PemantauanController::class,'deleteImage'])->name('pemantauan.delete_image');
    });

    //Pelaporan
    Route::prefix('/pelaporan')->group(function(){
        Route::get('/',[PelaporanController::class,'index'])->name('pelaporan');
        Route::get('/create',[PelaporanController::class,'create'])->name('pelaporan.create');
        Route::get('/{id}/edit',[PelaporanController::class,'edit'])->name('pelaporan.edit');
        Route::get('/{id}/show',[PelaporanController::class,'show'])->name('pelaporan.show');
        Route::post('/store',[PelaporanController::class,'store'])->name('pelaporan.store');
        Route::put('/{id}/update',[PelaporanController::class,'update'])->name('pelaporan.update');
        Route::delete('/{id}/destroy',[PelaporanController::class,'destroy'])->name('pelaporan.destroy');

        Route::post('/image/save',[PelaporanController::class,'saveImage'])->name('pelaporan.save_image');
        Route::delete('/image/{id}/delete',[PelaporanController::class,'deleteImage'])->name('pelaporan.delete_image');
    });

    //Pengguna
    Route::prefix('/pengguna')->group(function(){
        Route::get('/',[UsersController::class,'index'])->name('pengguna');
        Route::get('/create',[UsersController::class,'create'])->name('pengguna.create');
        Route::get('/{id}/edit',[UsersController::class,'edit'])->name('pengguna.edit');
        Route::post('/store',[UsersController::class,'store'])->name('pengguna.store');
        Route::put('/{id}/update',[UsersController::class,'update'])->name('pengguna.update');
        Route::delete('/{id}/destroy',[UsersController::class,'destroy'])->name('pengguna.destroy');
    });

    
    Route::prefix('/laporan')->group(function(){
        Route::get('/',[LaporanController::class,'index'])->name('laporan');

        Route::get('/mata_air',[LaporanController::class,'MataAir'])->name('laporan.mata_air');
        Route::get('/mata_air/{id}/detail',[LaporanController::class,'detail_mata_air'])->name('laporan.mata_air.detail');

        Route::get('/pemantauan',[LaporanController::class,'Pemantauan'])->name('laporan.pemantauan');
        Route::get('/pelaporan',[LaporanController::class,'Pelaporan'])->name('laporan.pelaporan');
     });


});