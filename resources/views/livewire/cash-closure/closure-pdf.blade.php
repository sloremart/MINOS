<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Cierre de Caja</title>
    <style>
        /* Eliminar márgenes y padding por defecto */
        html,
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            font-family: Arial, sans-serif;
        }

        /* Estilos del fondo */
        body {
            background-image: url('../public/images/sena.png');
            background-repeat: repeat;
            background-size: 50px 40px;
            background-position: center;
            /* Centra la imagen de fondo */
            background-attachment: fixed;
            /* Hace que el fondo no se mueva con el scroll */
        }

        /* Capa semi-transparente */
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.841);
            /* Ajusta la opacidad aquí */
            z-index: 1;
        }

        /* Estilo del contenedor de la tabla */
        .content {
            display: grid;
            justify-content: center;
            text-align: center;
            position: relative;
            z-index: 2;
            width: 80%;
            height: auto;
            margin: 40px auto;
            /* Mantén un margen alrededor del contenido */
            background-color: #ffffff;
            /* Fondo blanco para el contenido */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Estilo de la tabla */
        .tabla {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            text-align: left;
        }

        .tabla th,
        .tabla td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
        }

        .tabla thead {
            background-color: #0127cf;
            color: #ffffff;
            border-radius: 20% 20% 0 0;
        }


        .tabla tbody tr {
            background-color: #ffffff;
        }

        .tabla tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .tabla tbody tr:hover {
            background-color: #e1e1e1;
        }

        .tabla tbody td {
            border: none;
            color: #333333;
        }

        .tabla tbody tr:last-child td {
            border-bottom: 2px solid #0127cf;
        }


        

        .table {
            width: 100%;
            /* Ajusta el ancho de la tabla al 100% de su contenedor */
            border-collapse: collapse;
           
            /* Colapsa los bordes para un diseño más limpio */
        }

        .table th,
        .table td {
            padding: 10px;
            /* Espaciado interno para celdas */
            text-align: right;
            /* Alinea el texto a la izquierda */
            border: 1px solid #ddd;
            /* Borde alrededor de las celdas */
        }

        .table th {
            background-color: #f2f2f2;
            /* Color de fondo para los encabezados */
            font-weight: bold;
            text-align: left;
            /* Negrita para los encabezados */
        }

        .table td {
            background-color: #ffffff;
            /* Color de fondo para las celdas de datos */
        }
    </style>
</head>

<body>
    <div class="overlay"></div> <!-- Capa semi-transparente -->
    <div class="content">
        <img src="../public/images/LogoM.png" alt="LOGO" width="150px" height="150px">
        <h1>Reporte de Cierre de Caja </h1>
        <div class="grid-container">
            <table class="table">
                <tr>
                    <th><strong>Usuario:</strong></th>
                    <td>
                        <div>{{ $closure->user->name }}</div>
                    </td>
                </tr>
                <tr>
                    <th><strong>Fecha de Cierre:</strong></th>
                    <td>
                        <div>{{ $closure->closing_date_time }}</div>
                    </td>
                </tr>
                <tr>
                    <th><strong>Saldo Inicial:</strong></th>
                    <td>
                        <div>${{ number_format($closure->start_balance, 2) }}</div>
                    </td>
                </tr>
                <tr>
                    <th><strong>Total Ventas:</strong></th>
                    <td>
                        <div>${{ number_format($closure->total_sales, 2) }}</div>
                    </td>
                </tr>
                <tr>
                    <th><strong>Total Gastos:</strong></th>
                    <td>
                        <div>${{ number_format($closure->total_expenses, 2) }}</div>
                    </td>
                </tr>
                <tr>
                    <th><strong>Saldo Final:</strong></th>
                    <td>
                        <div>${{ number_format($closure->final_balance, 2) }}</div>
                    </td>
                </tr>
            </table>



        </div>
        <h2>Detalles de Ventas</h2>
        <table class="tabla">
            <thead class="thead">
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($salesDetails as $detail)
                    <tr>
                        <td>{{ $detail->product->name }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>$ {{ number_format($detail->unit_price, 2) }}</td>
                        <td>$ {{ number_format($detail->sub_total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h2>Detalles de Compras</h2>
        <table class="tabla">
            <thead class="thead">
                <tr>
                    <th>Proveedor</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($purchaseDetails as $detail)
                    <tr>
                        <td>{{ $detail->supplier_name }}</td>
                        <td>{{ $detail->product_name }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>$ {{ number_format($detail->unit_price, 2) }}</td>
                        <td>$ {{ number_format($detail->sub_total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    </div>


</body>

</html>
