<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluguel extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'alugueis';

    protected $fillable = [
        'livro_id',
        'usuario_id',
        'dt_aluguel_ini',
        'dt_aluguel_fim',
    ];

    protected $primaryKey = 'aluguel_id';

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function livro()
    {
        return $this->belongsTo(Livro::class, 'livro_id');
    }
}
