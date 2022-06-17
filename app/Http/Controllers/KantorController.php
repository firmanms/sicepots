<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Database\Eloquent\Builder;
use App\Models\KantorModel;

class KantorController extends Controller
{
    public function __construct()
    {
        $this->KantorModel= new KantorModel();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countpos = KantorModel::count();
        $kantors= KantorModel::orderby("updated_at","desc")->paginate(10);

        return view('kantor.index',compact('countpos'),['kantors'=>$kantors]);
        // $kantors= KantorModel::orderby("updated_at","desc")->paginate(10);
        // return view('kantor.index',['kantors'=>$kantors]);
    }

    public function cari(Request $request){
        $q = $request->q;
        $countpos = KantorModel::count();
        $kantors = KantorModel::where('nama','like',"%".$q."%")
                           ->orWhere('alamat','like',"%".$q."%")->paginate(10);
        return view('kantor.index',compact('kantors','countpos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kantor.form');
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
            'lat'=>'',
            'lng'=>'',
            'alamat'=>'',
            
        ]);
        KantorModel::create($request->all());
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
    public function edit(KantorModel $kantor)
    {
        return view ('kantor.edit', compact('kantor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KantorModel $kantor)
    {
        $attr=request()->validate([
            'latitude'=>'',
            'longitude'=>'',
            'alamat'=>'',
            'nama'=>'',
        ]);
        $kantor->update($attr);
        session()->flash('update','Data telah diubah');
        return redirect()->to('kantor');
        //dd($master);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(KantorModel $kantor)
    {
        $kantor->delete();
        session()->flash('delete','Data telah dihapus');
        return redirect()->to('kantor');
    }
    public function titik(){
        $result=$this->KantorModel->allData();
        return json_encode($result);
    }
}
