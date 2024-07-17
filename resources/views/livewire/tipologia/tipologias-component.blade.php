<div>
    <x-app-layout>
        {{-- <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tipologia') }}
            </h2>
        </x-slot> --}}

        <div class="py-12 rounded-3xl ">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 rounded-3xl">
                <div class="overflow-hidden  sm:rounded-lg rounded-3xl">
                    {{-- <x-welcome /> --}}
                    <div class="relative overflow-x-auto  sm:rounded-3xl p-4 rounded-3xl bg-white">
                        <div
                            class="flex items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4bg-white dark:bg-gray-900 rounded-3xl">
                            <div class="rounded-3xl">
                                <button type="button" data-modal-target="tipologias" data-modal-toggle="tipologias"
                                    class="relative inline-flex  items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-full group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                                    <span
                                        class="relative px-4  py-4 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-full group-hover:bg-opacity-0 text-purple-700 hover:text-white "
                                        style="font-size: 20px">
                                        <i class="fa-regular fa-circle-plus"></i>
                                    </span>
                                </button>
                                <button
                                    class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-full group bg-gradient-to-br from-red-600 to-red-500 group-hover:from-red-600 group-hover:to-red-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                                    <span
                                        class="relative px-4  py-4 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-full group-hover:bg-opacity-0 text-red-700 hover:text-white"
                                        style="font-size: 20px">
                                        <i class="fa-solid fa-file-pdf"></i>
                                    </span>
                                </button>
                                <button
                                    class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-full group bg-gradient-to-br from-green-600 to-green-500 group-hover:from-green-600 group-hover:to-green-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                                    <span
                                        class="relative px-4  py-4 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-full group-hover:bg-opacity-0 text-green-700 hover:text-white"
                                        style="font-size: 20px">
                                        <i class="fa-solid fa-file-excel"></i>
                                    </span>
                                </button>
                                <button
                                    class="relative inline-flex   items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-full group bg-gradient-to-br from-gray-600 to-gray-500 group-hover:from-gray-600 group-hover:to-gray-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                                    <span
                                        class="relative px-4  py-4 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-full group-hover:bg-opacity-0 text-green-700 hover:text-white"
                                        style="font-size: 20px">
                                        <i class="fa-solid fa-print"></i>
                                    </span>
                                </button>


                            </div>
                            <label for="table-search" class="sr-only">Search</label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                                <input type="text" id="table-search-users" wire:model.live="buscar"
                                    class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Search for users">
                            </div>
                        </div>
                        <div class="w-full text-sm text-left rtl:text-right bg-gray-100 text-gray-600 dark:text-gray-400 rounded-3xl overflow-hidden border-2 border-blue-700">
                            <table
                                class="w-full text-sm text-left rtl:text-right bg-gray-100 text-gray-600 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-200 h-16 uppercase bg-blue-700 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            #
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Nombre Unidad
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Abreviatura
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Estatus
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Ac
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tipologias as $tipologia)
                                        <tr
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                            <td class="px-6 py-4 ">
                                                {{ $tipologia->id }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                {{ $tipologia->nombre_uni }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                {{ $tipologia->abreviatura }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                {{ $tipologia->estatus }}
                                            </td>
                                            <td class="text-end">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button type="button"
                                                        class="btn btn-outline-secondary m-2 rounded"><i
                                                            class="fa-solid fa-pencil"></i></button>
                                                    <button type="button" class="btn btn-outline-danger m-2 rounded"><i
                                                            class="fa-solid fa-circle-xmark"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Repetir las filas necesarias -->
                                    @endforeach
                                   
                                </tbody>
                            </table>
                          
                        </div>
                        {{ $tipologias->links('livewire-pagination-links') }}
                    </div>

                </div>

            </div>
        </div>

    </x-app-layout>

    <div id="tipologias" tabindex="-1" aria-hidden="true"
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
                        class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded text-lg px-5 py-2.5 text-center me-2 mb-2"
                        data-modal-hide="tipologias">CERRAR</button>
                    <button type="button" wire:click='storetipologia'  data-modal-hide="tipologias"
                        class="text-white bg-gradient-to-r from-purple-500 via-purple-700 to-purple-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium hover:text-white rounded text-lg px-5 py-2.5 text-center me-2 mb-2">
                        GUARDAR
                    </button>

                </div>
            </div>
        </div>
    </div>

</div>
