<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PeristiwaModel extends Model
{
    //protected $guarded=[];
    protected $fillable=[
        'id',
        'tgl_aduan',
        'latitude',
        'longitude',
        'alamat',
        'nik',
        'nama',
        'jenis_aduan',
        'nohp',
        'image',
        'path',
        'keterangan',
        'status',
        'created_at',
        'updated_at'
    ];
    protected $table = 't_aduan';
    use HasFactory;

    public function allData(){
        $results= DB::table('t_aduan')
        ->select('*')
        ->get();
        return $results;
    }
    
}
