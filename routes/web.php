<?php
use Illuminate\Support\Facades\Auth;
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

Route::view('/', 'welcome');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

// Route::view('profile', 'profile')
//     ->middleware(['auth'])
//     ->name('profile');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
Route::middleware([

    ])->group(function () {
         Route::get('/dashboard', function () {
           if (auth()->user()->role == 1) {
            return redirect()->route('sp-admindashboard');
           }
           elseif (auth()->user()->role ==2){
            return redirect()->route('Admindashboard');
           }
           else{
            return redirect()->route('user-dashboard');
           }
         })->name('userdashboard');

    });

    Route::prefix('admin')->middleware('admin')->group(function(){
        Route::get('/Admindashboard', function(){
            return view('admin.index');
        })->name('Admindashboard');

        Route::get('/Complaints', function(){
            return view('admin.complaints');
        })->name('comp');

     });

     Route::prefix('user')->middleware('user')->group(function(){
        Route::get('/dashboard', function(){
               return view('user.index');
           })->name('user-dashboard');

           Route::get('/Form', function(){
            return view('user.complain-form');
        })->name('complaints');

        });

        Route::prefix('supeadmin')->middleware('supeadmin')->group(function(){
            Route::get('/dashboard', function(){
                   return view('spadmin.index');
               })->name('sp-admindashboard');
            Route::get('/barangay', function(){
                   return view('spadmin.barangay');
               })->name('sp-adminbarangay');
            Route::get('/users', function(){
                   return view('spadmin.users');
               })->name('sp-users');
            });


require __DIR__.'/auth.php';
