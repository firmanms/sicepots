<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Database\Eloquent\Builder;
use App\Models\AduanModel;
use App\Models\PeristiwaModel;

class PeristiwaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countkebakaran = AduanModel::where('jenis_aduan', '=', 'redIcon')->count();
        $countpenyelematan = AduanModel::where('jenis_aduan', '=', 'greenIcon')->count();
        $peristiwas= AduanModel::orderby("updated_at","desc")->paginate(10);

        return view('peristiwa.index',compact('countkebakaran','countpenyelematan'),['peristiwas'=>$peristiwas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('peristiwa.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tgl_aduan'=>'required',
            'lat'=>'',
            'lng'=>'',
            'alamat'=>'required',
            'nik'=>'required',
            'nama'=>'required',
            'nohp'=>'required',
            'keterangan'=>'required',            
        ]);
        PeristiwaModel::create($request->all());
        session()->flash('success','Data telah ditambahkan');
        return redirect()->to('/kantor');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
