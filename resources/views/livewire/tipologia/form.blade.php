@include('common.modalHead')
    <div class="grid gap-4 mb-4 grid-cols-1 sm:grid-cols-1 md:grid-cols-1">

        <div class="col-span-2 sm:col-span-1">
            <div class="relative">
                <input type="text" id="floating_outlined" wire:model.lazy="name"
                    class="block px-2.5 pb-2.5 pt-4 w-full text-lg text-gray-900 bg-transparent rounded-xl border-1 border-purple-700 appearance-none dark:text-white dark:border-purple-700  dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-purple-700  peer"
                    placeholder=" " />

                <label for="floating_outlined"
                    class="absolute text-lg text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-purple-700  peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 rounded-xl">Nombre
                    Unidad</label>

            </div>
            @error('name') <span class="text-danger er">{{ $message }}</span> @enderror
        </div>
        <div class="col-span-2 sm:col-span-1">
            <div class="relative">
                <input type="text" id="floating_outlined" wire:model.lazy="abreviatura"
                    class="block px-2.5 pb-2.5 pt-4 w-full text-lg text-gray-900 bg-transparent rounded-xl border-1 border-purple-700 appearance-none dark:text-white dark:border-purple-700  dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-purple-700  peer"
                    placeholder=" " />
                <label for="floating_outlined"
                    class="absolute text-lg text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-purple-700  peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 rounded-xl">Abreviatura</label>
            </div>
            @error('abreviatura') <span class="text-danger er">{{ $message }}</span> @enderror
        </div>
        <div class="col-span-2 sm:col-span-1">
            <div class="relative">
                <select id="estatus" wire:model.lazy="estatus"
                    class="block px-2.5 pb-2.5 pt-4 w-full text-md text-gray-900 bg-transparent rounded-xl border-1 border-purple-700 appearance-none dark:text-white dark:border-purple-700 dark:focus:border-purple-700 focus:outline-none focus:ring-0 focus:border-purple-700 peer"
                    placeholder="">
                    <option value="">seleccione el estado </option>
                    <option value="ACTIVO">ACTIVO</option>
                    <option value="INACTIVO">INACTIVO</option>
                </select>
                <label for="estatus"
                    class="absolute text-lg text-purple-700 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-purple-700 px-2 peer-focus:px-2 peer-focus:text-purple-700 peer-focus:dark:text-purple-700 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 rounded-xl">Estatus</label>
            </div>
           
        </div>
    </div>
@include('common.modalfoot')