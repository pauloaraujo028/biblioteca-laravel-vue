<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nome_livro',
    ];

    protected $primaryKey = 'livro_id';

    public function alugueis()
    {
        return $this->hasMany(Aluguel::class, 'livro_id');
    }
}
