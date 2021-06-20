<?php

namespace App\Http\Controllers;

use App\Models\Fabricante;
use App\Models\Vacina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class VacinaController extends Controller
{
    private string $view = 'Vacina';

    public function __construct(private Vacina $model) {}

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(string $success = null)
    {
        try {
            $dados = $this->model->SelectVacina()
                ->with('fabricante')
                ->get();
        } catch (\Exception $e) {
            $this->LogError($e);
            $dados = [];
        }

        return Inertia::render($this->view, ['dados' => $dados, 'success' => $success]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
        try {
            return $this->model->SelectVacina()
                ->with('fabricante')
                ->get();
        } catch (\Exception $e) {
            $this->LogError($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->qtd_atual) {
            $request['qtd_atual'] = $request->qtd_recebida;
        }

        $request->validate([
            'nome' => [
                'required','string',
                Rule::unique('vacinas')->where('nome', $request->nome)
                ->where('cod_fabricante', $request->cod_fabricante)
            ],
            'cod_fabricante' => 'required|integer|exists:fabricantes,id',
            'lote' => 'required|string',
            'data_validade' => 'required|date|after:now',
            'qtd_recebida' => "required|integer",
            'qtd_atual' => "required|integer",
            'intervalo_min' => 'required|integer|min:1'
        ]);
        
        $fabricante = Fabricante::find($request->cod_fabricante);
        $tot_vacinas = $fabricante->qtd_dose_disponivel;
        $request->validate([
            'qtd_recebida' => "between:1,$tot_vacinas"
        ]);

        try {
            $this->model->create(
                $request->only('nome','cod_fabricante','lote','data_validade',
                    'qtd_recebida','qtd_atual','intervalo_min')
            );

            return $this->index(__('return.store'));
        } catch (\Exception $e) {
            $this->LogError($e);
        }

        return Redirect::route('vacina.index');
    }
}
