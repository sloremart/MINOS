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
            opacity: 0.2;
            /* Hace las ondas translúcidas */
        }

        .wave {
            position: absolute;
            bottom: 0;
            width: 200%;
            /* Anchura extra para la animación */
            height: 100%;
            fill: #67a0fb00;
            /* Color blanco para el SVG */
            animation: waveAnimation 5s linear infinite;
        }

        .wave:nth-child(2) {
            left: -100%;
            opacity: 0.3;
            animation-delay: -4s;
        }

        .wave:nth-child(3) {
            left: -100%;
            opacity: 0.5;
            animation-delay: -2s;
        }

        .wave:nth-child(4) {
            left: -64%;
            opacity: 0.5;
            animation-delay: -1s;
        }

        .wave:nth-child(5) {
            left: -64%;
            opacity: 0.5;
            animation-delay: -1s;
        }

        @keyframes waveAnimation {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(100%);
            }

            100% {
                transform: translateY(100%);
            }

            100% {
                transform: translateY(50%);
            }
        }
    </style>
</head>

<body class="antialiased">
    <!-- Fondo con imagen -->
    <div class="background-image" id="background-image">

    </div>

    <div class="wave-container">
        <div class="content overflow-y-auto h-screen">
          
            <div class="relative sm:flex sm:justify-center sm:items-center  selection:bg-red-500 selection:text-white" style="min-height: 93vh;">
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
                <div class="max-w-7xl mx-auto">
                    <div class="flex justify-center">
                        <img src="{{ asset('images/icono_central.png')}}" walt="ligo minos" width="100" height="100">
                    </div>

                    <div class="scale-75 grid grid-cols-1 md:grid-cols-2 " style="margin-top: -4.5rem">
                        <a class="scale-90 bg-white from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500" style="background-image: url({{asset('images/Welcome_img/Portada1.jpg')}}); background-repeat: no-repeat; background-size: cover; background-position: center; width: 100%; height: auto;">

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


                        <a class="scale-90 bg-white from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500 bg-cover bg-no-repeat bg-center" style="background-image: url({{asset('images/Welcome_img/Portada2.jpg')}});">
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


                        <a class="scale-90 bg-white from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500" style="background-image: url({{asset('images/Welcome_img/Portada1.jpg')}}); background-repeat: no-repeat; background-size: cover; background-position: center; width: 100%; height: auto;">
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

                        <a class="scale-90  bg-white from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500" style="background-image: url({{asset('images/Welcome_img/Portada3.jpg')}}); background-repeat: no-repeat; background-size: cover; background-position: center; width: 100%; height: auto;">
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
                    </a>

                </div>

            </div>
           
        </div>
        <div class="waves">
            <svg xmlns="http://www.w3.org/2000/svg" class="wave" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs" viewBox="0 0 800 800">
                <defs>
                    <linearGradient x1="50%" y1="0%" x2="50%" y2="100%" id="ffflurry-grad" gradientTransform="rotate(270)">
                        <stop stop-color="#ffffff" stop-opacity="1" offset="0%"></stop>
                        <stop stop-color="hsl(263, 100%, 50%)" stop-opacity="1" offset="45%"></stop>
                        <stop stop-color="hsl(204, 100%, 50%)" stop-opacity="1" offset="100%"></stop>
                    </linearGradient>
                </defs>
                <rect width="100%" height="100%"></rect>
                <g fill="url(#ffflurry-grad)">
                    <rect width="136" height="3" x="346" y="490.5" rx="1.5" transform="rotate(71, 414, 492)" opacity="0.42"></rect>
                    <rect width="152" height="3" x="458" y="483.5" rx="1.5" transform="rotate(71, 534, 485)" opacity="0.69"></rect>
                    <rect width="54" height="3" x="632" y="148.5" rx="1.5" transform="rotate(71, 659, 150)" opacity="0.92"></rect>
                    <rect width="81" height="3" x="434.5" y="246.5" rx="1.5" transform="rotate(71, 475, 248)" opacity="0.77"></rect>
                    <rect width="166" height="3" x="496" y="361.5" rx="1.5" transform="rotate(71, 579, 363)" opacity="0.74"></rect>
                    <rect width="120" height="3" x="365" y="342.5" rx="1.5" transform="rotate(71, 425, 344)" opacity="0.23"></rect>
                    <rect width="110" height="3" x="-24" y="636.5" rx="1.5" transform="rotate(71, 31, 638)" opacity="0.73"></rect>
                    <rect width="206" height="3" x="495" y="52.5" rx="1.5" transform="rotate(71, 598, 54)" opacity="0.59"></rect>
                    <rect width="126" height="3" x="-11" y="273.5" rx="1.5" transform="rotate(71, 52, 275)" opacity="0.27"></rect>
                    <rect width="66" height="3" x="465" y="141.5" rx="1.5" transform="rotate(71, 498, 143)" opacity="0.88"></rect>
                    <rect width="125" height="3" x="267.5" y="592.5" rx="1.5" transform="rotate(71, 330, 594)" opacity="0.80"></rect>
                    <rect width="192" height="3" x="31" y="439.5" rx="1.5" transform="rotate(71, 127, 441)" opacity="0.87"></rect>
                    <rect width="77" height="3" x="91.5" y="750.5" rx="1.5" transform="rotate(71, 130, 752)" opacity="0.49"></rect>
                    <rect width="167" height="3" x="320.5" y="595.5" rx="1.5" transform="rotate(71, 404, 597)" opacity="0.48"></rect>
                    <rect width="86" height="3" x="154" y="123.5" rx="1.5" transform="rotate(71, 197, 125)" opacity="0.70"></rect>
                    <rect width="199" height="3" x="612.5" y="557.5" rx="1.5" transform="rotate(71, 712, 559)" opacity="0.96"></rect>
                    <rect width="143" height="3" x="458.5" y="740.5" rx="1.5" transform="rotate(71, 530, 742)" opacity="0.46"></rect>
                    <rect width="177" height="3" x="-13.5" y="177.5" rx="1.5" transform="rotate(71, 75, 179)" opacity="0.45"></rect>
                    <rect width="160" height="3" x="-35" y="379.5" rx="1.5" transform="rotate(71, 45, 381)" opacity="0.49"></rect>
                    <rect width="67" height="3" x="229.5" y="634.5" rx="1.5" transform="rotate(71, 263, 636)" opacity="0.30"></rect>
                    <rect width="68" height="3" x="162" y="228.5" rx="1.5" transform="rotate(71, 196, 230)" opacity="0.29"></rect>
                    <rect width="58" height="3" x="190" y="35.5" rx="1.5" transform="rotate(71, 219, 37)" opacity="0.47"></rect>
                    <rect width="53" height="3" x="578.5" y="612.5" rx="1.5" transform="rotate(71, 605, 614)" opacity="0.60"></rect>
                    <rect width="68" height="3" x="246" y="311.5" rx="1.5" transform="rotate(71, 280, 313)" opacity="0.24"></rect>
                    <rect width="81" height="3" x="255.5" y="519.5" rx="1.5" transform="rotate(71, 296, 521)" opacity="0.57"></rect>
                    <rect width="71" height="3" x="191.5" y="456.5" rx="1.5" transform="rotate(71, 227, 458)" opacity="0.86"></rect>
                    <rect width="130" height="3" x="-23" y="745.5" rx="1.5" transform="rotate(71, 42, 747)" opacity="0.15"></rect>
                    <rect width="129" height="3" x="22.5" y="583.5" rx="1.5" transform="rotate(71, 87, 585)" opacity="0.19"></rect>
                    <rect width="276" height="3" x="583" y="427.5" rx="1.5" transform="rotate(71, 721, 429)" opacity="0.43"></rect>
                    <rect width="96" height="3" x="115" y="336.5" rx="1.5" transform="rotate(71, 163, 338)" opacity="0.81"></rect>
                    <rect width="88" height="3" x="352" y="125.5" rx="1.5" transform="rotate(71, 396, 127)" opacity="0.11"></rect>
                    <rect width="182" height="3" x="651" y="71.5" rx="1.5" transform="rotate(71, 742, 73)" opacity="0.63"></rect>
                    <rect width="126" height="3" x="137" y="694.5" rx="1.5" transform="rotate(71, 200, 696)" opacity="0.91"></rect>
                    <rect width="163" height="3" x="511.5" y="229.5" rx="1.5" transform="rotate(71, 593, 231)" opacity="0.58"></rect>
                    <rect width="101" height="3" x="447.5" y="615.5" rx="1.5" transform="rotate(71, 498, 617)" opacity="0.79"></rect>
                    <rect width="254" height="3" x="589" y="717.5" rx="1.5" transform="rotate(71, 716, 719)" opacity="0.41"></rect>
                    <rect width="190" height="3" x="639" y="265.5" rx="1.5" transform="rotate(71, 734, 267)" opacity="0.79"></rect>
                    <rect width="113" height="3" x="302.5" y="753.5" rx="1.5" transform="rotate(71, 359, 755)" opacity="0.41"></rect>
                    <rect width="54" height="3" x="148" y="560.5" rx="1.5" transform="rotate(71, 175, 562)" opacity="0.29"></rect>
                    <rect width="142" height="3" x="261" y="405.5" rx="1.5" transform="rotate(71, 332, 407)" opacity="0.37"></rect>
                    <rect width="194" height="3" x="-49" y="503.5" rx="1.5" transform="rotate(71, 48, 505)" opacity="0.42"></rect>
                    <rect width="78" height="3" x="211" y="755.5" rx="1.5" transform="rotate(71, 250, 757)" opacity="0.36"></rect>
                    <rect width="41" height="3" x="102.5" y="656.5" rx="1.5" transform="rotate(71, 123, 658)" opacity="0.18"></rect>
                    <rect width="117" height="3" x="265.5" y="63.5" rx="1.5" transform="rotate(71, 324, 65)" opacity="0.79"></rect>
                    <rect width="146" height="3" x="253" y="205.5" rx="1.5" transform="rotate(71, 326, 207)" opacity="0.12"></rect>
                    <rect width="103" height="3" x="414.5" y="39.5" rx="1.5" transform="rotate(71, 466, 41)" opacity="0.41"></rect>
                    <rect width="153" height="3" x="319.5" y="682.5" rx="1.5" transform="rotate(71, 396, 684)" opacity="0.87"></rect>
                    <rect width="163" height="3" x="-11.5" y="59.5" rx="1.5" transform="rotate(71, 70, 61)" opacity="0.27"></rect>
                </g>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" class="wave" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs" viewBox="0 0 800 800">
                <defs>
                    <linearGradient x1="50%" y1="0%" x2="50%" y2="100%" id="ffflurry-grad" gradientTransform="rotate(270)">
                        <stop stop-color="#ffffff" stop-opacity="1" offset="0%"></stop>
                        <stop stop-color="hsl(263, 100%, 50%)" stop-opacity="1" offset="45%"></stop>
                        <stop stop-color="hsl(204, 100%, 50%)" stop-opacity="1" offset="100%"></stop>
                    </linearGradient>
                </defs>
                <rect width="100%" height="100%"></rect>
                <g fill="url(#ffflurry-grad)">
                    <rect width="136" height="3" x="346" y="490.5" rx="1.5" transform="rotate(71, 414, 492)" opacity="0.42"></rect>
                    <rect width="152" height="3" x="458" y="483.5" rx="1.5" transform="rotate(71, 534, 485)" opacity="0.69"></rect>
                    <rect width="54" height="3" x="632" y="148.5" rx="1.5" transform="rotate(71, 659, 150)" opacity="0.92"></rect>
                    <rect width="81" height="3" x="434.5" y="246.5" rx="1.5" transform="rotate(71, 475, 248)" opacity="0.77"></rect>
                    <rect width="166" height="3" x="496" y="361.5" rx="1.5" transform="rotate(71, 579, 363)" opacity="0.74"></rect>
                    <rect width="120" height="3" x="365" y="342.5" rx="1.5" transform="rotate(71, 425, 344)" opacity="0.23"></rect>
                    <rect width="110" height="3" x="-24" y="636.5" rx="1.5" transform="rotate(71, 31, 638)" opacity="0.73"></rect>
                    <rect width="206" height="3" x="495" y="52.5" rx="1.5" transform="rotate(71, 598, 54)" opacity="0.59"></rect>
                    <rect width="126" height="3" x="-11" y="273.5" rx="1.5" transform="rotate(71, 52, 275)" opacity="0.27"></rect>
                    <rect width="66" height="3" x="465" y="141.5" rx="1.5" transform="rotate(71, 498, 143)" opacity="0.88"></rect>
                    <rect width="125" height="3" x="267.5" y="592.5" rx="1.5" transform="rotate(71, 330, 594)" opacity="0.80"></rect>
                    <rect width="192" height="3" x="31" y="439.5" rx="1.5" transform="rotate(71, 127, 441)" opacity="0.87"></rect>
                    <rect width="77" height="3" x="91.5" y="750.5" rx="1.5" transform="rotate(71, 130, 752)" opacity="0.49"></rect>
                    <rect width="167" height="3" x="320.5" y="595.5" rx="1.5" transform="rotate(71, 404, 597)" opacity="0.48"></rect>
                    <rect width="86" height="3" x="154" y="123.5" rx="1.5" transform="rotate(71, 197, 125)" opacity="0.70"></rect>
                    <rect width="199" height="3" x="612.5" y="557.5" rx="1.5" transform="rotate(71, 712, 559)" opacity="0.96"></rect>
                    <rect width="143" height="3" x="458.5" y="740.5" rx="1.5" transform="rotate(71, 530, 742)" opacity="0.46"></rect>
                    <rect width="177" height="3" x="-13.5" y="177.5" rx="1.5" transform="rotate(71, 75, 179)" opacity="0.45"></rect>
                    <rect width="160" height="3" x="-35" y="379.5" rx="1.5" transform="rotate(71, 45, 381)" opacity="0.49"></rect>
                    <rect width="67" height="3" x="229.5" y="634.5" rx="1.5" transform="rotate(71, 263, 636)" opacity="0.30"></rect>
                    <rect width="68" height="3" x="162" y="228.5" rx="1.5" transform="rotate(71, 196, 230)" opacity="0.29"></rect>
                    <rect width="58" height="3" x="190" y="35.5" rx="1.5" transform="rotate(71, 219, 37)" opacity="0.47"></rect>
                    <rect width="53" height="3" x="578.5" y="612.5" rx="1.5" transform="rotate(71, 605, 614)" opacity="0.60"></rect>
                    <rect width="68" height="3" x="246" y="311.5" rx="1.5" transform="rotate(71, 280, 313)" opacity="0.24"></rect>
                    <rect width="81" height="3" x="255.5" y="519.5" rx="1.5" transform="rotate(71, 296, 521)" opacity="0.57"></rect>
                    <rect width="71" height="3" x="191.5" y="456.5" rx="1.5" transform="rotate(71, 227, 458)" opacity="0.86"></rect>
                    <rect width="130" height="3" x="-23" y="745.5" rx="1.5" transform="rotate(71, 42, 747)" opacity="0.15"></rect>
                    <rect width="129" height="3" x="22.5" y="583.5" rx="1.5" transform="rotate(71, 87, 585)" opacity="0.19"></rect>
                    <rect width="276" height="3" x="583" y="427.5" rx="1.5" transform="rotate(71, 721, 429)" opacity="0.43"></rect>
                    <rect width="96" height="3" x="115" y="336.5" rx="1.5" transform="rotate(71, 163, 338)" opacity="0.81"></rect>
                    <rect width="88" height="3" x="352" y="125.5" rx="1.5" transform="rotate(71, 396, 127)" opacity="0.11"></rect>
                    <rect width="182" height="3" x="651" y="71.5" rx="1.5" transform="rotate(71, 742, 73)" opacity="0.63"></rect>
                    <rect width="126" height="3" x="137" y="694.5" rx="1.5" transform="rotate(71, 200, 696)" opacity="0.91"></rect>
                    <rect width="163" height="3" x="511.5" y="229.5" rx="1.5" transform="rotate(71, 593, 231)" opacity="0.58"></rect>
                    <rect width="101" height="3" x="447.5" y="615.5" rx="1.5" transform="rotate(71, 498, 617)" opacity="0.79"></rect>
                    <rect width="254" height="3" x="589" y="717.5" rx="1.5" transform="rotate(71, 716, 719)" opacity="0.41"></rect>
                    <rect width="190" height="3" x="639" y="265.5" rx="1.5" transform="rotate(71, 734, 267)" opacity="0.79"></rect>
                    <rect width="113" height="3" x="302.5" y="753.5" rx="1.5" transform="rotate(71, 359, 755)" opacity="0.41"></rect>
                    <rect width="54" height="3" x="148" y="560.5" rx="1.5" transform="rotate(71, 175, 562)" opacity="0.29"></rect>
                    <rect width="142" height="3" x="261" y="405.5" rx="1.5" transform="rotate(71, 332, 407)" opacity="0.37"></rect>
                    <rect width="194" height="3" x="-49" y="503.5" rx="1.5" transform="rotate(71, 48, 505)" opacity="0.42"></rect>
                    <rect width="78" height="3" x="211" y="755.5" rx="1.5" transform="rotate(71, 250, 757)" opacity="0.36"></rect>
                    <rect width="41" height="3" x="102.5" y="656.5" rx="1.5" transform="rotate(71, 123, 658)" opacity="0.18"></rect>
                    <rect width="117" height="3" x="265.5" y="63.5" rx="1.5" transform="rotate(71, 324, 65)" opacity="0.79"></rect>
                    <rect width="146" height="3" x="253" y="205.5" rx="1.5" transform="rotate(71, 326, 207)" opacity="0.12"></rect>
                    <rect width="103" height="3" x="414.5" y="39.5" rx="1.5" transform="rotate(71, 466, 41)" opacity="0.41"></rect>
                    <rect width="153" height="3" x="319.5" y="682.5" rx="1.5" transform="rotate(71, 396, 684)" opacity="0.87"></rect>
                    <rect width="163" height="3" x="-11.5" y="59.5" rx="1.5" transform="rotate(71, 70, 61)" opacity="0.27"></rect>
                </g>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" class="wave" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs" viewBox="0 0 800 800">
                <defs>
                    <linearGradient x1="50%" y1="0%" x2="50%" y2="100%" id="ffflurry-grad" gradientTransform="rotate(270)">
                        <stop stop-color="#ffffff" stop-opacity="1" offset="0%"></stop>
                        <stop stop-color="hsl(263, 100%, 50%)" stop-opacity="1" offset="45%"></stop>
                        <stop stop-color="hsl(204, 100%, 50%)" stop-opacity="1" offset="100%"></stop>
                    </linearGradient>
                </defs>
                <rect width="100%" height="100%"></rect>
                <g fill="url(#ffflurry-grad)">
                    <rect width="136" height="3" x="346" y="490.5" rx="1.5" transform="rotate(71, 414, 492)" opacity="0.42"></rect>
                    <rect width="152" height="3" x="458" y="483.5" rx="1.5" transform="rotate(71, 534, 485)" opacity="0.69"></rect>
                    <rect width="54" height="3" x="632" y="148.5" rx="1.5" transform="rotate(71, 659, 150)" opacity="0.92"></rect>
                    <rect width="81" height="3" x="434.5" y="246.5" rx="1.5" transform="rotate(71, 475, 248)" opacity="0.77"></rect>
                    <rect width="166" height="3" x="496" y="361.5" rx="1.5" transform="rotate(71, 579, 363)" opacity="0.74"></rect>
                    <rect width="120" height="3" x="365" y="342.5" rx="1.5" transform="rotate(71, 425, 344)" opacity="0.23"></rect>
                    <rect width="110" height="3" x="-24" y="636.5" rx="1.5" transform="rotate(71, 31, 638)" opacity="0.73"></rect>
                    <rect width="206" height="3" x="495" y="52.5" rx="1.5" transform="rotate(71, 598, 54)" opacity="0.59"></rect>
                    <rect width="126" height="3" x="-11" y="273.5" rx="1.5" transform="rotate(71, 52, 275)" opacity="0.27"></rect>
                    <rect width="66" height="3" x="465" y="141.5" rx="1.5" transform="rotate(71, 498, 143)" opacity="0.88"></rect>
                    <rect width="125" height="3" x="267.5" y="592.5" rx="1.5" transform="rotate(71, 330, 594)" opacity="0.80"></rect>
                    <rect width="192" height="3" x="31" y="439.5" rx="1.5" transform="rotate(71, 127, 441)" opacity="0.87"></rect>
                    <rect width="77" height="3" x="91.5" y="750.5" rx="1.5" transform="rotate(71, 130, 752)" opacity="0.49"></rect>
                    <rect width="167" height="3" x="320.5" y="595.5" rx="1.5" transform="rotate(71, 404, 597)" opacity="0.48"></rect>
                    <rect width="86" height="3" x="154" y="123.5" rx="1.5" transform="rotate(71, 197, 125)" opacity="0.70"></rect>
                    <rect width="199" height="3" x="612.5" y="557.5" rx="1.5" transform="rotate(71, 712, 559)" opacity="0.96"></rect>
                    <rect width="143" height="3" x="458.5" y="740.5" rx="1.5" transform="rotate(71, 530, 742)" opacity="0.46"></rect>
                    <rect width="177" height="3" x="-13.5" y="177.5" rx="1.5" transform="rotate(71, 75, 179)" opacity="0.45"></rect>
                    <rect width="160" height="3" x="-35" y="379.5" rx="1.5" transform="rotate(71, 45, 381)" opacity="0.49"></rect>
                    <rect width="67" height="3" x="229.5" y="634.5" rx="1.5" transform="rotate(71, 263, 636)" opacity="0.30"></rect>
                    <rect width="68" height="3" x="162" y="228.5" rx="1.5" transform="rotate(71, 196, 230)" opacity="0.29"></rect>
                    <rect width="58" height="3" x="190" y="35.5" rx="1.5" transform="rotate(71, 219, 37)" opacity="0.47"></rect>
                    <rect width="53" height="3" x="578.5" y="612.5" rx="1.5" transform="rotate(71, 605, 614)" opacity="0.60"></rect>
                    <rect width="68" height="3" x="246" y="311.5" rx="1.5" transform="rotate(71, 280, 313)" opacity="0.24"></rect>
                    <rect width="81" height="3" x="255.5" y="519.5" rx="1.5" transform="rotate(71, 296, 521)" opacity="0.57"></rect>
                    <rect width="71" height="3" x="191.5" y="456.5" rx="1.5" transform="rotate(71, 227, 458)" opacity="0.86"></rect>
                    <rect width="130" height="3" x="-23" y="745.5" rx="1.5" transform="rotate(71, 42, 747)" opacity="0.15"></rect>
                    <rect width="129" height="3" x="22.5" y="583.5" rx="1.5" transform="rotate(71, 87, 585)" opacity="0.19"></rect>
                    <rect width="276" height="3" x="583" y="427.5" rx="1.5" transform="rotate(71, 721, 429)" opacity="0.43"></rect>
                    <rect width="96" height="3" x="115" y="336.5" rx="1.5" transform="rotate(71, 163, 338)" opacity="0.81"></rect>
                    <rect width="88" height="3" x="352" y="125.5" rx="1.5" transform="rotate(71, 396, 127)" opacity="0.11"></rect>
                    <rect width="182" height="3" x="651" y="71.5" rx="1.5" transform="rotate(71, 742, 73)" opacity="0.63"></rect>
                    <rect width="126" height="3" x="137" y="694.5" rx="1.5" transform="rotate(71, 200, 696)" opacity="0.91"></rect>
                    <rect width="163" height="3" x="511.5" y="229.5" rx="1.5" transform="rotate(71, 593, 231)" opacity="0.58"></rect>
                    <rect width="101" height="3" x="447.5" y="615.5" rx="1.5" transform="rotate(71, 498, 617)" opacity="0.79"></rect>
                    <rect width="254" height="3" x="589" y="717.5" rx="1.5" transform="rotate(71, 716, 719)" opacity="0.41"></rect>
                    <rect width="190" height="3" x="639" y="265.5" rx="1.5" transform="rotate(71, 734, 267)" opacity="0.79"></rect>
                    <rect width="113" height="3" x="302.5" y="753.5" rx="1.5" transform="rotate(71, 359, 755)" opacity="0.41"></rect>
                    <rect width="54" height="3" x="148" y="560.5" rx="1.5" transform="rotate(71, 175, 562)" opacity="0.29"></rect>
                    <rect width="142" height="3" x="261" y="405.5" rx="1.5" transform="rotate(71, 332, 407)" opacity="0.37"></rect>
                    <rect width="194" height="3" x="-49" y="503.5" rx="1.5" transform="rotate(71, 48, 505)" opacity="0.42"></rect>
                    <rect width="78" height="3" x="211" y="755.5" rx="1.5" transform="rotate(71, 250, 757)" opacity="0.36"></rect>
                    <rect width="41" height="3" x="102.5" y="656.5" rx="1.5" transform="rotate(71, 123, 658)" opacity="0.18"></rect>
                    <rect width="117" height="3" x="265.5" y="63.5" rx="1.5" transform="rotate(71, 324, 65)" opacity="0.79"></rect>
                    <rect width="146" height="3" x="253" y="205.5" rx="1.5" transform="rotate(71, 326, 207)" opacity="0.12"></rect>
                    <rect width="103" height="3" x="414.5" y="39.5" rx="1.5" transform="rotate(71, 466, 41)" opacity="0.41"></rect>
                    <rect width="153" height="3" x="319.5" y="682.5" rx="1.5" transform="rotate(71, 396, 684)" opacity="0.87"></rect>
                    <rect width="163" height="3" x="-11.5" y="59.5" rx="1.5" transform="rotate(71, 70, 61)" opacity="0.27"></rect>
                </g>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" class="wave" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs" viewBox="0 0 800 800">
                <defs>
                    <linearGradient x1="50%" y1="0%" x2="50%" y2="100%" id="ffflurry-grad" gradientTransform="rotate(270)">
                        <stop stop-color="#ffffff" stop-opacity="1" offset="0%"></stop>
                        <stop stop-color="hsl(263, 100%, 50%)" stop-opacity="1" offset="45%"></stop>
                        <stop stop-color="hsl(204, 100%, 50%)" stop-opacity="1" offset="100%"></stop>
                    </linearGradient>
                </defs>
                <rect width="100%" height="100%"></rect>
                <g fill="url(#ffflurry-grad)">
                    <rect width="136" height="3" x="346" y="490.5" rx="1.5" transform="rotate(71, 414, 492)" opacity="0.42"></rect>
                    <rect width="152" height="3" x="458" y="483.5" rx="1.5" transform="rotate(71, 534, 485)" opacity="0.69"></rect>
                    <rect width="54" height="3" x="632" y="148.5" rx="1.5" transform="rotate(71, 659, 150)" opacity="0.92"></rect>
                    <rect width="81" height="3" x="434.5" y="246.5" rx="1.5" transform="rotate(71, 475, 248)" opacity="0.77"></rect>
                    <rect width="166" height="3" x="496" y="361.5" rx="1.5" transform="rotate(71, 579, 363)" opacity="0.74"></rect>
                    <rect width="120" height="3" x="365" y="342.5" rx="1.5" transform="rotate(71, 425, 344)" opacity="0.23"></rect>
                    <rect width="110" height="3" x="-24" y="636.5" rx="1.5" transform="rotate(71, 31, 638)" opacity="0.73"></rect>
                    <rect width="206" height="3" x="495" y="52.5" rx="1.5" transform="rotate(71, 598, 54)" opacity="0.59"></rect>
                    <rect width="126" height="3" x="-11" y="273.5" rx="1.5" transform="rotate(71, 52, 275)" opacity="0.27"></rect>
                    <rect width="66" height="3" x="465" y="141.5" rx="1.5" transform="rotate(71, 498, 143)" opacity="0.88"></rect>
                    <rect width="125" height="3" x="267.5" y="592.5" rx="1.5" transform="rotate(71, 330, 594)" opacity="0.80"></rect>
                    <rect width="192" height="3" x="31" y="439.5" rx="1.5" transform="rotate(71, 127, 441)" opacity="0.87"></rect>
                    <rect width="77" height="3" x="91.5" y="750.5" rx="1.5" transform="rotate(71, 130, 752)" opacity="0.49"></rect>
                    <rect width="167" height="3" x="320.5" y="595.5" rx="1.5" transform="rotate(71, 404, 597)" opacity="0.48"></rect>
                    <rect width="86" height="3" x="154" y="123.5" rx="1.5" transform="rotate(71, 197, 125)" opacity="0.70"></rect>
                    <rect width="199" height="3" x="612.5" y="557.5" rx="1.5" transform="rotate(71, 712, 559)" opacity="0.96"></rect>
                    <rect width="143" height="3" x="458.5" y="740.5" rx="1.5" transform="rotate(71, 530, 742)" opacity="0.46"></rect>
                    <rect width="177" height="3" x="-13.5" y="177.5" rx="1.5" transform="rotate(71, 75, 179)" opacity="0.45"></rect>
                    <rect width="160" height="3" x="-35" y="379.5" rx="1.5" transform="rotate(71, 45, 381)" opacity="0.49"></rect>
                    <rect width="67" height="3" x="229.5" y="634.5" rx="1.5" transform="rotate(71, 263, 636)" opacity="0.30"></rect>
                    <rect width="68" height="3" x="162" y="228.5" rx="1.5" transform="rotate(71, 196, 230)" opacity="0.29"></rect>
                    <rect width="58" height="3" x="190" y="35.5" rx="1.5" transform="rotate(71, 219, 37)" opacity="0.47"></rect>
                    <rect width="53" height="3" x="578.5" y="612.5" rx="1.5" transform="rotate(71, 605, 614)" opacity="0.60"></rect>
                    <rect width="68" height="3" x="246" y="311.5" rx="1.5" transform="rotate(71, 280, 313)" opacity="0.24"></rect>
                    <rect width="81" height="3" x="255.5" y="519.5" rx="1.5" transform="rotate(71, 296, 521)" opacity="0.57"></rect>
                    <rect width="71" height="3" x="191.5" y="456.5" rx="1.5" transform="rotate(71, 227, 458)" opacity="0.86"></rect>
                    <rect width="130" height="3" x="-23" y="745.5" rx="1.5" transform="rotate(71, 42, 747)" opacity="0.15"></rect>
                    <rect width="129" height="3" x="22.5" y="583.5" rx="1.5" transform="rotate(71, 87, 585)" opacity="0.19"></rect>
                    <rect width="276" height="3" x="583" y="427.5" rx="1.5" transform="rotate(71, 721, 429)" opacity="0.43"></rect>
                    <rect width="96" height="3" x="115" y="336.5" rx="1.5" transform="rotate(71, 163, 338)" opacity="0.81"></rect>
                    <rect width="88" height="3" x="352" y="125.5" rx="1.5" transform="rotate(71, 396, 127)" opacity="0.11"></rect>
                    <rect width="182" height="3" x="651" y="71.5" rx="1.5" transform="rotate(71, 742, 73)" opacity="0.63"></rect>
                    <rect width="126" height="3" x="137" y="694.5" rx="1.5" transform="rotate(71, 200, 696)" opacity="0.91"></rect>
                    <rect width="163" height="3" x="511.5" y="229.5" rx="1.5" transform="rotate(71, 593, 231)" opacity="0.58"></rect>
                    <rect width="101" height="3" x="447.5" y="615.5" rx="1.5" transform="rotate(71, 498, 617)" opacity="0.79"></rect>
                    <rect width="254" height="3" x="589" y="717.5" rx="1.5" transform="rotate(71, 716, 719)" opacity="0.41"></rect>
                    <rect width="190" height="3" x="639" y="265.5" rx="1.5" transform="rotate(71, 734, 267)" opacity="0.79"></rect>
                    <rect width="113" height="3" x="302.5" y="753.5" rx="1.5" transform="rotate(71, 359, 755)" opacity="0.41"></rect>
                    <rect width="54" height="3" x="148" y="560.5" rx="1.5" transform="rotate(71, 175, 562)" opacity="0.29"></rect>
                    <rect width="142" height="3" x="261" y="405.5" rx="1.5" transform="rotate(71, 332, 407)" opacity="0.37"></rect>
                    <rect width="194" height="3" x="-49" y="503.5" rx="1.5" transform="rotate(71, 48, 505)" opacity="0.42"></rect>
                    <rect width="78" height="3" x="211" y="755.5" rx="1.5" transform="rotate(71, 250, 757)" opacity="0.36"></rect>
                    <rect width="41" height="3" x="102.5" y="656.5" rx="1.5" transform="rotate(71, 123, 658)" opacity="0.18"></rect>
                    <rect width="117" height="3" x="265.5" y="63.5" rx="1.5" transform="rotate(71, 324, 65)" opacity="0.79"></rect>
                    <rect width="146" height="3" x="253" y="205.5" rx="1.5" transform="rotate(71, 326, 207)" opacity="0.12"></rect>
                    <rect width="103" height="3" x="414.5" y="39.5" rx="1.5" transform="rotate(71, 466, 41)" opacity="0.41"></rect>
                    <rect width="153" height="3" x="319.5" y="682.5" rx="1.5" transform="rotate(71, 396, 684)" opacity="0.87"></rect>
                    <rect width="163" height="3" x="-11.5" y="59.5" rx="1.5" transform="rotate(71, 70, 61)" opacity="0.27"></rect>
                </g>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" class="wave" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs" viewBox="0 0 800 800">
                <defs>
                    <linearGradient x1="50%" y1="0%" x2="50%" y2="100%" id="ffflurry-grad" gradientTransform="rotate(270)">
                        <stop stop-color="#ffffff" stop-opacity="1" offset="0%"></stop>
                        <stop stop-color="hsl(263, 100%, 50%)" stop-opacity="1" offset="45%"></stop>
                        <stop stop-color="hsl(204, 100%, 50%)" stop-opacity="1" offset="100%"></stop>
                    </linearGradient>
                </defs>
                <rect width="100%" height="100%"></rect>
                <g fill="url(#ffflurry-grad)">
                    <rect width="136" height="3" x="346" y="490.5" rx="1.5" transform="rotate(71, 414, 492)" opacity="0.42"></rect>
                    <rect width="152" height="3" x="458" y="483.5" rx="1.5" transform="rotate(71, 534, 485)" opacity="0.69"></rect>
                    <rect width="54" height="3" x="632" y="148.5" rx="1.5" transform="rotate(71, 659, 150)" opacity="0.92"></rect>
                    <rect width="81" height="3" x="434.5" y="246.5" rx="1.5" transform="rotate(71, 475, 248)" opacity="0.77"></rect>
                    <rect width="166" height="3" x="496" y="361.5" rx="1.5" transform="rotate(71, 579, 363)" opacity="0.74"></rect>
                    <rect width="120" height="3" x="365" y="342.5" rx="1.5" transform="rotate(71, 425, 344)" opacity="0.23"></rect>
                    <rect width="110" height="3" x="-24" y="636.5" rx="1.5" transform="rotate(71, 31, 638)" opacity="0.73"></rect>
                    <rect width="206" height="3" x="495" y="52.5" rx="1.5" transform="rotate(71, 598, 54)" opacity="0.59"></rect>
                    <rect width="126" height="3" x="-11" y="273.5" rx="1.5" transform="rotate(71, 52, 275)" opacity="0.27"></rect>
                    <rect width="66" height="3" x="465" y="141.5" rx="1.5" transform="rotate(71, 498, 143)" opacity="0.88"></rect>
                    <rect width="125" height="3" x="267.5" y="592.5" rx="1.5" transform="rotate(71, 330, 594)" opacity="0.80"></rect>
                    <rect width="192" height="3" x="31" y="439.5" rx="1.5" transform="rotate(71, 127, 441)" opacity="0.87"></rect>
                    <rect width="77" height="3" x="91.5" y="750.5" rx="1.5" transform="rotate(71, 130, 752)" opacity="0.49"></rect>
                    <rect width="167" height="3" x="320.5" y="595.5" rx="1.5" transform="rotate(71, 404, 597)" opacity="0.48"></rect>
                    <rect width="86" height="3" x="154" y="123.5" rx="1.5" transform="rotate(71, 197, 125)" opacity="0.70"></rect>
                    <rect width="199" height="3" x="612.5" y="557.5" rx="1.5" transform="rotate(71, 712, 559)" opacity="0.96"></rect>
                    <rect width="143" height="3" x="458.5" y="740.5" rx="1.5" transform="rotate(71, 530, 742)" opacity="0.46"></rect>
                    <rect width="177" height="3" x="-13.5" y="177.5" rx="1.5" transform="rotate(71, 75, 179)" opacity="0.45"></rect>
                    <rect width="160" height="3" x="-35" y="379.5" rx="1.5" transform="rotate(71, 45, 381)" opacity="0.49"></rect>
                    <rect width="67" height="3" x="229.5" y="634.5" rx="1.5" transform="rotate(71, 263, 636)" opacity="0.30"></rect>
                    <rect width="68" height="3" x="162" y="228.5" rx="1.5" transform="rotate(71, 196, 230)" opacity="0.29"></rect>
                    <rect width="58" height="3" x="190" y="35.5" rx="1.5" transform="rotate(71, 219, 37)" opacity="0.47"></rect>
                    <rect width="53" height="3" x="578.5" y="612.5" rx="1.5" transform="rotate(71, 605, 614)" opacity="0.60"></rect>
                    <rect width="68" height="3" x="246" y="311.5" rx="1.5" transform="rotate(71, 280, 313)" opacity="0.24"></rect>
                    <rect width="81" height="3" x="255.5" y="519.5" rx="1.5" transform="rotate(71, 296, 521)" opacity="0.57"></rect>
                    <rect width="71" height="3" x="191.5" y="456.5" rx="1.5" transform="rotate(71, 227, 458)" opacity="0.86"></rect>
                    <rect width="130" height="3" x="-23" y="745.5" rx="1.5" transform="rotate(71, 42, 747)" opacity="0.15"></rect>
                    <rect width="129" height="3" x="22.5" y="583.5" rx="1.5" transform="rotate(71, 87, 585)" opacity="0.19"></rect>
                    <rect width="276" height="3" x="583" y="427.5" rx="1.5" transform="rotate(71, 721, 429)" opacity="0.43"></rect>
                    <rect width="96" height="3" x="115" y="336.5" rx="1.5" transform="rotate(71, 163, 338)" opacity="0.81"></rect>
                    <rect width="88" height="3" x="352" y="125.5" rx="1.5" transform="rotate(71, 396, 127)" opacity="0.11"></rect>
                    <rect width="182" height="3" x="651" y="71.5" rx="1.5" transform="rotate(71, 742, 73)" opacity="0.63"></rect>
                    <rect width="126" height="3" x="137" y="694.5" rx="1.5" transform="rotate(71, 200, 696)" opacity="0.91"></rect>
                    <rect width="163" height="3" x="511.5" y="229.5" rx="1.5" transform="rotate(71, 593, 231)" opacity="0.58"></rect>
                    <rect width="101" height="3" x="447.5" y="615.5" rx="1.5" transform="rotate(71, 498, 617)" opacity="0.79"></rect>
                    <rect width="254" height="3" x="589" y="717.5" rx="1.5" transform="rotate(71, 716, 719)" opacity="0.41"></rect>
                    <rect width="190" height="3" x="639" y="265.5" rx="1.5" transform="rotate(71, 734, 267)" opacity="0.79"></rect>
                    <rect width="113" height="3" x="302.5" y="753.5" rx="1.5" transform="rotate(71, 359, 755)" opacity="0.41"></rect>
                    <rect width="54" height="3" x="148" y="560.5" rx="1.5" transform="rotate(71, 175, 562)" opacity="0.29"></rect>
                    <rect width="142" height="3" x="261" y="405.5" rx="1.5" transform="rotate(71, 332, 407)" opacity="0.37"></rect>
                    <rect width="194" height="3" x="-49" y="503.5" rx="1.5" transform="rotate(71, 48, 505)" opacity="0.42"></rect>
                    <rect width="78" height="3" x="211" y="755.5" rx="1.5" transform="rotate(71, 250, 757)" opacity="0.36"></rect>
                    <rect width="41" height="3" x="102.5" y="656.5" rx="1.5" transform="rotate(71, 123, 658)" opacity="0.18"></rect>
                    <rect width="117" height="3" x="265.5" y="63.5" rx="1.5" transform="rotate(71, 324, 65)" opacity="0.79"></rect>
                    <rect width="146" height="3" x="253" y="205.5" rx="1.5" transform="rotate(71, 326, 207)" opacity="0.12"></rect>
                    <rect width="103" height="3" x="414.5" y="39.5" rx="1.5" transform="rotate(71, 466, 41)" opacity="0.41"></rect>
                    <rect width="153" height="3" x="319.5" y="682.5" rx="1.5" transform="rotate(71, 396, 684)" opacity="0.87"></rect>
                    <rect width="163" height="3" x="-11.5" y="59.5" rx="1.5" transform="rotate(71, 70, 61)" opacity="0.27"></rect>
                </g>
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