<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado da Conversão de Moeda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Informações para Conversão</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Moeda Origem</th>
                    <th scope="col">Moeda Destino</th>
                    <th scope="col">Valor Conversão</th>
                    <th scope="col">Forma de Pagamento</th>
                </tr>
            </thead>
            <tbody>
                <tr>

                    <td>BRL</td>
                    <td>{{ $moedaDestino }}</td>
                    <td>{{ $valorCompra }}</td>
                    <td>{{ $formaPagamento }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="container mt-5">
        <h1 class="mb-4">Resultado Conversão</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Valor Moeda Destino</th>
                    <th scope="col">Valor Comprado</th>
                    <th scope="col">Taxa Pagamento</th>
                    <th scope="col">Taxa Conversão</th>
                    <th scope="col">Valor utilizado Conversão</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ number_format($valorMoedaDestino, 4, ',', '.') }} {{ $moedaDestino }}</td>
                    <td>{{ number_format($valorTotalMoedaDestino, 2, ',', '.') }} {{ $moedaDestino }}</td>
                    <td>R$ {{ number_format($taxaPagamento, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($taxaConversao, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($valorUtilizadoDescontandoTaxas, 2, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
        <a href="{{ route('conversao-moeda') }}" class="btn btn-primary mt-3">Voltar</a>
        <a href="{{ route('listar-cotacoes') }}" class="btn btn-dark mt-3">Listar Cotações Realizadas</a>

    </div>
</body>

</html>
