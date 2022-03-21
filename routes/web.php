<?php

use App\Models\Barang;
use App\Models\Saldo;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;



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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('topup', function(){
    $saldo = Saldo::where('user_id', Auth::user()->id)->first();

    return view ('topup', [
        'saldo' => $saldo
    ]);

})->name('topup');

Route::get("topup/setuju/{transaksi_id}", function($transaksi_id){
    $transaksi = Transaksi::find($transaksi_id);

    $saldo = Saldo::where("user_id", $transaksi->user_id)->first();

    Saldo::where("user_id", $transaksi->user_id)->update([
        "saldo" => $saldo->saldo + $transaksi->jumlah
    ]);

    $transaksi->update([
        "status" => 3
    ]);

    return redirect()->back()->with("status", "Topup disetujui");
})->name("topup.disetujui");

Route::get('topup/tolak/{transaksi_id}', function($transaksi_id){
    $transaksi = Transaksi::find($transaksi_id);

    $transaksi->delete();

    return redirect()->back()->with('status,topup di tolak');

})->name('topup.ditolak');

Route::prefix('transaksi')->group(function () {
    Route::get('/', function () {
    });

    Route::get('/add', function () {
        // Matches The "/admin/users" URL
    });

    Route::post('/create', function (Request $request) {
        if($request->type == 1){
            $invoice_id = "SAL_" . Auth::user()->id . now()->timestamp;

            Transaksi::create([
                "user_id" => Auth::user()->id,
                "jumlah" => $request->jumlah,
                "invoice_id" => $invoice_id,
                "type" => $request->type,
                "status" => 2
            ]);

            return redirect()->back()->with("status", "Top Up Saldo Sedang Diproses");
        }

    })->name('transaksi.create');

    Route::get('/edit/{id}', function () {
        // Matches The "/admin/users" URL
    });

    Route::put('/update/{id}', function () {
        // Matches The "/admin/users" URL
    });

    Route::get('/delete/{id}', function () {
        // Matches The "/admin/users" URL
    });

});


