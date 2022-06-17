<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AduanModel;
use App\Models\KantorModel;

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
        $countkebakaran = AduanModel::where('jenis_aduan', '=', 'redIcon')->count();
        $countpenyelematan = AduanModel::where('jenis_aduan', '=', 'greenIcon')->count();
        $countpos = KantorModel::count();

        return view('home',compact('countkebakaran','countpenyelematan','countpos'));
        //return view('home')->with('countkebakaran','countpenyelematan', $countkebakaran, $countpenyelematan);
    }
    public function peristiwa()
    {
        $countkebakaran = AduanModel::where('jenis_aduan', '=', 'redIcon')->count();
        $countpenyelematan = AduanModel::where('jenis_aduan', '=', 'greenIcon')->count();
        $countpos = KantorModel::count();

        return view('peristiwa',compact('countkebakaran','countpenyelematan','countpos'));
        //return view('home')->with('countkebakaran','countpenyelematan', $countkebakaran, $countpenyelematan);
    }
    public function adminHome()
    {
        return view('adminHome');
    }
    public function tolak()
    {
        return view('tolak');
    }
    public function daftar()
    {
        return view('daftar');
    }
    public function kelogin()
    {
        return view('auth.login');
    }
}
