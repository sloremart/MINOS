<div>
    <!-- {{-- <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tipologia') }}
    </h2>
    </x-slot> --}} -->
    <div class="py-12 rounded-3xl  ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 rounded-3xl ">
            <div class="overflow-hidden  sm:rounded-lg rounded-3xl p-6 ">
                <!-- {{-- <x-welcome /> --}} -->
                <div class="relative overflow-x-auto  sm:rounded-3xl p-2  shadow-lg rounded-3xl bg-white ">
                    <b>{{ $componetName }} | {{ $pageTitle }}</b>

                    <div>
                        <div class="flex items-center  justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 bg-white dark:bg-gray-900 rounded-3xl">
                            <div>
                                <div class="inline-flex items-center rounded-3xl ">
                                    <button type="button" data-modal-target="tipologias" data-modal-toggle="tipologias" class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-full group bg-gradient-to-br from-purple-800 to-purple-800 group-hover:from-purple-800 group-hover:to-purple-800 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-purple-800 dark:focus:ring-purple-800">
                                        <span class="relative px-4 py-4 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-full group-hover:bg-opacity-0 text-purple-700 hover:text-white" style="font-size: 20px">
                                            <i class="fa-regular fa-circle-plus"></i>
                                        </span>
                                    </button>
                                    <button class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-full group bg-gradient-to-br from-red-800 to-red-800 group-hover:from-red-800 group-hover:to-red-800 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-red-800 dark:focus:ring-red-800">
                                        <span class="relative px-4  py-4 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-full group-hover:bg-opacity-0 text-red-700 hover:text-white" style="font-size: 20px">
                                            <i class="fa-solid fa-file-pdf"></i>
                                        </span>
                                    </button>
                                    <button class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-full group bg-gradient-to-br from-green-600 to-green-700 group-hover:from-green-700 group-hover:to-green-700 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-green-700 dark:focus:ring-green-700">
                                        <span class="relative px-4  py-4 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-full group-hover:bg-opacity-0 text-green-700 hover:text-white" style="font-size: 20px">
                                            <i class="fa-solid fa-file-excel"></i>
                                        </span>
                                    </button>
                                    <button class="relative inline-flex   items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-full group bg-gradient-to-br from-gray-600 to-gray-500 group-hover:from-gray-600 group-hover:to-gray-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                                        <span class="relative px-4  py-4 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-full group-hover:bg-opacity-0 text-gray-700 hover:text-white" style="font-size: 20px">
                                            <i class="fa-solid fa-print"></i>
                                        </span>
                                    </button>



                                </div>
                            </div>
                            <label for="table-search" class="sr-only">Search</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                                <input type="text" id="table-search-users" wire:model.live="buscar" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for users">
                            </div>
                        </div>
                    </div>

                    <div class="w-full text-sm text-left rtl:text-right bg-gray-100 text-gray-600 dark:text-gray-400 rounded-3xl overflow-hidden border-2  border-gray-500">
                        <div class="overflow-x-auto custom-scrollbar ">
                            <table class="min-w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 ">
                                <thead class="text-xs text-gray-200 h-16 uppercase bg-gray-500 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">#</th>
                                        <th scope="col" class="px-6 py-3">Nombre Unidad</th>
                                        <th scope="col" class="px-6 py-3">Abreviatura</th>
                                        <th scope="col" class="px-6 py-3">Estatus</th>
                                        <th scope="col" class="px-6 py-3">Ac</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $tipologia)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4">{{ $tipologia->id }}</td>
                                        <td class="px-6 py-4 text-center">{{ $tipologia->nombre_uni }}</td>
                                        <td class="px-6 py-4 text-center">{{ $tipologia->abreviatura }}</td>
                                        <td class="px-6 py-4 text-center">{{ $tipologia->estatus }}</td>
                                        <td class="text-end">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" data-modal-target="tipologias" data-modal-toggle="tipologias" wire:click="Edit({{$tipologia->id}})" class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded group bg-gradient-to-br from-blue-800 to-blue-800 group-hover:from-blue-200 group-hover:ring-blue-200 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                                                    <span class="relative px-2 py-1 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded group-hover:bg-opacity-0 text-blue-800 hover:text-white" style="font-size: 15px">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </span>
                                                </button>
                                                <button onclick="Comfirm('{{ $tipologia->id }}')" class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded group bg-gradient-to-br from-blue-400 to-blue-500 group-hover:from-blue-00 group-hover:ring-blue-300 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:red-blue-300 dark:focus:ring-blue-800">
                                                    <span class="relative px-2 py-1 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded group-hover:bg-opacity-0 text-blue-800 hover:text-white" style="font-size: 15px">
                                                        <i class="fa-solid fa-circle-xmark"></i>
                                                    </span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{ $data->links('livewire-pagination-links') }}
                    {{-- {{ $data->links()}} --}}
                </div>

            </div>

        </div>
    </div>




    @include('livewire.tipologia.form')

</div>
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('show-modal', (event) => {
            $('#tipologias').modal('show');
        });
        Livewire.on('category-added', (event) => {
            let modal = document.querySelector('#tipologias')
            modal.classList.add('hidden')

            let body = document.querySelector('body')
            body.removeChild(body.lastChild)

        });
        Livewire.on('category-updated', (event) => {
            // $('#tipologias').modal('hide');
            let modal = document.querySelector('#tipologias')
            modal.classList.add('hidden')

            let body = document.querySelector('body')
            body.removeChild(body.lastChild)
        });

    });

    function Comfirm(id) {
        //     if(products > 0){

        //     Swal.fire('NO SE PUEDE ELIMINAR LA CATEGORIA POR QUE TIENE PRODUCTOS RELACIONADOS')
        //     return;
        // }
        Swal.fire({
            title: "Estas seguro de eliminar la tipologia?",
            icon: 'warning',
            showDenyButton: true,
            // showCancelButton: true,
            confirmButtonText: "Save",
            denyButtonText: `Don't save`,
            customClass: {
                popup: 'my-custom-alert',
                title: 'my-custom-title',
                confirmButton: 'my-custom-confirm-button',
                denyButton: 'my-custom-deny-button'
            }
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                window.dispatchEvent(new CustomEvent('Destroy', {
                    detail: {
                        id: id
                    }
                }));
                Swal.fire({
                    title: "Tipologia Eliminada?",
                    icon: 'success',
                    customClass: {
                        popup: 'my-custom-alert',
                        title: 'my-custom-title',
                        confirmButton: 'my-custom-confirm-button',
                        denyButton: 'my-custom-deny-button'
                    }

                });
            } else if (result.isDenied) {
                Swal.fire({
                    title: "Tipologia a Salvo?",
                    icon: 'info',
                    customClass: {
                        popup: 'my-custom-alert',
                        title: 'my-custom-title',
                        confirmButton: 'my-custom-confirm-button',
                        denyButton: 'my-custom-deny-button'
                    }

                });
            }
        });

    }
</script>