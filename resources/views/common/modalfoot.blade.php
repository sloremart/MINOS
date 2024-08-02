</form>
</div>
<!-- Modal footer -->
<div class="flex items-center justify-end p-4 md:p-5  border-gray-200 rounded-b dark:border-gray-600">
    <button type="button" wire:click.prevent="resetUI"
        class="text-white bg-gradient-to-r from-blue-800 via-blue-800 to-blue-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-600 font-medium rounded text-lg px-5 py-2.5 text-center me-2 mb-2"
        data-modal-hide="tipologias">CERRAR</button>



    @if ($selected_id < 1)
        <button type="button" wire:click.prevent="Store"
            class="text-white bg-gradient-to-r from-purple-800 via-purple-800 to-purple-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium hover:text-white rounded text-lg px-5 py-2.5 text-center me-2 mb-2" >
            GUARDAR
        </button>
    @else
        <button wire:click.prevent="Update"class="text-white bg-gradient-to-r from-purple-800 via-purple-800 to-purple-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium hover:text-white rounded text-lg px-5 py-2.5 text-center me-2 mb-2" >
            EDITAR
        </button>
    @endif

</div>
</div>
</div>
</div>
