<div>
    <div  id="tipologias" wire:ignore.self  tabindex="-1" aria-hidden="true"
        class="hidden  overflow-y-auto overflow-x-hidden fixed rounded-3xl  top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full ">
            <!-- Modal content -->
            <div class="relative bg-white rounded-3xl shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 rounded-3xl  dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        AGREGAR TIPOLOGIA
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-lg w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="tipologias">
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
                        <div class="grid gap-4 mb-4 grid-cols-1 sm:grid-cols-1 md:grid-cols-1">

                            <div class="col-span-2 sm:col-span-1">
                                <div class="relative">
                                    <input type="text" id="floating_outlined" wire:model="nombre_uni"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-lg text-gray-900 bg-transparent rounded-xl border-1 border-purple-700 appearance-none dark:text-white dark:border-purple-700  dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-purple-700  peer"
                                        placeholder=" " />
                                        
                                    <label for="floating_outlined"
                                        class="absolute text-lg text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-purple-700  peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 rounded-xl">Nombre
                                        Unidad</label>
                                </div>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <div class="relative">
                                    <input type="text" id="floating_outlined" wire:model="abreviatura"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-lg text-gray-900 bg-transparent rounded-xl border-1 border-purple-700 appearance-none dark:text-white dark:border-purple-700  dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-purple-700  peer"
                                        placeholder=" " />
                                    <label for="floating_outlined" 
                                        class="absolute text-lg text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-purple-700  peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 rounded-xl">Abreviatura</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center justify-end p-4 md:p-5  border-gray-200 rounded-b dark:border-gray-600">
                    <button type="button"
                        class="text-white bg-gradient-to-r from-blue-800 via-blue-800 to-blue-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-600 font-medium rounded text-lg px-5 py-2.5 text-center me-2 mb-2"
                        data-modal-hide="tipologias">CERRAR</button>
                    <button type="button" wire:click='guardarTipologia'  data-modal-hide="tipologias"
                        class="text-white bg-gradient-to-r from-purple-800 via-purple-800 to-purple-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium hover:text-white rounded text-lg px-5 py-2.5 text-center me-2 mb-2">
                        GUARDAR
                    </button>

                </div>
            </div>
        </div>
    </div>



    <div id="editipologia" wire:ignore.self tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed rounded-3xl top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-3xl shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 rounded-3xl dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        EDITAR TIPOLOGIA / {{ $id }}
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-lg w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="editipologia">
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
                        <div class="grid gap-4 mb-4 grid-cols-1 sm:grid-cols-1 md:grid-cols-1">
                            <div class="col-span-2 sm:col-span-1">
                                <div class="relative">
                                    <input type="text" id="nombre_uni" wire:model="nombre_uni"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-lg text-gray-900 bg-transparent rounded-xl border-1 border-purple-700 appearance-none dark:text-white dark:border-purple-700 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-purple-700 peer"
                                        placeholder=" " />
                                    <label for="nombre_uni"
                                        class="absolute text-lg text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-purple-700 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 rounded-xl">Nombre
                                        Unidad</label>
                                </div>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <div class="relative">
                                    <input type="text" id="abreviatura" wire:model="abreviatura"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-lg text-gray-900 bg-transparent rounded-xl border-1 border-purple-700 appearance-none dark:text-white dark:border-purple-700 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-purple-700 peer"
                                        placeholder=" " />
                                    <label for="abreviatura"
                                        class="absolute text-lg text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-purple-700 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 rounded-xl">Abreviatura</label>
                                </div>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <div class="relative">
                                    <select id="estatus" wire:model="estatus"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-md text-gray-900 bg-transparent rounded-xl border-1 border-purple-700 appearance-none dark:text-white dark:border-purple-700 dark:focus:border-purple-700 focus:outline-none focus:ring-0 focus:border-purple-700 peer"
                                        placeholder="">
                                        <option value="ACTIVO">ACTIVO</option>
                                        <option value="INACTIVO">INACTIVO</option>
                                    </select>
                                    <label for="estatus"
                                        class="absolute text-lg text-purple-700 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-purple-700 px-2 peer-focus:px-2 peer-focus:text-purple-700 peer-focus:dark:text-purple-700 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 rounded-xl">Estatus</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center justify-end p-4 md:p-5 border-gray-200 rounded-b dark:border-gray-600">
                    <button type="button"
                        class="text-white bg-gradient-to-r from-blue-800 via-blue-800 to-blue-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-600 font-medium rounded text-lg px-5 py-2.5 text-center me-2 mb-2"
                        data-modal-hide="editipologia">CERRAR</button>
                    <button type="button" wire:click="updateTipologia" data-modal-hide="editipologia"
                        class="text-white bg-gradient-to-r from-purple-800 via-purple-800 to-purple-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium hover:text-white rounded text-lg px-5 py-2.5 text-center me-2 mb-2">
                        GUARDAR
                    </button>
                </div>
            </div>
        </div>
    </div>




</div>
