<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite('resources/css/app.css')

    <!-- Custom CSS -->
    <style>
        body {
            margin: 0;
            overflow: hidden;
        }

        /* Fondo de la imagen */
        .background-image {
            position: absolute;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            z-index: -1;
            filter: brightness(0.2);
            /* Efecto oscurecido para resaltar las ondas */
            transition: background-image 1s ease-in-out;
        }

        .wave-container {
            position: relative;
            width: 100%;
            height: 100%;
            /* Altura deseada */
            /* background-color: #0099ff; */
            /* Fondo detrás de las ondas */
            overflow: hidden;
        }

        .content {
            position: relative;
            z-index: 10;
            /* Para que el contenido esté sobre las ondas */
            padding: 20px;
            color: #ffffff;
        }

        .waves {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 100%;
            opacity: 0.15;
            /* Hace las ondas translúcidas */
        }

        .wave {
            position: absolute;
            bottom: 0;
            width: 200%;
            /* Anchura extra para la animación */
            height: 100%;
            fill: #ffffff;
            /* Color blanco para el SVG */
            animation: waveAnimation 8s linear infinite;
        }

        .wave:nth-child(2) {
            opacity: 0.3;
            animation-delay: -4s;
        }

        .wave:nth-child(3) {
            opacity: 0.5;
            animation-delay: -2s;
        }

        @keyframes waveAnimation {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }
    </style>
</head>

<body class="antialiased">
    <!-- Fondo con imagen --> 
    <div class="background-image" id="background-image">
       
    </div>

    <div class="wave-container">
        <div class="content">
            <!-- Aquí va el contenido de tu página, que quedará sobre las ondas -->
            <!-- Contenido -->
            <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen selection:bg-red-500 selection:text-white">
                @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                    <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-100 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                    <a href="{{ route('login') }}" class="font-semibold text-gray-100 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-100 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                    @endauth
                </div>
                @endif
                <!-- Resto de tu contenido aquí -->
                <div class="max-w-7xl mx-auto p-6 lg:p-8">
                    <div class="flex justify-center">
                       <img src="{{ asset('images/icono_central.png')}}"  walt="ligo minos" width="150" height="150">
                    </div>

                    <div class="mt-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                            <a class="scale-100 bg-white from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500" style="background-image: url({{asset('images/Welcome_img/Portada1.jpg')}}); background-repeat: no-repeat; background-size: cover; background-position: center; width: 100%; height: auto;">

                                <div class="bg-blue-900 bg-opacity-70 rounded-lg">
                                    <div class="p-6">
                                        <div class="h-14 w-14 bg-red-50 flex items-center justify-center rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-6 h-6 stroke-red-500">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                            </svg>
                                        </div>

                                        <h2 class="mt-6 text-xl font-semibold text-gray-100">MINOS Tu aliado en la gestión contable para minoristas</h2>

                                        <p class="mt-4 text-gray-100 text-sm leading-relaxed">
                                            MINOS es una aplicación diseñada específicamente para simplificar y optimizar la gestión contable de tu negocio minorista. Con MINOS, podrás llevar un control preciso de tus ingresos, gastos, inventario y mucho más, todo en un solo lugar.
                                        </p>
                                    </div>
                                </div>
                            </a>


                            <a class="scale-100 bg-white from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500 bg-cover bg-no-repeat bg-center" style="background-image: url({{asset('images/Welcome_img/Portada2.jpg')}});">
                                <div class="bg-purple-900 bg-opacity-70 rounded-lg w-full">
                                    <div class="p-6">
                                        <div class="h-14 w-14 bg-red-50 flex items-center justify-center rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-6 h-6 stroke-red-500">
                                                <path stroke-linecap="round" d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z" />
                                            </svg>
                                        </div>
                                        <h2 class="mt-6 text-xl font-semibold text-gray-100">Características Destacadas</h2>
                                        <p class="mt-4 text-gray-100 text-sm leading-relaxed">
                                            Registra tus ventas de forma rápida y sencilla y realiza seguimiento de tus clientes. <br>
                                            Lleva un registro detallado de tus productos, controla tu stock y realiza pedidos.<br>
                                            Genera reportes financieros y concilia tus cuentas bancarias.<br>
                                            Calcula y gestiona tus impuestos de manera eficiente.<br>
                                            Obtén informes personalizados para analizar el desempeño de tu negocio.
                                        </p>
                                    </div>
                                </div>
                            </a>



                            <a class="scale-100  bg-white from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500" style="background-image: url({{asset('images/Welcome_img/Portada1.jpg')}}); background-repeat: no-repeat; background-size: cover; background-position: center; width: 100%; height: auto;">
                            <div class="bg-purple-900 bg-opacity-70 rounded-lg w-full">
                            <div class="p-6">
                                    <div class="h-14 w-14 bg-red-50 flex items-center justify-center rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-6 h-6 stroke-red-500">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                                        </svg>
                                    </div>

                                    <h2 class="mt-6 text-xl font-semibold text-gray-100">¿Por qué elegir MINOS?</h2>

                                    <p class="mt-4 text-gray-100 text-sm leading-relaxed">
                                        Intuitivo y fácil de usar: Diseñado para usuarios sin conocimientos avanzados. <br>
                                        Seguro y confiable: Protege tus datos con las últimas medidas de seguridad. <br>
                                        Soporte técnico: Contamos con un equipo de soporte listo para ayudarte. <br>
                                        Escalable: Adaptable a las necesidades de cualquier tipo de negocio. <br>
                                    </p>
                                    <h2 class="mt-6 text-xl font-semibold text-gray-100">Comienza a mejorar tu gestión contable hoy mismo con MINOS.<br></h2>
                                </div>
                            </div>
                            </a>

                            <div class="scale-100  bg-white from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500" style="background-image: url({{asset('images/Welcome_img/Portada2.jpg')}});">
                            <div class="bg-blue-900 bg-opacity-70 rounded-lg w-full">
                            <div class="p-6">
                                    <div class="h-14 w-14 bg-red-50 flex items-center justify-center rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-6 h-6 stroke-red-500">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.115 5.19l.319 1.913A6 6 0 008.11 10.36L9.75 12l-.387.775c-.217.433-.132.956.21 1.298l1.348 1.348c.21.21.329.497.329.795v1.089c0 .426.24.815.622 1.006l.153.076c.433.217.956.132 1.298-.21l.723-.723a8.7 8.7 0 002.288-4.042 1.087 1.087 0 00-.358-1.099l-1.33-1.108c-.251-.21-.582-.299-.905-.245l-1.17.195a1.125 1.125 0 01-.98-.314l-.295-.295a1.125 1.125 0 010-1.591l.13-.132a1.125 1.125 0 011.3-.21l.603.302a.809.809 0 001.086-1.086L14.25 7.5l1.256-.837a4.5 4.5 0 001.528-1.732l.146-.292M6.115 5.19A9 9 0 1017.18 4.64M6.115 5.19A8.965 8.965 0 0112 3c1.929 0 3.716.607 5.18 1.64" />
                                        </svg>
                                    </div>

                                    <h2 class="mt-6 text-xl font-semibold text-gray-100">Beneficios para tu negocio</h2>

                                    <p class="mt-4 text-gray-100 text-sm leading-relaxed">
                                        Ahorra tiempo: Automatiza tareas repetitivas y reduce errores manuales. <br>
                                        Mejora la toma de decisiones: Accede a información precisa y actualizada sobre tu negocio. <br>
                                        Aumenta la eficiencia: Optimiza tus procesos contables y administrativos. <br>
                                        Cumple con las normativas: Asegúrate de cumplir con todas las obligaciones fiscales. <br>
                                    </p>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <h1>Contenido sobre las ondas</h1>
            <p>Este es el contenido que no debe deformarse.</p>
        </div>
        <div class="waves">
            <svg class="wave" viewBox="0 0 120 28" preserveAspectRatio="none">
                <path d="M0 15 Q 30 30, 60 15 T 120 15 V30 H0 Z" />
            </svg>
            <svg class="wave" viewBox="0 0 120 28" preserveAspectRatio="none">
                <path d="M0 20 Q 30 35, 60 20 T 120 20 V30 H0 Z" />
            </svg>
            <svg class="wave" viewBox="0 0 120 28" preserveAspectRatio="none">
                <path d="M0 25 Q 30 40, 60 25 T 120 25 V30 H0 Z" />
            </svg>
        </div>
    </div>





    <!-- JavaScript para cambiar las imágenes -->
    <script>
        const images = [
            '{{ asset("images/Welcome_img/Portada1.jpg") }}',
            '{{ asset("images/Welcome_img/Portada2.jpg") }}',
            '{{ asset("images/Welcome_img/Portada3.jpg") }}'
        ];
        let currentIndex = 0;
        const backgroundImageElement = document.getElementById('background-image');

        function changeBackgroundImage() {
            currentIndex = (currentIndex + 1) % images.length;
            backgroundImageElement.style.backgroundImage = `url('${images[currentIndex]}')`;
        }

        setInterval(changeBackgroundImage, 3000);
    </script>
</body>

</html>