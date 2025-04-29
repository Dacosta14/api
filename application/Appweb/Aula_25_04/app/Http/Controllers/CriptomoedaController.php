<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class criptomoedaController extends Controller
{
    private $urlApi = 'http://127.0.0.1:8000/api/cripto/';

    public function index()
    {
        $response = Http::get($this->urlApi);
        $data = $response->json();
        return view('criptomoeda.index', ['criptos' => $data['data'] ?? [], 'message' => $data['message'] ?? '']);
    }

    public function create()
    {
        return view('criptomoeda.create');
    }
    public function store(Request $request)
    {
        $response = Http::post($this->urlApi, [
            'sigla' => $request->input('sigla'),
            'nome' => $request->input('nome'),
            'valor' => $request->input('valor'),
        ]);

        $data = $response->json();
        return redirect()->route('criptomoedas.index')->with(['message' => $data['message'] ?? '']);
    }
}
