<?php

namespace App\Http\Controllers;

use App\Services\ApiConversaoValores\ConversaoValoresService;
use Illuminate\Http\Request;

class ConversaoController extends Controller
{

    public $conversaoValoresService;
    public function __construct(ConversaoValoresService $conversaoValoresService)
    {
        $this->conversaoValoresService = $conversaoValoresService;
    }
    public function calcularTotal(Request $request)
    {

        $request->validate([
            'valorCompra' => 'required|numeric|min:1000|max:100000',
            'moedaDestino' => 'required|in:USD',
            'formaPagamento' => 'required|in:boleto,cartao',
        ]);

        $valorCompra = $request->input('valorCompra');
        $moedaDestino = $request->input('moedaDestino');
        $formaPagamento = $request->input('formaPagamento');
        $moedaOrigem = $request->input('moedaOrigem');

        $valorMoedaDestino = $this->conversaoValoresService->obterValorMoedaDestino($moedaOrigem, $moedaDestino);

        $taxaConversao = $valorCompra * ($valorCompra < 3000 ? 0.02 : 0.01);


        $taxaPagamento = ($formaPagamento === 'boleto' ? $valorCompra * 0.0145 : $valorCompra * 0.0763);


        $valorTotal = $valorCompra + $taxaConversao + $taxaPagamento;
        $valorMoedaDestino = 5.30;
        $valorCompradoMoedaDestino = $valorTotal / $valorMoedaDestino;
        $valorUtilizadoConversao = $valorCompra - $taxaConversao;
        $taxaPagamentoReal = $taxaPagamento * $valorMoedaDestino;
        $taxaConversaoReal = $taxaConversao * $valorMoedaDestino;

        return view('interface.conversao-moeda', [
            'moedaOrigem' => 'BRL',
            'moedaDestino' => $moedaDestino,
            'valorCompra' => $valorCompra,
            'formaPagamento' => $formaPagamento,
            'valorMoedaDestino' => $valorMoedaDestino,
            'valorCompradoMoedaDestino' => $valorCompradoMoedaDestino,
            'taxaPagamento' => $taxaPagamentoReal,
            'taxaConversao' => $taxaConversaoReal,
            'valorUtilizadoConversao' => $valorUtilizadoConversao,
        ]);
    }
}
