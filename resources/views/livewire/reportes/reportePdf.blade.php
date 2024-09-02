<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-3 gap-4">
        <!-- Tabla jjjj-->
        <div class="relative z-40 bg-white col-span-2 md:col-span-2 p-4 rounded-lg shadow-md overflow-x-auto">
            @include('partials.v1.table.primary-table-reporte', [
                'filter_active' => true,
                'table_headers' => [
                    'ID' => 'id',
                    'Nombre' => 'name',
                    'Valor Unitario' => 'unit_price',
                    'Cantidad' => 'total_quantity',
                    'Valor Subtotal' => 'sub_total',
                    'Fecha' => 'last_created_at',
                ],
                'table_rows' => $data,
            ])
        </div>
    </div>
</body>
</html>