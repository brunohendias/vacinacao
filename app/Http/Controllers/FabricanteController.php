<?php

namespace App\Http\Controllers;

use App\Models\Fabricante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class FabricanteController extends Controller
{
    private string $view = 'Fabricante';

    public function __construct(private Fabricante $model) {}

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(string $success = null)
    {
        try {
            $dados = $this->model->SelectFabricante()->get();
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
            return $this->model->SelectFabricante()->get();
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
            'nome' => 'required|string|unique:fabricantes,nome|max:255',
            'cnpj' => 'required|string|unique:fabricantes,cnpj|min:14|max:14',
            'qtd_dose_disponivel' => 'required|integer'
        ]);
        
        try {
            $this->model->create(
                $request->only('nome', 'cnpj', 'qtd_dose_disponivel')
            );

            return $this->index(__('return.store'));
        } catch (\Exception $e) {
            $this->LogError($e);
        }

        return Redirect::route('fabricante.index');
    }

    /**
     * Update a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fabricante $fabricante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fabricante $fabricante)
    {
        $request->validate([
            'qtd_dose_disponivel' => 'required|integer'
        ]);

        try {
            $fabricante->update(
                $request->only('qtd_dose_disponivel')
            );
        } catch (\Exception $e) {
            $this->LogError($e);
        }

        return Redirect::route('paciente.index');
    }

    /**
     * delete a register
     *
     * @param  \App\Models\Fabricante $fabricante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fabricante $fabricante)
    {
        $fabricante->validate([
            'qtd_dose_disponivel' => 'max:0'
        ]);

        try {
            $fabricante->delete();
        } catch (\Exception $e) {
            $this->LogError($e);
        }

        return Redirect::route('paciente.index');
    }
}
