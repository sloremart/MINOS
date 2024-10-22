<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte venta cliente</title>
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
            background-image: url('../public/images/FONDOPDF.png');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 120%;
            background-position: center;
            height: 100vh;
            margin: 0;
        }

        /* Capa semi-transparente */
        /* .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.841);
            /* Ajusta la opacidad aquí 
            z-index: 
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
            margin: 40px 0px 0px 23px;
            /* Fondo blanco para el contenido */
            padding: 20px;
            padding-top: 20%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);            
        }

        /* Estilo de la tabla */
        .tabla {
            width: 80%;
            border-collapse: collapse;
            font-size: 14px;
            text-align: left;
            border-radius: 10px;
            overflow: hidden;
        }

        .tabla th,
        .tabla td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
        }

        .tabla thead {
            background-color: #652581;
            color: #ffffff;
            border-radius: 20% 20%;
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
    </style>
</head>

<body>
    <div class="overlay"></div> <!-- Capa semi-transparente -->
    <div class="content">
       
        <h3>REPORTES DE VENTAS POR CLIENTE </h3>
        <table class="tabla">
            <thead class="thead">
                <tr>
                    <th>ID</th>
                    <th>Nombre Cliente</th>
                    <th>Documento</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Venta Detalle</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td> <!-- Si no tienes ID explícito -->
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->document }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->phone }}</td>
                        <td> ${{ number_format($item->total_amount,2 )}}</td>
                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
    <script>
        document.addEventListener('livewire:load', function() {
            window.addEventListener('update-filters', function() {
                Livewire.on('updateFilters');
            });
        });
    </script>
</body>

</html>
