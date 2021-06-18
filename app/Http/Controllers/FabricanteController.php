<?php

namespace App\Http\Controllers;

use App\Models\Fabricante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class FabricanteController extends Controller
{
    public function __construct(private Fabricante $model) {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() : object
    {
        $dados = $this->model->SelectFabricante()->get();

        return Inertia::render('Fabricante', ['dados' => $dados]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get() : object
    {
        return $this->model->SelectFabricante()->get();
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

        $this->model->create(
            $request->only('nome', 'cnpj', 'qtd_dose_disponivel')
        );

        return Redirect::route('fabricante.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fabricante  $fabricante
     * @return \Illuminate\Http\Response
     */
    public function show(Fabricante $fabricante) : object
    {
        return $this->RespSuccess([
            'msg' => __('return.find'),
            'dados' => $fabricante
        ]);
    }
}
