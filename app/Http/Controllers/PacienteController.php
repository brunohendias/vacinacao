<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PacienteController extends Controller
{
    public function __construct(private Paciente $model) {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() : object
    {
        $dados = $this->model->SelectPaciente()->get();

        return Inertia::render('Paciente', ['dados' => $dados]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get() : object
    {
        return $this->model->SelectPaciente()->get();
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
            'nome' => 'required|string',
            'cpf' => 'required|string|unique:pacientes,cpf|min:11|max:11',
            'rg' => 'required|string|unique:pacientes,rg|min:9|max:9',
            'telefone' => 'required|string'
        ]);

        $this->model->create(
            $request->only('nome', 'cpf', 'rg', 'telefone')
        );

        return Redirect::route('paciente.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function show(Paciente $paciente)
    {
        return $this->RespSuccess(array(
            'msg' => __('return.find'),
            'dados' => $paciente
        ));
    }
}
