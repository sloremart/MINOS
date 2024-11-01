<div>
<!-- VISTA PRINCIPAL DE REPORTES DE VENTAS -->

    <div>

       
        <h2 class="font-semibold text-xl text-gray-800 leading-tight pt-10 text-center" style="font-size: 34px">
            {{ __('Reportes Ventas') }}
        </h2>
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
                    @include('partials.v1.table.primary-table-report', [
                        'filter_active' => true,
                        'search' => 'search',
                        'search_1' => 'search_1',
                        'search_2' => 'search_2',
                        'search_placeholder' => $search_placeholder,
                        'search_1_placeholder' => $search_1_placeholder,
                        'search_2_placeholder' => $search_2_placeholder,
                        'table_headers' => [
                          
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

    

    {{-- <script src="{{ asset('js/apexcharts.js') }}"></script> --}}

   
   
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var myDoughnutChart; // Declarar la variable fuera del listener
    
            function createChart(ctx, products, quantities, fixedColors) {
                // Verifica si la gráfica ya está creada, si es así la destruye para evitar duplicados
                if (myDoughnutChart) {
                    myDoughnutChart.destroy(); // Destruye la gráfica anterior si ya existe
                }
    
                // Crear una nueva gráfica
                myDoughnutChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: products || [], // Asegurar que es un array
                        datasets: [{
                            data: (quantities || []).map(q => parseFloat(q)), // Convertir a números
                            backgroundColor: fixedColors, // Usar colores fijos
                            borderColor: fixedColors.map(color => color.replace('0.6', '1')), // Usar colores fijos con borde
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
            }
    
            var ctx = document.getElementById('myDoughnutChart').getContext('2d');
    
            // Colores fijos para el gráfico
            const fixedColors = [
                '#e1bee7', '#ce93d8', '#ba68c8', '#ab47bc', '#9c27b0', '#8e24aa',
                '#c5cae9', '#9fa8da', '#7986cb', '#5c6bc0', '#3f51b5', '#3949ab'
            ];
    
            // Crear la gráfica inicial
            createChart(ctx, @json($products), @json($quantities), fixedColors);
    
            // Escuchar el evento 'updateChart'
            Livewire.on('updateChart', (data) => {
                console.log('Evento updateChart recibido', data);
    
                const {
                     products,
                      quantities 
                } = data;
    
                // Actualizar la gráfica con los nuevos datos
                createChart(ctx, products, quantities, fixedColors);
            });
        });
    </script>

</div>
