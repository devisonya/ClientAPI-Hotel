<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesan extends Model
{
    use HasFactory;
    protected $fillable = [
        'kodepemesan', 'namapemesan', 'jeniskelamin', 'tempatlahir', 'tanggallahir', 'alamat', 'email', 'nohandphone'
    ];
}
