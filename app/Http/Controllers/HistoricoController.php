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
    public function __construct(private Historico $model) {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): object
    {
        $dados = $this->model->SelectHistorico()
            ->with('paciente')->with('vacina')->get();

        return Inertia::render('Historico', ['dados' => $dados]);
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
            'cod_paciente' => ['required','integer','exists:pacientes,id',Rule::unique('historicos')
                ->where('cod_paciente', $request->cod_paciente)->where('cod_vacina', $request->cod_vacina)],
            'cod_vacina' => 'required|integer|exists:vacinas,id',
            'id_dose' => 'required|string',
            'dose_atual' => 'integer',
        ]);

        $vacina = Vacina::find($request->cod_vacina);
        $intervalo_min = $vacina->intervalo_min;
        $request['data_prox_vaci'] = date("Y-m-d", strtotime("$request->data_vacinacao + $intervalo_min days"));

        $this->model->create(
            $request->only('data_vacinacao', 'data_prox_vaci',
                'cod_paciente', 'cod_vacina', 'dose_atual', 'id_dose')
        );

        return Redirect::route('historico.index');
    }

    /**
     * Update a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $historico = $this->model->find($id);
        if (!is_null($historico)) {
            if (date("Y-m-d") == $request->data_prox_vaci) {
                $vacina = Vacina::find($historico->cod_vacina);
                $intervalo_min = $vacina->intervalo_min;
                $dados['data_vacinacao'] = date("Y-m-d");
                $dados['data_prox_vaci'] = date("Y-m-d", strtotime(date("Y-m-d")." + $intervalo_min days"));
                $dados['dose_atual'] = $historico->dose_atual += 1;
                $historico->update($dados);
            }
        }

        return Redirect::route('historico.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Historico  $historico
     * @return \Illuminate\Http\Response
     */
    public function show(Historico $historico): object
    {
        return $this->RespSuccess(array(
            'msg' => __('return.find'),
            'dados' => $historico
        ));
    }
}
