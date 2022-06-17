<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AkunModel extends Model
{
    protected $guarded=[];
    protected $fillable=['id','nik','name','alamat','nohp','email','password','is_admin','created_at','updated_at'];
    protected $table = 'users';
    use HasFactory;

    public function allData(){
        $results= DB::table('users')
        ->select('*')
        ->orderBy('is_admin','DESC')
        ->get();
        return $results;
    }
}
