<?php
use App\Http\Controllers\AuthController;
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
//Route::view('dashboard', 'dashboard')
//    ->middleware(['auth', 'verified'])
 //   ->name('dashboard');

//Route::view('profile', 'profile')
  //  ->middleware(['auth'])
   // ->name('profile');

require __DIR__.'/auth.php';


Route::middleware([

    ])->group(function () {
         Route::get('/dashboard', function () {
           if (auth()->user()->is_admin == 1) {
            return redirect()->route('admin-dashboard');
           }
           if (auth()->user()->is_admin == 2) {
            return redirect()->route('agent-dashboard');
           }
           else{
            return redirect()->route('client-dashboard');
           }
         })->name('userdashboard');

    });

    Route::prefix('admin')->middleware('admin')->group(function(){

        Route::get('/admin', function(){
            return view('admin.index');
        })->name('admin-dashboard');

        Route::get('/add-agent', function(){
            return view('admin.add-agent');
        })->name('add-agent');

        Route::get('/add-landowner', function(){
            return view('admin.landowner');
        })->name('add-landowner');

        Route::get('/contract-to-sell', function(){
            return view('admin.contracttosell');
        })->name('contract');

        Route::get('/contract-list', function(){
            return view('admin.contract-list');
        })->name('lists');

        Route::get('/Monthly-amortization', function(){
            return view('admin.monthly-amortization');
        })->name('monthly');

        Route::get('/Propert-application', function(){
            return view('admin.property-application');
        })->name('prop');

        Route::get('/Payment-list', function(){
            return view('admin.payment');
        })->name('paym');
     });

     Route::prefix('client')->middleware('client')->group(function(){

        Route::get('/client', function(){
            return view('client.index');
        })->name('client-dashboard');

        Route::get('/land', function(){
            return view('client.land');
        })->name('land');

        Route::get('/Application-status', function(){
            return view('client.application-status');
        })->name('application');

        Route::get('/Monthly-amortization', function(){
            return view('client.monthly-amortization');
        })->name('amorz');

        Route::get('/Payment', function(){
            return view('client.payment');
        })->name('payment');

        Route::get('/paymentHistory', function(){
            return view('client.payment-history');
        })->name('history-payment');


        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
     });

     Route::prefix('agent')->middleware('agent')->group(function(){

        Route::get('/agent', function(){
            return view('agent.index');
        })->name('agent-dashboard');

        Route::get('/post-land', function(){
            return view('agent.post-land');
        })->name('post-land');

        Route::get('/land_schedule', function(){
            return view('agent.land_schedule');
        })->name('land_schedule');
     });

    //  Route::get('/', function () {
    //     return redirect()->route('login');
    // });

     Route::get('/logout', [AuthController::class, 'logout'])->name('log');

