<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PacienteController extends Controller
{
    private string $view = 'Paciente';

    public function __construct(private Paciente $model) {}

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        try {
            $dados = $this->model->SelectPaciente()->get();
        } catch (\Exception $e) {
            $this->LogError($e);
            $dados = [];
        }

        return Inertia::render($this->view, ['dados' => $dados]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
        try {
            return $this->model->SelectPaciente()->get();
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
        $request->validate([
            'nome' => 'required|string',
            'cpf' => 'required|string|unique:pacientes,cpf|min:11|max:11',
            'rg' => 'required|string|unique:pacientes,rg|min:9|max:9',
            'telefone' => 'required|string'
        ]);

        try {
            $this->model->create(
                $request->only('nome', 'cpf', 'rg', 'telefone')
            );
        } catch (\Exception $e) {
            $this->LogError($e);
        }

        return Redirect::route('paciente.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Inertia\Response
     */
    public function show(Paciente $paciente)
    {
        try {
            return Inertia::render($this->view, ['dados' => $paciente]);
        } catch (\Exception $e) {
            $this->LogError($e);
        }
    }
}
