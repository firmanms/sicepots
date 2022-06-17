<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\AduanModel;

class AduanController extends Controller
{
    public function __construct()
    {
        $this->AduanModel= new AduanModel();
    }
    public function index()
    {
        $countkebakaran = AduanModel::where('redIcon', '=', null)->count();

      return view('home')->with('countkebakaran', $countkebakaran);
        //return view('home');
    }
    public function adminHome()
    {
        return view('adminHome');
    }
    public function titik(){
        $result=$this->AduanModel->allData();
        return json_encode($result);
    }
}
