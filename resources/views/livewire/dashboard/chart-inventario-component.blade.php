<div>


    <div class="rounded-full">
        <!-- Añadir el canvas para el gráfico -->
        {{-- <canvas id="chart"></canvas> --}}
        <div id="chartContainer" style="height: 270px; width: 100%;"></div>

    </div>
    {{-- 
    <script>
        document.addEventListener('DOMContentLoaded', function() {

           
            var ctx = document.getElementById('chart').getContext('2d');

            // Colores fijos para el gráfico
            const fixedColors = [
            '#1E3A8A', // Azul oscuro
            '#3B82F6', // Azul claro
            '#1E40AF', // Azul oscuro
            '#60A5FA', // Azul claro
            '#2563EB', // Azul oscuro
            '#93C5FD', // Azul claro
            '#2B6CB0', // Azul oscuro
            '#BFDBFE', // Azul claro
            '#3B82F6', // Azul claro
            '#1E3A8A', // Azul oscuro
            '#60A5FA', // Azul claro
            '#1E40AF'  // Azul oscuro
        ];
    
            // Crear la gráfica de productos con bajo stock
            var myDoughnutChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: @json($products), // Etiquetas de los productos con bajo stock
                    datasets: [{
                        data: @json($quantities), // Cantidades de stock
                        backgroundColor: fixedColors, // Usar colores fijos
                        borderColor: fixedColors.map(color => color.replace('0.6', '1')), // Colores de borde
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
                            text: 'Productos con bajo stock'
                        }
                    },
                    cutout: '50%', // Agujero en el centro del gráfico tipo doughnut
                }
            });
        });
    </script> --}}

    <script type="text/javascript">
        window.onload = function() {
            // Adaptar productos y cantidades para los puntos de datos
            var products = @json($products); // Etiquetas de los productos
            var quantities = @json($quantities); // Cantidades de stock
        
            // Colores fijos
            const fixedColors = [
                '#1E3A8A', '#3B82F6', '#1E40AF', '#60A5FA', '#2563EB', '#93C5FD',
                '#2B6CB0', '#BFDBFE', '#3B82F6', '#1E3A8A', '#60A5FA', '#1E40AF'
            ];
        
            // Crear los puntos de datos con colores personalizados
            var dataPoints = [];
            for (var i = 0; i < products.length; i++) {
                dataPoints.push({
                    y: quantities[i],
                    label: products[i],
                    color: fixedColors[i % fixedColors.length] // Asignar color a cada punto
                });
            }
        
            var chart = new CanvasJS.Chart("chartContainer", {
                backgroundColor: "transparent", // Fondo transparente
                exportEnabled: true,
                exportFileName: "Reporte stock inventario",
                title: {
                    text: "Productos con bajo stock",
                    fontFamily: "Arial",
                    fontSize: 12,
                    fontWeight: "bold",
                    fontColor: "#5b5a5a"
                },
                data: [{
                    type: "funnel", // Cambiar a tipo embudo
                    indexLabel: "{label} [{y}]",
                    neckHeight: 0,
                    toolTipContent: "{label} - {y}",
                    dataPoints: dataPoints // Asignar los puntos de datos con colores
                }],
                creditText: "", // Elimina la marca de agua
            });
        
            chart.render();
        }
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
