<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fabricante extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nome', 'cnpj', 'qtd_dose_disponivel'
    ];

    public function vacinas () {
        return $this->HasMany(Vacina::class, 'cod_fabricante', 'id');
    }

    public function scopeSelectFabricante($builder) {
        return $builder->select('id', 'nome', 'cnpj', 'qtd_dose_disponivel');
    }

    public function scopeJoinHistoricos($builder) {
        return $builder->join('vacinas vac', 'vac.cod_fabricante', '=', 'fabricante.id')
            ->join('historicos hist', 'hist.cod_vacina', '=', 'vac.id');
    }
}