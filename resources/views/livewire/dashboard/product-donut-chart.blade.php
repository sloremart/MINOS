<div>

    <div class="grid-container rounded-full  shadow-2xl bg-orange-400">
        <div id="chart"></div>
    </div>

    {{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest/dist/apexcharts.js"></script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var options = {
                series: @json($quantities),
                chart: {
                    type: 'donut',
                    height: '100%', // Ajusta la altura al 100% del contenedor
                    width: '100%', // Ajusta la anchura al 100% del contenedor
                },
                plotOptions: {
                    pie: {
                        startAngle: -90,
                        endAngle: 270
                    }
                },
                dataLabels: {
                    enabled: false // Deshabilita las etiquetas dentro de la gráfica
                },
                fill: {
                    type: 'gradient',
                },
                legend: {
                    show: false // Oculta el legend (leyenda) por completo
                },
                title: {
                    text: 'Productos y Cantidades'
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: '100%', // Asegura que la anchura sea 100% en pantallas pequeñas
                        },
                        legend: {
                            show: false // Asegura que la leyenda no se muestre en pantallas pequeñas
                        }
                    }
                }],
                labels: @json($products), // Esto muestra las etiquetas dentro del gráfico si `dataLabels` estuviera habilitado
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        });
    </script>
     <style>
        .grid-container {
            display: flex;
            justify-content: center;
            /* Centra horizontalmente */
            place-items: center;
            /* Centra verticalmente */
            width: 35vh;
            height: 35vh;
        }

        #chart {
            width: 100%;
            /* height: 100%; */
            max-width: 100%;
        }
    </style>
</div>
