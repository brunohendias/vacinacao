<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vacina extends Model
{
    use SoftDeletes;

    /**
     * The "booted" method of the model.
     * @param  \App\Models\Vacina  $vacina
     * @return void
     */
    protected static function booted()
    {
        static::created(function ($model) {
            $fabricante = $model->fabricante;

            if ($fabricante->qtd_dose_disponivel <= 0)
                return false;

            $fabricante->qtd_dose_disponivel -= $model->qtd_recebida;
            $fabricante->save();
        });
    }

    protected $fillable = [
        'nome','cod_fabricante', 'lote', 'data_validade', 
        'qtd_recebida','qtd_atual', 'intervalo_min'
    ];

    protected $attributes = [
        'intervalo_min' => 15,
    ];

    public function fabricante() {
        return $this->hasOne(Fabricante::class, 'id', 'cod_fabricante');
    }

    public function historicos () {
        return $this->HasMany(Historico::class, 'cod_vacina', 'id');
    }

    public function scopeSelectVacina($builder) {
        return $builder->select('id','nome','cod_fabricante','lote',
            'data_validade','qtd_recebida','qtd_atual','intervalo_min');
    }
}