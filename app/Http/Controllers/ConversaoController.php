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

    public function formCotacao(Request $request)
    {
        if ($request->filled(['valorCompra', 'moedaDestino', 'formaPagamento'])) {
            return redirect()->route('tabela-cotacao-moeda', []);
        }

        return view('interface.conversao-moeda');
    }

    public function resultadoCotacao(Request $request)
    {
        $valorCompra = $request->input('valorCompra');
        $formaPagamento = $request->input('formaPagamento');
        $moedaDestino = $request->input('moedaDestino');
        $valorCompra = str_replace(',', '.', str_replace('.', '', $valorCompra));
        $valorMoedaDestino = $this->conversaoValoresService->obterValorMoedaDestino($moedaDestino);
        $taxaConversao = $valorCompra * ($valorCompra < 3000 ? 0.02 : 0.01);
        $taxaPagamento = ($formaPagamento === 'boleto') ? $valorCompra * 0.0145 : $valorCompra * 0.0763;
        $valorTotalSemTaxas = $valorCompra - $taxaConversao;
        $valorTotalMoedaDestino = $valorTotalSemTaxas / $valorMoedaDestino;
        $valorUtilizadoDescontandoTaxas = $valorCompra - $taxaConversao - $taxaPagamento;

        $cotacao = [
            'moedaDestino' => $moedaDestino,
            'valorCompra' => $valorCompra,
            'formaPagamento' => $formaPagamento,
            'valorMoedaDestino' => $valorMoedaDestino,
            'valorTotalMoedaDestino' => $valorTotalMoedaDestino,
            'taxaPagamento' => $taxaPagamento,
            'taxaConversao' => $taxaConversao,
            'valorUtilizadoDescontandoTaxas' => $valorUtilizadoDescontandoTaxas,
            'data' => now(),
        ];

        $cotacoes = session('cotacoes', []);
        $cotacoes[] = $cotacao;
        session(['cotacoes' => $cotacoes]);

        return view('interface.resultado-conversao-moeda', compact(
            'valorCompra',
            'formaPagamento',
            'moedaDestino',
            'valorMoedaDestino',
            'valorTotalMoedaDestino',
            'taxaPagamento',
            'taxaConversao',
            'valorUtilizadoDescontandoTaxas'
        ));
    }

    public function listarCotacoes()
    {
        $cotacoes = session('cotacoes', []);
        return view('interface.lista-cotacoes', compact('cotacoes'));
    }

    public function excluirCotacao($index)
    {
        $cotacoes = session('cotacoes', []);

        if (isset($cotacoes[$index])) {
            unset($cotacoes[$index]);
            session(['cotacoes' => array_values($cotacoes)]);
        }

        return redirect()->route('listar-cotacoes')->with('success', 'Cotação excluída com sucesso!');
    }
}
