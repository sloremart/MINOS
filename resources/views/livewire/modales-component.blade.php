<div>

    {{-- /////////////////////////////////////MODAL DE USUARIOS (ADNINISRADOR)\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ --}}
    <!-- Main modal -->
    <div id="default-modal" tabindex="-1" aria-hidden="true"
        class="hidden  overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-sm max-h-full ">
            <!-- Modal content -->
            <div class="relative bg-white rounded-3xl shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center   justify-between p-4 md:p-5  rounded-3xl dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-center text-gray-900 dark:text-white">
                        REGISTRO USUARIO
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-3xl text-lg w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only"></span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-2">
                    <form class="p-4 md:p-5">
                        <div class="grid gap-4 mb-0 grid-cols-1">
                            <div class="col-span-2 sm:col-span-1">
                                <div class="relative ">
                                    <input type="text" id="floating_outlined"
                                        class="block px-2.5 pb-2.5 pt-5 w-full text-lg text-gray-900 bg-transparent rounded-xl border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" " />
                                    <label for="floating_outlined"
                                        class="absolute text-lg text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-purple-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 rounded-xl">
                                        Nombre Usuario</label>
                                </div>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <div class="relative">
                                    <select id="floating_outlined"
                                        class="block px-2.5 pb-2.5 pt-5 w-full text-lg text-gray-900 bg-transparent rounded-xl border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" ">
                                        <option value="Select category">Cedula de Ciudadania</option>
                                        <option value="TV/Monitors">Tarjeta de Identidad</option>
                                        <option value="PC">Cedula extrangera</option>
                                    </select>
                                    <label for="floating_outlined"
                                        class="absolute text-lg text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-purple-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 rounded-xl">Tipo
                                        de documento</label>
                                </div>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <div class="relative">
                                    <input type="text" id="floating_outlined"
                                        class="block px-2.5 pb-2.5 pt-5 w-full text-lg text-gray-900 bg-transparent rounded-xl border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" " />
                                    <label for="floating_outlined"
                                        class="absolute text-lg text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-purple-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 rounded-xl">Numero
                                        de Identificacion</label>
                                </div>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <div class="relative">
                                    <input type="text" id="floating_outlined"
                                        class="block px-2.5 pb-2.5 pt-5 w-full text-lg text-gray-900 bg-transparent rounded-xl border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" " />
                                    <label for="floating_outlined"
                                        class="absolute text-lg text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-purple-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 rounded-xl">Teléfono
                                    </label>
                                </div>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <div class="relative">
                                    <input type="text" id="floating_outlined"
                                        class="block px-2.5 pb-2.5 pt-5 w-full text-lg text-gray-900 bg-transparent rounded-xl border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" " />
                                    <label for="floating_outlined"
                                        class="absolute text-lg text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-purple-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 rounded-xl">Email
                                    </label>
                                </div>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <div class="relative">
                                    <select id="floating_outlined"
                                        class="block px-2.5 pb-2.5 pt-5 w-full text-lg text-gray-900 bg-transparent rounded-xl border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" ">
                                        <option value="Select category">Natural</option>
                                        <option value="TV/Monitors">Juridico</option>
                                    </select>
                                    <label for="floating_outlined"
                                        class="absolute text-lg text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-purple-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 rounded-xl">Tipo
                                        de persona</label>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <!-- Modal footer -->
                <div class="flex justify-end p-4 md:p-5   rounded-b">
                    <button type="button"
                        class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded text-lg px-5 py-2.5 text-center me-2 mb-2"
                        data-modal-hide="default-modal">CERRAR</button>
                    <button type="button"
                        class="text-white bg-gradient-to-r from-purple-500 via-purple-700 to-purple-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium  hover:text-white rounded  text-lg px-5 py-2.5 text-center me-2 mb-2">GUARDAR</button>

                </div>
            </div>
        </div>
    </div>
    {{-- /////////////////////////////////////MODAL DE CLIENTES (ADNINISRADOR)\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ --}}

    <div id="registroCliente" tabindex="-1" aria-hidden="true"
        class="hidden  overflow-y-auto overflow-x-hidden fixed rounded-3xl  top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-3xl max-h-full ">
            <!-- Modal content -->
            <div class="relative bg-white rounded-3xl shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 rounded-3xl  dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        REGISTRO CLIENTE
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-lg w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="registroCliente">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only"></span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <form class="p-4 md:p-5">
                        <div class="grid gap-4 mb-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
                            <div class="col-span-2 sm:col-span-1">
                                <div class="relative ">
                                    <input type="text" id="floating_outlined"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-lg text-gray-900 bg-transparent rounded-xl border-1 border-purple-700 appearance-none dark:text-white dark:border-purple-700  dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-purple-700  peer"
                                        placeholder=" " />
                                    <label for="floating_outlined"
                                        class="absolute text-lg text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-purple-700  peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 rounded-xl">
                                        Nombre Cliente</label>
                                </div>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <div class="relative">
                                    <select id="floating_outlined"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-lg text-gray-900 bg-transparent rounded-xl border-1 border-purple-700 appearance-none dark:text-white dark:border-purple-700 dark:focus:border-purple-700 focus:outline-none focus:ring-0 focus:border-purple-700 peer"
                                        placeholder=".cedula">
                                        <option value="Select category"></option>
                                        <option value="">Cedula de Ciudadania</option>
                                        <option value="TV/Monitors">Tarjeta de Identidad</option>
                                        <option value="PC">Cedula extrangera</option>
                                    </select>
                                    <label for="floating_outlined"
                                        class="absolute text-lg text-grpurple-700dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-purple-700 px-2 peer-focus:px-2 peer-focus:text-purple-700 peer-focus:dark:text-purple-700 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 rounded-xl">Tipo
                                        de documento</label>
                                </div>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <div class="relative">
                                    <input type="text" id="floating_outlined"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-lg text-gray-900 bg-transparent rounded-xl border-1 border-purple-700 appearance-none dark:text-white dark:border-purple-700  dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-purple-700  peer"
                                        placeholder=" " />
                                    <label for="floating_outlined"
                                        class="absolute text-lg text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-purple-700  peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 rounded-xl">N°
                                        de Identificacion</label>
                                </div>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <div class="relative">
                                    <input type="text" id="floating_outlined"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-lg text-gray-900 bg-transparent rounded-xl border-1 border-purple-700 appearance-none dark:text-white dark:border-purple-700  dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-purple-700  peer"
                                        placeholder=" " />
                                    <label for="floating_outlined"
                                        class="absolute text-lg text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-purple-700  peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 rounded-xl">Teléfono
                                        Cliente
                                    </label>
                                </div>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <div class="relative">
                                    <input type="text" id="floating_outlined"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-lg text-gray-900 bg-transparent rounded-xl border-1 border-purple-700 appearance-none dark:text-white dark:border-purple-700  dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-purple-700  peer"
                                        placeholder=" " />
                                    <label for="floating_outlined"
                                        class="absolute text-lg text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-purple-700  peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 rounded-xl">Email
                                    </label>
                                </div>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <div class="relative">
                                    <input type="text" id="floating_outlined"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-lg text-gray-900 bg-transparent rounded-xl border-1 border-purple-700 appearance-none dark:text-white dark:border-purple-700  dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-purple-700  peer"
                                        placeholder=" " />
                                    <label for="floating_outlined"
                                        class="absolute text-lg text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-purple-700  peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 rounded-xl">Direccion
                                        Cliente
                                    </label>
                                </div>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <div class="relative">
                                    <select id="floating_outlined"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-lg text-gray-900 bg-transparent rounded-xl border-1 border-purple-700 appearance-none dark:text-white dark:border-purple-700  dark:focus:border-purple-700  focus:outline-none focus:ring-0 focus:border-purple-700  peer"
                                        placeholder=" ">
                                        <option value="Select category">Natural</option>
                                        <option value="TV/Monitors">Juridico</option>
                                    </select>
                                    <label for="floating_outlined"
                                        class="absolute text-lg text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-purple-700  px-2 peer-focus:px-2 peer-focus:text-purple-700  peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 rounded-xl">Tipo
                                        de persona</label>
                                </div>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <div class="relative">
                                    <input type="text" list="browsers" id="floating_outlined"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-lg text-gray-900 bg-transparent rounded-lg border-1 border-purple-700 appearance-none dark:text-white dark:border-purple-700 dark:focus:border-purple-700 cus:outline-none focus:ring-0 focus:border-purple-700 peer"
                                        placeholder=" " />
                                    <datalist id="browsers">
                                        <option value="Select category">Departamentos</option>

                                    </datalist>
                                    <label for="floating_outlined"
                                        class="absolute text-lg text-gray-700 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-purple-700px-2 peer-focus:px-2 peer-focus:text-purple-700 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Departamento</label>
                                </div>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <div class="relative">
                                    <input type="text" list="browsers" id="floating_outlined"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-lg text-gray-900 bg-transparent rounded-xl border-1 border-purple-700 appearance-none dark:text-white dark:border-gray-600 dark:focus:purple-700 focus:outline-none focus:ring-0 focus:border-purple-700 peer"
                                        placeholder=" " />
                                    <datalist id="browsers">
                                        <option value="Select category">Ciudades</option>

                                    </datalist>
                                    <label for="floating_outlined"
                                        class="absolute text-lg text-gray-700 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-purple-700 px-2 peer-focus:px-2 peer-focus:text-purple-700 peer-focus:dark:text-purple-700 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Ciudad</label>
                                </div>
                            </div>

                        </div>

                    </form>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center justify-end p-4 md:p-5  border-gray-200 rounded-b dark:border-gray-600">
                    <button type="button"
                        class="text-white bg-gradient-to-r from-purple-500 via-purple-700 to-purple-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium  hover:text-white rounded  text-lg px-5 py-2.5 text-center me-2 mb-2">GUARDAR</button>
                    <button type="button"
                        class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded text-lg px-5 py-2.5 text-center me-2 mb-2"
                        data-modal-hide="registroCliente">CERRAR</button>
                </div>
            </div>
        </div>
    </div>

    {{-- /////////////////////////////////////ARTICULOS PROVEDORE (ADMINISTRADOR)\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ --}}
    <div id="ArticuloProveedor" tabindex="-1" aria-hidden="true"
        class="hidden  overflow-y-auto overflow-x-hidden fixed rounded-3xl  top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-3xl max-h-full ">
            <!-- Modal content -->
            <div class="relative bg-white rounded-3xl shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 rounded-3xl  dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        REGISTRO ARTICULOS - PROVEEDOR
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-lg w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="ArticuloProveedor">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only"></span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <form class="p-4 md:p-5">
                        <div class="grid gap-4 mb-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-2">
                            <div class="col-span-2 sm:col-span-1">
                                <div class="relative">
                                    <select id="floating_outlined"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-lg text-gray-900 bg-transparent rounded-xl border-1 border-purple-700 appearance-none dark:text-white dark:border-purple-700 dark:focus:border-purple-700 focus:outline-none focus:ring-0 focus:border-purple-700 peer"
                                        placeholder=".cedula">
                                        <option value="Select category"></option>
                                        <option value="Aseo">Aseo</option>
                                        <option value="Alimento">Alimento</option>
                                        <option value="Bebida">Bebida</option>
                                    </select>
                                    <label for="floating_outlined"
                                        class="absolute text-lg text-grpurple-700dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-purple-700 px-2 peer-focus:px-2 peer-focus:text-purple-700 peer-focus:dark:text-purple-700 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 rounded-xl">Categorias</label>
                                </div>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <div class="relative">
                                    <input type="text" id="floating_outlined"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-lg text-gray-900 bg-transparent rounded-xl border-1 border-purple-700 appearance-none dark:text-white dark:border-purple-700  dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-purple-700  peer"
                                        placeholder=" " />
                                    <label for="floating_outlined"
                                        class="absolute text-lg text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-purple-700  peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 rounded-xl">Nombre
                                        producto</label>
                                </div>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <div class="relative">
                                    <input type="number" id="floating_outlined"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-lg text-gray-900 bg-transparent rounded-xl border-1 border-purple-700 appearance-none dark:text-white dark:border-purple-700  dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-purple-700  peer"
                                        placeholder=" " />
                                    <label for="floating_outlined"
                                        class="absolute text-lg text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-purple-700  peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 rounded-xl">Cantidad</label>
                                </div>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <div class="relative">
                                    <select id="floating_outlined"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-lg text-gray-900 bg-transparent rounded-xl border-1 border-purple-700 appearance-none dark:text-white dark:border-purple-700 dark:focus:border-purple-700 focus:outline-none focus:ring-0 focus:border-purple-700 peer"
                                        placeholder=".cedula">
                                        <option value="Select category"></option>
                                        <option value="Aseo">Litros</option>
                                        <option value="Alimento">Gramos</option>
                                        <option value="Bebida">Unidad</option>
                                        <option value="Bebida">Kilogramos</option>
                                    </select>
                                    <label for="floating_outlined"
                                        class="absolute text-lg text-grpurple-700dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-purple-700 px-2 peer-focus:px-2 peer-focus:text-purple-700 peer-focus:dark:text-purple-700 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 rounded-xl">Unidad
                                        de medida</label>
                                </div>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <div class="relative">
                                    <input type="number" id="floating_outlined"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-lg text-gray-900 bg-transparent rounded-xl border-1 border-purple-700 appearance-none dark:text-white dark:border-purple-700  dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-purple-700  peer"
                                        placeholder=" " />
                                    <label for="floating_outlined"
                                        class="absolute text-lg text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-purple-700  peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 rounded-xl">Valor
                                        unitario
                                    </label>
                                </div>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <div class="relative">
                                    <input type="number" id="floating_outlined"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-lg text-gray-900 bg-transparent rounded-xl border-1 border-purple-700 appearance-none dark:text-white dark:border-purple-700  dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-purple-700  peer"
                                        placeholder=" " />
                                    <label for="floating_outlined"
                                        class="absolute text-lg text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-purple-700  peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 rounded-xl">Valor
                                        total
                                    </label>
                                </div>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <div class="relative">
                                    <select id="floating_outlined"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-lg text-gray-900 bg-transparent rounded-xl border-1 border-purple-700 appearance-none dark:text-white dark:border-purple-700 dark:focus:border-purple-700 focus:outline-none focus:ring-0 focus:border-purple-700 peer"
                                        placeholder=".cedula">
                                        <option value="Select category">Proveedor</option>

                                    </select>
                                    <label for="floating_outlined"
                                        class="absolute text-lg text-grpurple-700dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-purple-700 px-2 peer-focus:px-2 peer-focus:text-purple-700 peer-focus:dark:text-purple-700 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 rounded-xl">Proveedor</label>
                                </div>
                            </div>


                        </div>

                    </form>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center justify-end p-4 md:p-5  border-gray-200 rounded-b dark:border-gray-600">
                    <button type="button"
                        class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded text-lg px-5 py-2.5 text-center me-2 mb-2"
                        data-modal-hide="ArticuloProveedor">CERRAR</button>
                    <button type="button"
                        class="text-white bg-gradient-to-r from-purple-500 via-purple-700 to-purple-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium  hover:text-white rounded  text-lg px-5 py-2.5 text-center me-2 mb-2">GUARDAR</button>

                </div>
            </div>
        </div>
    </div>
    {{-- /////////////////////////////////////VENTA DE PRODUCTOS (ADMINISTRADOR)\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ --}}
    <div id="venta" tabindex="-1" aria-hidden="true"
        class="hidden  overflow-y-auto overflow-x-hidden fixed rounded-3xl  top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-3xl max-h-full ">
            <!-- Modal content -->
            <div class="relative bg-white rounded-3xl shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 rounded-3xl  dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        VENTA DE PRODUCTOS
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-lg w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="venta">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only"></span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <form class="p-4 md:p-5">
                        <div class="grid gap-4 mb-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
                            <div class="col-span-2 sm:col-span-1">
                                <div class="relative">
                                    <input type="text" list="browserss" id="floating_outlined"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-lg text-gray-900 bg-transparent rounded-xl border-1 border-purple-700 appearance-none dark:text-white dark:border-gray-600 dark:focus:purple-700 focus:outline-none focus:ring-0 focus:border-purple-700 peer"
                                        placeholder=" " />
                                    <datalist id="browserss">
                                        <option value="productos">productos</option>
                                    </datalist>
                                    <label for="floating_outlined"
                                        class="absolute text-lg text-gray-700 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-purple-700 px-2 peer-focus:px-2 peer-focus:text-purple-700 peer-focus:dark:text-purple-700 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Nombre
                                        Producto</label>
                                </div>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <div class="relative">
                                    <input type="number" id="floating_outlined"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-lg text-gray-900 bg-transparent rounded-xl border-1 border-purple-700 appearance-none dark:text-white dark:border-purple-700  dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-purple-700  peer"
                                        placeholder=" " />
                                    <label for="floating_outlined"
                                        class="absolute text-lg text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-purple-700  peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 rounded-xl">Cantidad</label>
                                </div>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <div class="relative">
                                    <input type="number" id="floating_outlined"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-lg text-gray-900 bg-transparent rounded-xl border-1 border-purple-700 appearance-none dark:text-white dark:border-purple-700  dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-purple-700  peer"
                                        placeholder=" " />
                                    <label for="floating_outlined"
                                        class="absolute text-lg text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-purple-700  peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 rounded-xl">Valor
                                        Unitario</label>
                                </div>
                            </div>


                            <div class="col-span-2 sm:col-span-1">
                                <div class="relative">
                                    <input type="number" id="floating_outlined"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-lg text-gray-900 bg-transparent rounded-xl border-1 border-purple-700 appearance-none dark:text-white dark:border-purple-700  dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-purple-700  peer"
                                        placeholder=" " />
                                    <label for="floating_outlined"
                                        class="absolute text-lg text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-purple-700  peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 rounded-xl">Valor
                                        total
                                    </label>
                                </div>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <div class="relative">
                                    <select id="floating_outlined"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-lg text-gray-900 bg-transparent rounded-xl border-1 border-purple-700 appearance-none dark:text-white dark:border-purple-700 dark:focus:border-purple-700 focus:outline-none focus:ring-0 focus:border-purple-700 peer"
                                        placeholder="">
                                        <option value="T.credito">T.credito</option>
                                        <option value="T.debito">T.debito</option>
                                        <option value="Trasnferencia">Trasnferencia</option>
                                        <option value="Efectivo">Efectivo</option>

                                    </select>
                                    <label for="floating_outlined"
                                        class="absolute text-lg text-grpurple-700dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-purple-700 px-2 peer-focus:px-2 peer-focus:text-purple-700 peer-focus:dark:text-purple-700 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 rounded-xl">Forma
                                        de pago</label>
                                </div>
                            </div>
                            <div class="col-span-2 sm:col-span-1 flex items-center space-x-2">
                                <div class="relative flex-grow">
                                    <input type="text" list="browsers" id="floating_outlined"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-lg text-gray-900 bg-transparent rounded-lg border-1 border-purple-700 appearance-none dark:text-white dark:border-purple-700 dark:focus:border-purple-700 cus:outline-none focus:ring-0 focus:border-purple-700 peer"
                                        placeholder=" " />
                                    <datalist id="browsers">
                                        <option value="Select category">cliente</option>
                                    </datalist>
                                    <label for="floating_outlined"
                                        class="absolute text-lg text-gray-700 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-purple-700 px-2 peer-focus:px-2 peer-focus:text-purple-700 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Nombre
                                        Cliente</label>
                                </div>
                                <button
                                    class="px-4 py-2 text-lg font-semibold text-white bg-purple-700 rounded-lg">+</button>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <div class="relative">
                                    <select id="floating_outlined"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-lg text-gray-900 bg-transparent rounded-xl border-1 border-purple-700 appearance-none dark:text-white dark:border-purple-700 dark:focus:border-purple-700 focus:outline-none focus:ring-0 focus:border-purple-700 peer"
                                        placeholder="">
                                        <option value="19">19%</option>


                                    </select>
                                    <label for="floating_outlined"
                                        class="absolute text-lg text-grpurple-700dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-purple-700 px-2 peer-focus:px-2 peer-focus:text-purple-700 peer-focus:dark:text-purple-700 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 rounded-xl">Iva</label>
                                </div>
                            </div>
                            <div class="col-span-3 sm:col-span-2">
                                <div class="relative">
                                    <input type="text" id="floating_outlined"
                                    class="block px-2.5 pb-2.5 pt-4 w-full text-lg text-gray-900 bg-transparent rounded-xl border-1 border-purple-700 appearance-none dark:text-white dark:border-purple-700  dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-purple-700  peer"
                                    placeholder=" " />
                                <label for="floating_outlined"
                                    class="absolute text-lg text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-purple-700  peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 rounded-xl">Obsercacion
                                </label>
                                </div>
                            </div>



                        </div>

                    </form>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center justify-end p-4 md:p-5  border-gray-200 rounded-b dark:border-gray-600">
                    <button type="button"
                        class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded text-lg px-5 py-2.5 text-center me-2 mb-2"
                        data-modal-hide="venta">CERRAR</button>
                    <button type="button"
                        class="text-white bg-gradient-to-r from-purple-500 via-purple-700 to-purple-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium  hover:text-white rounded  text-lg px-5 py-2.5 text-center me-2 mb-2">GUARDAR</button>

                </div>
            </div>
        </div>
    </div>
</div>
