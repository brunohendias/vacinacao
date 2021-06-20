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
    public function index(string $success = null)
    {
        try {
            $dados = $this->model->SelectPaciente()->get();
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
            'telefone' => 'required|string|min:11|max:11'
        ]);

        try {
            $this->model->create(
                $request->only('nome', 'cpf', 'rg', 'telefone')
            );
            
            return $this->index(__('return.store'));
        } catch (\Exception $e) {
            $this->LogError($e);
        }

        return Redirect::route('paciente.index');
    }

    /**
     * Update a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paciente $paciente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paciente $paciente)
    {
        $request->validate([
            'telefone' => 'required|string|min:11|max:11'
        ]);

        try {
            $paciente->update(
                $request->only('telefone')
            );
        } catch (\Exception $e) {
            $this->LogError($e);
        }

        return Redirect::route('paciente.index');
    }
}
