<div>


    <div class="rounded-full">
        <!-- Añadir el canvas para el gráfico -->
        <canvas id="chartCanvas"></canvas>
    </div>

    <script>
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
