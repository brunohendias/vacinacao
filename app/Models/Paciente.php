<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paciente extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nome', 'cpf', 'rg', 'telefone'
    ];

    public function historicos () {
        return $this->HasMany(Historico::class, 'cod_paciente', 'id');
    }

    public function scopeSelectPaciente($builder) {
        return $builder->select('id', 'nome', 'cpf', 'rg', 'telefone');
    }
}