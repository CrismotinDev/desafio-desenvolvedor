<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de Moedas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <a href="{{ route('listar-cotacoes') }}" class="btn btn-dark mt-3">Listar Cotações Realizadas</a>
        <h1 class="mb-4">Conversor de Moedas</h1>
        <form action="{{ route('cotacao-moeda') }}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="POST">
            <div class="mb-3">
                <label for="moedaOrigem" class="form-label">Moeda de Origem</label>
                <select class="form-select" id="moedaOrigem" name="moedaOrigem" disabled>
                    <option value="BRL">BRL (default)</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="moedaDestino" class="form-label">Moeda de Destino</label>
                <select class="form-select" id="moedaDestino" name="moedaDestino">
                    <option value="USD">Dólar Americano (USD)</option>
                    <option value="EUR">Euro (EUR)</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="valorCompra" class="form-label">Valor da Compra em BRL</label>
                <input type="text" class="form-control" id="valorCompra" name="valorCompra" value="1.000.00">
                <div id="valorCompraHelp" class="form-text">O valor deve ser maior que R$ 1.000,00 e menor que R$
                    100.000,00.</div>
            </div>

            <div class="mb-3">
                <label for="formaPagamento" class="form-label">Forma de Pagamento</label>
                <select class="form-select" id="formaPagamento" name="formaPagamento">
                    <option value="boleto">Boleto</option>
                    <option value="cartao">Cartão de Crédito</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Converter</button>
        </form>

    </div>
</body>

</html>
<script>
    var valorCompraInput = document.getElementById('valorCompra');
    valorCompraInput.addEventListener('input', function() {
        var valor = valorCompraInput.value;
        valor = valor.replace(/\D/g, '');
        valor = (parseFloat(valor) / 100).toLocaleString('pt-BR', {
            minimumFractionDigits: 2
        });
        if (parseFloat(valor) > 1000) {
            valor = '100.000,00';
        }
        valorCompraInput.value = valor;
    });
</script>
