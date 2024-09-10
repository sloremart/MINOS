<div>
    <div class="py-12">
       
    <div class="mb-1 pl-20 pr-20">
        @if($filter_active)
        <div class="relative z-10 flex flex-wrap gap-2 mb-4 ml-8">
            @if(($search_placeholder ?? null) != null)
            <div class="relative flex-1 min-w-[200px]">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" wire:model.live="{{$search}}" placeholder="{{$search_placeholder ?? ""}}"
                    class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-full sm:w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search for users">
            </div>
            @endif
            @if(($search_1_placeholder ?? null) != null)
            <div class="relative flex-1 min-w-[200px]">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" wire:model.live="{{$search_1}}" placeholder="{{$search_1_placeholder ?? ""}}"
                    class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-full sm:w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search for users">
            </div>
            @endif
        </div>
        
        
    @endif
        
        <div  class="w-full text-sm text-left rtl:text-right bg-gray-100 text-gray-600 dark:text-gray-400 rounded-3xl overflow-hidden  shadow-lg">
            <table class="min-w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 ">
                <thead class="text-xs text-gray-200 h-16 uppercase  dark:bg-gray-700 dark:text-gray-400" style="background:#1f68b1;">
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
    
                                        {{ $table_row->{explode(".",$table_header)[0]}->{explode(".",$table_header)[1]} }}  {{--Se usa para traer datos de una relacion user.client.name--}}
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

</div>
