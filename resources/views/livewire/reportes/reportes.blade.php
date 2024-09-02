<div>
    <!-- resources/views/livewire/suppliers/supplier.blade.php -->
    <div>

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Reportes') }}
            </h2>
        </x-slot>
        <style>
            .chart-container {
                min-height: 300px;
                /* Establece una altura mínima */
                height: auto;
                display: flex;
                align-items: center;
                /* Centra verticalmente el contenido */
                justify-content: center;
                /* Centra horizontalmente el contenido */
                flex-grow: 1;
            }
        </style>
        <div class="container mx-auto px-4 pt-8">
            <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-3 gap-4">
                <!-- Tabla -->
                <div class="relative z-40 bg-white col-span-1 md:col-span-2 p-4 rounded-lg shadow-md overflow-x-auto">
                    @include('partials.v1.table.primary-table-reporte', [
                        'filter_active' => true,
                        'search' => 'search',
                        'search_1' => 'search_1',
                        'search_placeholder' => $search_placeholder,
                        'search_1_placeholder' => $search_1_placeholder,
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

                <!-- Gráfica -->
                <div class="relative z-40   bg-white col-span-1 md:col-span-1 p-4 rounded-lg shadow-md  chart-container"
                    style="height: 100%;">
                    <canvas id="myDoughnutChart" class="z-1"></canvas>
                </div>
            </div>

        </div>
    </div>

    

<<<<<<< HEAD
    {{-- <script src="{{ asset('js/apexcharts.js') }}"></script> --}}

   
   
=======
    <script src="{{ asset('js/apexcharts.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            var options = {
                series: @json($quantities),
                chart: {
                    height: 450,
                    type: 'donut',
                },
                plotOptions: {
                    pie: {
                        startAngle: -90, // Ajusta el ángulo inicial
                        endAngle: 270, // Ajusta el ángulo final para un mejor recorrido
                        donut: {
                            size: '75%', // Aumenta el tamaño del donut para utilizar más espacio
                        }
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val, opts) {
                        return opts.w.globals.series[opts.seriesIndex] + ' (' + val.toFixed(1) + '%)';
                    },
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 350
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }],
                legend: {
                    position: 'right',
                    offsetY: 0,
                    height: 230,
                },
                labels: @json($products),
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        });
    </script> -->
>>>>>>> 0a2133f74b2fa9f339e781755bc5f7f8ba18015d
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('myDoughnutChart').getContext('2d');

<<<<<<< HEAD
            // Colores fijos para el gráfico
            const fixedColors = [
                '#e1bee7',
                '#ce93d8',
                '#ba68c8',
                '#ab47bc',
                '#9c27b0',
                '#8e24aa',
                '#c5cae9',
                '#9fa8da',
                '#7986cb',
                '#5c6bc0',
                '#3f51b5',
                '#3949ab'
            ];
=======
            // Función para generar un color aleatorio en formato rgba
            function getRandomColor() {
                var r = Math.floor(Math.random() * 255);
                var g = Math.floor(Math.random() * 255);
                var b = Math.floor(Math.random() * 255);
                return `rgba(${r}, ${g}, ${b}, 0.6)`;
            }
>>>>>>> 0a2133f74b2fa9f339e781755bc5f7f8ba18015d

            // Crear la gráfica inicial con datos vacíos o definidos
            var myDoughnutChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: @json($products) || [], // Asegurar que es un array
                    datasets: [{
                        data: (@json($quantities) || []).map(q => parseFloat(
<<<<<<< HEAD
                        q)), // Convertir a números
                        backgroundColor: fixedColors, // Usar colores fijos
                        borderColor: fixedColors.map(color => color.replace('0.6',
                        '1')), // Usar colores fijos con borde
=======
                            q)), // Convertir a números
                        backgroundColor: (@json($quantities) || []).map(() =>
                            getRandomColor()),
                        borderColor: (@json($quantities) || []).map(() => getRandomColor()
                            .replace('0.6', '1')),
>>>>>>> 0a2133f74b2fa9f339e781755bc5f7f8ba18015d
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        },
                        title: {
                            display: true,
                            text: 'Productos y Cantidades'
                        }
                    },
                    cutout: '50%',
                }
            });

            // Escuchar el evento 'updateChart'
<<<<<<< HEAD
=======
            Livewire.on('updateChart', (products = [], quantities = []) => {
                console.log('Evento updateChart recibido', products,
                    quantities); // Verificar que se reciben los datos correctos

                // Verificar si products y quantities tienen datos válidos
                if (!Array.isArray(products) || !Array.isArray(quantities) || products.length === 0 ||
                    quantities.length === 0) {
                    console.error('Datos inválidos para actualizar la gráfica:', products, quantities);
                    return;
                }

                // Convertir quantities a números
                const numericQuantities = quantities.map(q => {
                    const number = parseFloat(q);
                    return isNaN(number) ? 0 : number; // Reemplaza valores no numéricos con 0
                });

                // Verificar que los datos sean válidos
                if (numericQuantities.length === 0 || products.length === 0) {
                    console.error('No hay datos válidos para actualizar la gráfica.');
                    return;
                }

                // Actualizar los datos de la gráfica existente
                myDoughnutChart.data.labels = products;
                myDoughnutChart.data.datasets[0].data = numericQuantities;

                // Generar nuevos colores para los datos actualizados
                const newColors = numericQuantities.map(() => getRandomColor());
                myDoughnutChart.data.datasets[0].backgroundColor = newColors;
                myDoughnutChart.data.datasets[0].borderColor = newColors.map(color => color.replace('0.6',
                    '1'));

                // Actualizar la gráfica para reflejar los cambios
                myDoughnutChart.update();
            });
>>>>>>> 0a2133f74b2fa9f339e781755bc5f7f8ba18015d
            Livewire.on('updateChart', (data) => {
                console.log('Evento updateChart recibido', data);

                const {
                    products,
                    quantities
                } = data;

                // Verificar que los arrays no están vacíos
<<<<<<< HEAD
                // if (!Array.isArray(products) || !Array.isArray(quantities) || products.length === 0 ||
                //     quantities.length === 0) {
                //     console.error('Datos inválidos para actualizar la gráfica:', data);
                //     return;
                // }
=======
                if (!Array.isArray(products) || !Array.isArray(quantities) || products.length === 0 ||
                    quantities.length === 0) {
                    console.error('Datos inválidos para actualizar la gráfica:', data);
                    return;
                }
>>>>>>> 0a2133f74b2fa9f339e781755bc5f7f8ba18015d

                // Convertir quantities a números
                const numericQuantities = quantities.map(q => parseFloat(q));

                // Verificar que los datos sean válidos
<<<<<<< HEAD
                // if (numericQuantities.length === 0 || products.length === 0) {
                //     console.error('No hay datos válidos para actualizar la gráfica.');
                //     return;
                // }
=======
                if (numericQuantities.length === 0 || products.length === 0) {
                    console.error('No hay datos válidos para actualizar la gráfica.');
                    return;
                }
>>>>>>> 0a2133f74b2fa9f339e781755bc5f7f8ba18015d

                // Actualizar la gráfica
                myDoughnutChart.data.labels = products;
                myDoughnutChart.data.datasets[0].data = numericQuantities;

<<<<<<< HEAD
                
=======
                // Generar nuevos colores para los datos actualizados
                const newColors = numericQuantities.map(() => getRandomColor());
                myDoughnutChart.data.datasets[0].backgroundColor = newColors;
                myDoughnutChart.data.datasets[0].borderColor = newColors.map(color => color.replace('0.6',
                    '1'));
>>>>>>> 0a2133f74b2fa9f339e781755bc5f7f8ba18015d

                // Actualizar la gráfica para reflejar los cambios
                myDoughnutChart.update();
            });

        });
    </script>

</div>
