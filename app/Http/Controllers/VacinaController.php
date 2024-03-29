<?php

namespace App\Http\Controllers;

use App\Models\Fabricante;
use App\Models\Vacina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class VacinaController extends Controller
{
    public function __construct(private Vacina $model) {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() : object
    {
        $dados = $this->model->SelectVacina()->with('fabricante')->get();

        return Inertia::render('Vacina', ['dados' => $dados]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get() : object
    {
        return $this->model->SelectVacina()->with('fabricante')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tot_vacinas = 0;
        if ($request->cod_fabricante) {
            $fabricante = Fabricante::find($request->cod_fabricante);
            if (!is_null($fabricante)) {
                $tot_vacinas = $fabricante->qtd_dose_disponivel;
            }
        }

        $request->validate([
            'nome' => 'required|string',
            'cod_fabricante' => 'required|integer|exists:fabricantes,id',
            'lote' => 'required|string',
            'data_validade' => 'required|date|after:now',
            'qtd_recebida' => "required|integer|between:1,$tot_vacinas",
            'qtd_atual' => 'required|integer',
            'intervalo_min' => 'required|integer'
        ]);

        $this->model->create(
            $request->only('nome','cod_fabricante','lote','data_validade',
                'qtd_recebida','qtd_atual','intervalo_min')
        );

        return Redirect::route('vacina.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vacina  $vacina
     * @return \Illuminate\Http\Response
     */
    public function show(Vacina $vacina)
    {
        return $this->RespSuccess(array(
            'msg' => __('return.find'),
            'dados' => $vacina
        ));
    }
}
