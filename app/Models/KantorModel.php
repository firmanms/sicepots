<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KantorModel extends Model
{
    protected $guarded=[];
    protected $fillable=[
        'id',
        'nama',
        'alamat',
        'image',
        'latitude',
        'longitude',
        'created_at',
        'updated_at'
    ];
    protected $table = 't_kantor';
    use HasFactory;

    public function allData(){
        $results= DB::table('t_kantor')
        ->select('*')
        ->get();
        return $results;
    }
}
