<?php

namespace App\Http\Controllers;

use App\Models\Historico;
use App\Models\Vacina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class HistoricoController extends Controller
{
    private string $view = 'Historico';

    public function __construct(private Historico $model) {}

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(string $success = null)
    {
        try {
            $dados = $this->model->SelectHistorico()
                ->with('paciente')
                ->with('vacina')
                ->get();
        } catch (\Exception $e) {
            $this->LogError($e);
            $dados = [];
        }

        return Inertia::render($this->view, ['dados' => $dados, 'success' => $success]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'data_vacinacao' => 'required|date',
            'cod_paciente' => [
                'required','integer','exists:pacientes,id',
                Rule::unique('historicos')->where('cod_paciente', $request->cod_paciente)
                ->where('cod_vacina', $request->cod_vacina)
            ],
            'cod_vacina' => 'required|integer|exists:vacinas,id',
            'id_dose' => 'required|string',
            'dose_atual' => 'integer',
        ]);

        try {
            $vacina = Vacina::find($request->cod_vacina);
            $intervalo_min = $vacina->intervalo_min;
            $request['data_prox_vaci'] = date("Y-m-d", strtotime("$request->data_vacinacao + $intervalo_min days"));

            $this->model->create(
                $request->only('data_vacinacao', 'data_prox_vaci',
                    'cod_paciente', 'cod_vacina', 'dose_atual', 'id_dose')
            );
            
            return $this->index(__('return.store'));
        } catch (\Exception $e) {
            $this->LogError($e);
        }

        return Redirect::route('historico.index');
    }

    /**
     * Update a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Historico $historico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Historico $historico)
    {
        try {
            if (date("Y-m-d") == $historico->data_prox_vaci) {
                $vacina = Vacina::find($historico->cod_vacina);
                $intervalo_min = $vacina->intervalo_min;
                $dados['data_vacinacao'] = date("Y-m-d");
                $dados['data_prox_vaci'] = date("Y-m-d", strtotime(date("Y-m-d")." + $intervalo_min days"));
                $dados['dose_atual'] = $historico->dose_atual += 1;
                $historico->update($dados);
            }
        } catch (\Exception $e) {
            $this->LogError($e);
        }

        return Redirect::route('historico.index');
    }
}
