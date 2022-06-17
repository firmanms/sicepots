<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;
use App\Models\AkunModel;
use App\Models\User;
use Hash;

class AkunController extends Controller
{
    public function __construct()
    {
        $this->AkunModel= new AkunModel();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $akuns= AkunModel::orderby("is_admin","desc")->paginate(10);
        return view('akun.index',['akuns'=>$akuns]);
    }

    public function cari(Request $request){
        $q = $request->q;
        $akuns = AkunModel::where('name','like',"%".$q."%")
                           ->orWhere('alamat','like',"%".$q."%")->paginate(10);
        return view('akun.index',compact('akuns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('akun.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, AkunModel $akun)
    {
        $request->validate([
            'nik' => [
                'required',
                Rule::unique('users')->ignore($akun->id),
            ],
            'name' => 'required',
            'alamat' => 'required',
            'nohp' => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore($akun->id),
            ],
            'password' => 'required',
            'is_admin' => 'required',
        ]);

        $user = new User();
        $user->nik = $request->nik;
        $user->name = $request->name;
        $user->alamat = $request->alamat;
        $user->nohp = $request->nohp;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->is_admin = $request->is_admin;
        $user->save();
        session()->flash('success','Data telah ditambahkan');
        return redirect()->to('/home');
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
    public function edit(AkunModel $akun)
    {
        return view ('akun.edit', compact('akun'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AkunModel $akun)
    {
        $request->validate([
            'nik' => [
                'required',
                Rule::unique('users')->ignore($akun->id),
            ],
            'name'=>'required',
            // 'password'=>'rquired',
            'alamat' => 'required',
            'nohp' => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore($akun->id),
            ],
            // 'email' => 'required|unique:users',
            'is_admin' => 'required',
            
        ]);
        $akun->nik = $request->nik;
        $akun->name = $request->name;
        $akun->alamat = $request->alamat;
        $akun->nohp = $request->nohp;
        $akun->email = $request->email;
        if ($request->password)
            $akun->password = Hash::make($request->password);
        $akun->is_admin = $request->is_admin;
        $akun->save();
        session()->flash('update','Data telah diubah');
        return redirect()->to('akun');
        //dd($master);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AkunModel $akun)
    {
        $akun->delete();
        session()->flash('delete','Data telah dihapus');
        return redirect()->to('akun');
    }
    public function titik(){
        $result=$this->AkunModel->allData();
        return json_encode($result);
    }
}
