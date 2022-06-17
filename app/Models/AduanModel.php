<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AduanModel extends Model
{
    protected $table = 't_aduan';
    public function allData(){
        $results= DB::table('t_aduan')
        ->select('latitude','longitude','alamat','jenis_aduan')
        ->get();
        return $results;
    }
}
