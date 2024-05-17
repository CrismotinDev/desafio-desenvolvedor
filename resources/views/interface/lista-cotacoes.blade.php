<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Cotações</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Lista de Cotações</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Data</th>
                    <th scope="col">Origem</th>
                    <th scope="col">Destino</th>
                    <th scope="col">Conversão</th>
                    <th scope="col">Pagamento</th>
                    <th scope="col">Moeda destino</th>
                    <th scope="col">Valor comprado"</th>
                    <th scope="col">Taxa de pagamento</th>
                    <th scope="col">Taxa de conversão</th>
                    <th scope="col">Valor utilizado para conversão</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cotacoes as $index => $cotacao)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($cotacao['data'])->format('d/m/Y') }}</td>
                        <td>BRL</td>
                        <td>{{ $cotacao['moedaDestino'] }}</td>
                        <td>{{ number_format($cotacao['valorCompra'], 2, ',', '.') }} BRL</td>
                        <td>{{ ucfirst($cotacao['formaPagamento']) }}</td>
                        <td>{{ number_format($cotacao['valorMoedaDestino'], 4, ',', '.') }}
                            {{ $cotacao['moedaDestino'] }}</td>
                        <td>{{ number_format($cotacao['valorTotalMoedaDestino'], 2, ',', '.') }}
                            {{ $cotacao['moedaDestino'] }}</td>
                        <td>R$ {{ number_format($cotacao['taxaPagamento'], 2, ',', '.') }}</td>
                        <td>R$ {{ number_format($cotacao['taxaConversao'], 2, ',', '.') }}</td>
                        <td>R$ {{ number_format($cotacao['valorUtilizadoDescontandoTaxas'], 2, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('excluir-cotacao', $index) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('conversao-moeda') }}" class="btn btn-primary mt-3">Voltar</a>
    </div>
</body>

</html>
