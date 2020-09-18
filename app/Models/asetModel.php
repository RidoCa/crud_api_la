<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class asetModel extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_aset';
    //deklarasikan nama tabel di db
    protected $table = 'aset';
    //deklarasi field yang bisa diisi pada table
    protected $fillable = [
        'id_user',
        'kode_aset',
        'nama_aset',
        'jumlah',
        'merk',
        'desc'];
    
}
