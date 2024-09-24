<div>
    <div class="py-12">
       
    <div class="mb-1 pl-20 pr-20">
        @if($filter_active)
        <div class="relative z-10 flex flex-wrap gap-2 mb-4 ml-8">
            @if(($search_2_placeholder ?? null) != null)
            <input type="text" wire:model.live="{{$search_2}}" placeholder="{{$search_2_placeholder ?? ""}}" id="search_2" name="search_2" value="{{ old('search_2') }}"class="px-4 py-2 border rounded">
        @endif
            @if(($search_placeholder ?? null) != null)
            <input type="date" wire:model.live="{{$search}}" placeholder="{{$search_placeholder ?? ""}}" id="search" name="search" value="{{ old('search') }}" class="px-4 py-2 border rounded">
        @endif
        @if(($search_1_placeholder ?? null) != null)
            <input type="date" wire:model.live="{{$search_1}}" placeholder="{{$search_1_placeholder ?? ""}}" id="search_1" name="search_1" value="{{ old('search_1') }}"class="px-4 py-2 border rounded">
        @endif
      


        <a href="#" id="exportPdfBtn" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900" target="_blank">Exportar PDF</a>
        </div>
        
        
    @endif
    
        
    <div  class="w-full text-sm text-left rtl:text-right bg-gray-100 text-gray-600 dark:text-gray-400 rounded-3xl overflow-hidden shadow-lg overflow-x-auto"> <!-- Añadido overflow-x-auto aquí -->
        <table class="min-w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 overflow-hidden whitespace-nowrap"> <!-- Añadido whitespace-nowrap aquí -->
            <thead class="text-xs text-gray-200 h-16 uppercase dark:bg-gray-700 dark:text-gray-400" style="background:#1f68b1;">
                <tr>
                    @foreach($table_headers as $header_name=>$table_header)
                        <th class="px-4 py-2 border-b">{{$header_name}}
                        </th>
                    @endforeach
                    @isset($table_actions)
                        <th class="px-4 py-2 border-b">Acciones</th>
                    @endisset
                </tr>
            </thead>
            <tbody class="text-gray-700 text-sm font-light">
            @isset($table_rows)
                @foreach($table_rows as $index=>$table_row)
                    <tr class="border-b hover:bg-blue-100">
                        @foreach($table_headers as $header_name=>$table_header)
                            <td class="px-4 py-2 border-b">
                                @if(str_contains($table_header,".") and !str_contains($table_header,"*") and ($table_row->{explode(".",$table_header)[0]} != null))
                                    {{ $table_row->{explode(".",$table_header)[0]}->{explode(".",$table_header)[1]} }}
                                @else
                                    {{ $table_row->{$table_header} }}
                                @endif
                            </td>
                        @endforeach
                        @isset($table_actions)
                            <td class="px-4 py-2 border-b flex space-x-2">
                                @foreach($table_actions as $action_type=>$action_value)
                                    @if($action_type=="edit")
                                        @include("partials.v1.table.table-action-button",[
                                                    "button_action"=>$action_value,
                                                    "button_color"=>"bg-green-500",
                                                    "button_hover"=>"bg-green-700",
                                                    "icon_color"=>"bg-green-500",
                                                    "model_id"=>$table_row->{$table_headers[array_keys($table_headers)[0]]},
                                                    "icon"=>"fas fa-pencil",
                                                    "tooltip_title"=>"Editar"
                                                ])
                                    @elseif($action_type=="delete")
                                        @include("partials.v1.table.table-action-button",[
                                                 "button_action"=>$action_value,
                                                 "button_color"=>"bg-red-500",
                                                 "button_hover"=>"bg-red-700",
                                                 "icon_color"=>"bg-red-500",
                                                 "model_id"=>$table_row->{$table_headers[array_keys($table_headers)[0]]},
                                                 "icon"=>"fas fa-trash",
                                                 "tooltip_title"=>"Eliminar"
                                             ])
                                    @elseif($action_type=="details")
                                        @include("partials.v1.table.table-action-button",[
                                                 "button_action"=>$action_value,
                                                 "button_color"=>"bg-yellow-500",
                                                 "button_hover"=>"bg-yellow-700",
                                                 "icon_color"=>"bg-yellow-500",
                                                 "model_id"=>$table_row->{$table_headers[array_keys($table_headers)[0]]},
                                                 "icon"=>"fas fa-search",
                                                 "tooltip_title"=>"Detalles"
                                             ])
                                    @elseif($action_type == "add")
                                        @include("partials.v1.table.table-action-button", [
                                            "button_action" => $action_value,
                                            "button_color" => "bg-blue-500",
                                            "button_hover" => "bg-blue-700",
                                            "icon_color" => "bg-blue-500",
                                            "model_id" => $table_row->{$table_headers[array_keys($table_headers)[0]]},
                                            "icon" => "fas fa-plus",
                                            "tooltip_title" => "Agregar"
                                        ])
                                    @elseif($action_type=="customs")
                                        @foreach($action_value  as $custom)
                                            @if(array_key_exists("conditional",$custom) and $this->{$custom["conditional"]}(isset($custom["model_id"])?$table_row->{$custom["model_id"]}:
                                                            $table_row->{$table_headers[array_keys($table_headers)[0]]}))
                                            @else
                                                @if(array_key_exists("popup",$custom))
                                                    @include("partials.v1.table.table-popup-button",[
                                                                        "icon_color"=>"secondary",
                                                                        "modal_title"=>$custom["popup"]["modal_title"],
                                                                        "view_name"=>$custom["popup"]["view_name"],
                                                                        "view_data"=>$custom["popup"]["view_data"],
                                                        ])
                                                    @continue
                                                @endif
                                                @if(array_key_exists("redirect",$custom))
                                                    @include("partials.v1.table.table-redirect-button",[
                                                            "button_route"=>$custom["redirect"]["route"],
                                                            "button_binding"=>$custom["redirect"]["binding"],
                                                            "button_color"=>$custom["button_color"],
                                                             "button_hover"=>$custom["button_hover"],
                                                             "icon_color"=>$custom["icon_color"],
                                                            "model_id"=>
                                                            (isset($custom["model_id"])?($table_row->{$custom["model_id"]}):(
                                                                (str_contains($table_headers[array_keys($table_headers)[0]],".") and !str_contains($table_headers[array_keys($table_headers)[0]],"*") and $table_row->{explode(".",$table_headers[array_keys($table_headers)[0]])[0]})?
                                                                  $table_row->{explode(".",$table_headers[array_keys($table_headers)[0]])[0]}->{explode(".",$table_headers[array_keys($table_headers)[0]])[1]}:
                                                                  $table_row->{$table_headers[array_keys($table_headers)[0]]})),
                                                            "icon"=>$custom["icon"],
                                                            "tooltip_title"=>$custom["tooltip_title"] ?? ''
                                                        ])
                                                @else
                                                    @include("partials.v1.table.table-action-button",[
                                                            "button_action"=>$custom["function"],
                                                            "icon_color"=>"secondary",
                                                             "model_id"=>
                                                              (isset($custom["model_id"])?($table_row->{$custom["model_id"]}):(
                                                                  (str_contains($table_headers[array_keys($table_headers)[0]],".") and !str_contains($table_headers[array_keys($table_headers)[0]],"*") and $table_row->{explode(".",$table_headers[array_keys($table_headers)[0]])[0]})?
                                                                    $table_row->{explode(".",$table_headers[array_keys($table_headers)[0]])[0]}->{explode(".",$table_headers[array_keys($table_headers)[0]])[1]}:
                                                                    $table_row->{$table_headers[array_keys($table_headers)[0]]})),
                                                            "icon"=>$custom["icon"],
                                                            "tooltip_title"=>$custom["tooltip_title"] ?? ''
                                                        ])
                                                @endif
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                        @endisset
                    </tr>
                @endforeach
            @endisset
            </tbody>
        </table>
    </div>
    
        @if($table_pageable??true)
            <div class="mt-4 flex justify-center">
                {{$table_rows->links("partials.v1.table.pagination-links")}}
            </div>
        @endif
        <br><br>
    </div>
    </div>
    <script>
        document.getElementById('exportPdfBtn').addEventListener('click', function (e) {
            e.preventDefault();
            
            // Obtener los valores de las fechas
            let search = document.getElementById('search').value;
            let search_1 = document.getElementById('search_1').value;
            
            // Crear la URL con los parámetros de búsqueda
            let url = '{{ route('reporte_inventario.list') }}' + '?search=' + search + '&search_1=' + search_1;
            
            // Abrir la URL en una nueva pestaña
            window.open(url, '_blank');
        });
    </script>

</div>
