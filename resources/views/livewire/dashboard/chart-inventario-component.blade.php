<div>


    <div class="rounded-full">
        <!-- Añadir el canvas para el gráfico -->
        <canvas id="chart"></canvas>
    </div>

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
