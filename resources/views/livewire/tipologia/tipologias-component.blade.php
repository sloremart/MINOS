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
                        <div
                            class="flex items-center  justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 bg-white dark:bg-gray-900 rounded-3xl">
                            <div>
                                <div class="inline-flex items-center rounded-3xl ">
                                    <button type="button" data-modal-target="tipologias" data-modal-toggle="tipologias"
                                        class="text-white bg-gradient-to-r from-purple-700 via-purple-700 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-700 font-medium  hover:text-white   text-lg px-5 py-5 text-center me-2 mb-2 grid place-content-cente rounded-full p-0.5" >
                                        <i class="fa-regular fa-circle-plus"></i>
                                    </button>
                                    
                                    <button
                                    class="text-white bg-gradient-to-r from-red-800 via-red-800 to-red-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium  hover:text-white   text-lg px-5 py-5 text-center me-2 mb-2 grid place-content-cente rounded-full p-0.5" >
                                        
                                            <i class="fa-solid fa-file-pdf"></i>
                                       
                                    </button>
                                    <button
                                    class="text-white bg-gradient-to-r from-green-800 via-green-800 to-green-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium  hover:text-white   text-lg px-5 py-5 text-center me-2 mb-2 grid place-content-cente rounded-full p-0.5" >
                                       
                                            <i class="fa-solid fa-file-excel"></i>
                                       
                                    </button>
                                    <button
                                    class="text-white bg-gradient-to-r from-gray-800 via-gray-800 to-gray-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:gray-green-300 dark:focus:ring-green-800 font-medium  hover:text-white   text-lg px-5 py-5 text-center me-2 mb-2 grid place-content-cente rounded-full p-0.5" >
                                            <i class="fa-solid fa-print"></i>
                                       
                                    </button>



                                </div>
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
                    </div>

                    <div
                        class="w-full text-sm text-left rtl:text-right bg-gray-100 text-gray-600 dark:text-gray-400 rounded-3xl overflow-hidden border-2  border-gray-500">
                        <div class="overflow-x-auto custom-scrollbar ">
                            <table
                                class="min-w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 ">
                                <thead
                                    class="text-xs text-gray-200 h-16 uppercase bg-gray-500 dark:bg-gray-700 dark:text-gray-400">
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
                                        <tr
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td class="px-6 py-4">{{ $tipologia->id }}</td>
                                            <td class="px-6 py-4 text-center">{{ $tipologia->nombre_uni }}</td>
                                            <td class="px-6 py-4 text-center">{{ $tipologia->abreviatura }}</td>
                                            <td class="px-6 py-4 text-center">{{ $tipologia->estatus }}</td>
                                            <td class="text-end">
                                                <div class="btn-group flex  justify-end " role="group"
                                                    aria-label="Basic example">
                                                    <div class="flex   justify-around">
                                                        <button type="button" data-modal-target="tipologias"
                                                            data-modal-toggle="tipologias"
                                                            wire:click="Edit({{ $tipologia->id }})"
                                                            class="text-white bg-gradient-to-r from-blue-700 via-blue-700 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium   hover:text-white rounded text-sm px-5 py-2.5 text-center me-2 mb-2 w-7 h-9  flex items-center justify-center">
                                                            <i class="fa-solid fa-pen-to-square text-center"></i>
                                                        </button>

                                                        <button type="button" data-modal-target="tipologias"
                                                            data-modal-toggle="tipologias"
                                                            onclick="Comfirm('{{ $tipologia->id }}')"
                                                            class="text-white bg-gradient-to-r from-blue-500 via-blue-500 to-blue-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium   hover:text-white rounded text-sm px-5 py-2.5 text-center me-2 mb-2 w-7 h-9 flex items-center justify-center">
                                                            <i class="fa-light fa-trash-can-xmark"></i>
                                                        </button>
                                                    </div>

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
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Your work has been saved",
                showConfirmButton: false,
                timer: 700
            });

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

        Swal.fire({
            title: "Estas seguro de eliminar la tipologia?",
            icon: 'warning',
            showDenyButton: true,
            // showCancelButton: true,
            confirmButtonText: "Guardar",
            denyButtonText: `Cancelar`,
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
