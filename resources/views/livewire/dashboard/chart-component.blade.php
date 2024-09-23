<div>


    <div class="rounded-full">
        <!-- Añadir el canvas para el gráfico -->
        {{-- <canvas id="chartCanvas"></canvas> --}}
        <div id="chartContainer1" style="height: 370px; width: 100%;"></div>
    </div>

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            var myDoughnutChart; // Declarar la variable fuera del listener
        
            function createChart(ctx, labels, data, fixedColors) {
                // Verifica si la gráfica ya está creada, si es así la destruye para evitar duplicados
                if (myDoughnutChart) {
                    myDoughnutChart.destroy(); // Destruye la gráfica anterior si ya existe
                }
        
                // Crear una nueva gráfica
                myDoughnutChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: labels || [], // Asegura que labels sea un array
                        datasets: [{
                            data: (data || []).map(q => parseFloat(q)), // Asegura que data sea un array y convierte a números
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
                                text: 'Productos más vendidos'
                            }
                        },
                        cutout: '50%', // Tamaño del agujero en la gráfica doughnut
                    }
                });
            }
        
            var ctx = document.getElementById('chartCanvas').getContext('2d');
        
            // Colores fijos para el gráfico
            const fixedColors = [
                '#e1bee7', '#ce93d8', '#ba68c8', '#ab47bc', '#9c27b0', '#8e24aa',
                '#c5cae9', '#9fa8da', '#7986cb', '#5c6bc0', '#3f51b5', '#3949ab'
            ];
        
            // Crear la gráfica inicial
            createChart(ctx, @json($products), @json($quantities), fixedColors);
        });
    </script> --}}

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            // Colores fijos para el gráfico
            const fixedColors = [
                '#e1bee7', '#ce93d8', '#ba68c8', '#ab47bc', '#9c27b0', '#8e24aa',
                '#c5cae9', '#9fa8da', '#7986cb', '#5c6bc0', '#3f51b5', '#3949ab'
            ];

            // Variables dinámicas de Laravel
            const products = @json($products); // Etiquetas de productos
            const quantities = @json($quantities); // Cantidades de stock

            // Crear un arreglo de dataPoints con productos y cantidades
            var dataPoints = products.map((product, index) => ({
                y: quantities[index],
                indexLabel: product,
                color: fixedColors[index % fixedColors
                    .length] // Usar los colores fijos, se cicla si hay más productos que colores
            }));

            // Crear la gráfica
            var chart = new CanvasJS.Chart("chartContainer1", {
                backgroundColor: "transparent", // Fondo transparente
                title: {
                    text: "Productos con bajo stock",
                    fontFamily: "Arial",
                    fontSize: 12,
                    fontWeight: "bold",
                    fontColor: "#5b5a5a"
                },
                data: [{
                    type: "doughnut",
                    dataPoints: dataPoints // Añadir los dataPoints generados dinámicamente
                }]
            });

            chart.render();

        });
    </script>




    <style>
        .grid-container {
            display: flex;
            justify-content: center;
            place-items: center;
            width: 35vh;
            height: 35vh;
        }
    </style>



</div>
