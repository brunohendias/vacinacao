<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{   
    /**
     * The "booted" method of the model.
     * @param  \App\Models\Vacina  $vacina
     * @return void
     */
    protected static function booted()
    {
        static::created(function ($model) {
            $vacina = $model->vacina;
            
            if (is_null($vacina))
                return false;

            $vacina->qtd_atual -= 1;
            $vacina->save();
        });
    }

    protected $fillable = [
        'data_vacinacao', 'cod_paciente', 'cod_vacina', 
        'dose_atual', 'id_dose', 'data_prox_vaci'
    ];

    protected $attributes = [
        'dose_atual' => 1
    ];

    public function paciente() {
        return $this->hasOne(Paciente::class, 'id', 'cod_paciente');
    }

    public function vacina() {
        return $this->hasOne(Vacina::class, 'id', 'cod_vacina');
    }

    public function scopeSelectHistorico($builder) {
        return $builder->select('id', 'data_vacinacao', 'data_prox_vaci', 
            'cod_vacina', 'dose_atual', 'cod_paciente', 'id_dose');
    }
}