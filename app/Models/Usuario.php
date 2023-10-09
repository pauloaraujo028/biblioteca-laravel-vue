<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nome',
        'cpf',
    ];

    protected $primaryKey = 'usuario_id';

    public function alugueis()
    {
        return $this->hasMany(Aluguel::class, 'usuario_id');
    }
}
