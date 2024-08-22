<div>
@if($filter_active)
    <div class="absoloute z-10 flex space-x-4 mb-4 ml-8">
        @if(($search_placeholder ?? null) != null)
            <input type="text" wire:model.live="{{$search}}" placeholder="{{$search_placeholder ?? ""}}" class="px-4 py-2 border rounded">
        @endif
        @if(($search_1_placeholder ?? null) != null)
            <input type="text" wire:model.live="{{$search_1}}" placeholder="{{$search_1_placeholder ?? ""}}" class="px-4 py-2 border rounded">
        @endif

    </div>
@endif
<div class="mb-1">
    <div class="overflow-x-auto mt-5 relative z-10 max-w-6xl mx-auto">
        <table class="table-auto w-full border-collapse bg-white shadow-lg rounded-lg overflow-hidden">
            <thead class="bg-blue-900 text-gray-200 uppercase text-sm leading-normal">
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
