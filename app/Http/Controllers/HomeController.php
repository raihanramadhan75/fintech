<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transaksi;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pengajuans = Transaksi::where('type', 1)->where('status', 2)->get();

        return view('home', [
            'pengajuans' => $pengajuans
        ]);
    }
}
