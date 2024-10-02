<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Cierre de Caja</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        .header {
            margin-bottom: 40px;
        }

        .header h1 {
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Reporte de Cierre de Caja</h1>
        <p><strong>Usuario:</strong> {{ $closure->user->name }}</p>
        <p><strong>Fecha de Cierre:</strong> {{ $closure->closing_date_time }}</p>
        <p><strong>Saldo Inicial:</strong> {{ number_format($closure->start_balance, 2) }}</p>
        <p><strong>Total Ventas:</strong> {{ number_format($closure->total_sales, 2) }}</p>
        <p><strong>Total Gastos:</strong> {{ number_format($closure->total_expenses, 2) }}</p>
        <p><strong>Saldo Final:</strong> {{ number_format($closure->final_balance, 2) }}</p>
    </div>

    <h2>Detalles de Ventas</h2>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($salesDetails as $detail)
                <tr>
                    <td>{{ $detail->product->name }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{ number_format($detail->sub_total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
