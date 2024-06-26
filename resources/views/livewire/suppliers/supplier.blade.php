<div>
    <x-app-layout>
        <div>
            @include("partials.v1.title",[
                "second_title" => "Proveedores",
                "first_title" => "Listado"
            ])

            @include("partials.v1.table_nav", [
                "nav_options" => [
                    [
                        "button_align" => "right",
                        "click_action" => "",
                        "button_content" => "Crear nuevo",
                        "button_icon" => "fa-solid fa-plus",
                        "target_route" => "supplier.list",
                    ],
                ]
            ])

            @include("partials.v2.table.primary-table",[
                "table_pageable" => $table_pageable ?? true,
                "table_headers" => [
                    [
                        "col_name" => "ID",
                        "col_data" => "id",
                        "col_filter" => false
                    ],
                    [
                        "col_name" => "Nombre",
                        "col_data" => "name",
                        "col_filter" => false
                    ],
                    [
                        "col_name" => "Apellido",
                        "col_data" => "last_name",
                        "col_filter" => false
                    ],
                    [
                        "col_name" => "Correo electronico",
                        "col_data" => "email",
                        "col_filter" => false
                    ],
                    [
                        "col_name" => "Telefono",
                        "col_data" => "phonePlusIndicative",
                        "col_filter" => false
                    ],
                ],
                "table_rows" => $data
            ])
        </div>
    </x-app-layout>
</div>
