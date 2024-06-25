<x-app-layout>

@include("partials.v1.title",[
              "second_title"=>"Proveedores",
              "first_title"=>"Listado"
          ])
            @include("partials.v1.table_nav",
                   [
                       "nav_options"=>[
                              [
                              "button_align"=>"right",
                              "click_action"=>"",
                              "button_content"=>"Crear nuevo",
                              "button_icon"=>"fa-solid fa-plus",
                              "target_route"=>"supplier.list",
                              ],

                          ]
                  ])

        @include("partials.v2.table.primary-table",[
               "table_pageable"=>$table_pageable??true,
               "table_headers"=>[
              [
                   "col_name" =>"ID",
                   "col_data" =>"id",
                   "col_filter"=>false
               ],
               [
                   "col_name" =>"Nombre",
                   "col_data" =>"name",
                   "col_filter"=>false
               ],
               [
                   "col_name" =>"Apellido",
                   "col_data" =>"last_name",
                   "col_filter"=>false
               ],
               [
                   "col_name" =>"Correo electronico",
                   "col_data" =>"email",
                   "col_filter"=>false
               ],
               [
                   "col_name" =>"Telefono",
                   "col_data" =>"phonePlusIndicative",
                   "col_filter"=>false
               ],
                ],
//                 "table_actions"=>[
//
//                                    "customs"=>[
//                                                [
//                                                   "redirect"=>[
//                                                               "route"=>"v1.admin.client.detail.client",
//                                                               "binding"=>"client"
//                                                         ],
//                                                       "icon"=>"fas fa-search",
//                                                       "tooltip_title"=>"Detalles",
//                                                       "permission"=>[\App\Http\Resources\V1\Permissions::CLIENT_SHOW],
//                                                 ],
//                                                [
//                                                   "redirect"=>[
//                                                               "route"=>"v1.admin.client.edit.client",
//                                                               "binding"=>"client"
//                                                         ],
//                                                       "icon"=>"fas fa-pencil",
//                                                       "tooltip_title"=>"Editar",
//                                                       "permission"=>[\App\Http\Resources\V1\Permissions::CLIENT_EDIT],
//                                                 ],
//                                                [
//                                                   "redirect"=>[
//                                                               "route"=>"v1.admin.client.settings",
//                                                               "binding"=>"client"
//                                                         ],
//                                                       "icon"=>"fas fa-gear",
//                                                       "tooltip_title"=>"Configuración",
//                                                       "permission"=>[\App\Http\Resources\V1\Permissions::CLIENT_SETTINGS],
//                                                 ],
//
//                                                    [
//                                                        "permission"=>[\App\Http\Resources\V1\Permissions::CLIENT_SHOW_MONITORING],
//                                                        "redirect"=>[
//                                                                    "route"=>"v1.admin.client.monitoring",
//                                                                    "binding"=>"client"
//                                                              ],
//                                                            "icon"=>"fa fa-connectdevelop",
//                                                            "tooltip_title"=>"Monitoreo",
//                                                            "conditional" => "conditionalMonitoring",
//                                                    ],
//                                                    [
//                                                        "function"=>"deleteClient",
//                                                        "conditional"=>"conditionalDeleteClient",
//                                                        "icon"=>"fas fa-trash",
//                                                        "tooltip_title"=>"Eliminar",
//                                                        "permission"=>[\App\Http\Resources\V1\Permissions::CLIENT_DELETE],
//                                                ],
//                                                [
//                                                        "redirect"=>[
//                                                                    "route"=>"v1.admin.client.add.equipment",
//                                                                    "binding"=>"client"
//                                                              ],
//                                                        "icon"=>"fas fa-computer",
//                                                        "tooltip_title"=>"Agregar equipos",
//                                                        "permission"=>[\App\Http\Resources\V1\Permissions::CLIENT_ADD_EQUIPMENT],
//                                                ],
//                                                [
//                                                        "redirect"=>[
//                                                                    "route"=>"v1.admin.client.work_orders",
//                                                                    "binding"=>"client"
//                                                              ],
//                                                        "icon"=>"fas fa-hammer",
//                                                        "tooltip_title"=>"Ordenes de trabajo",
//                                                        "permission"=>[\App\Http\Resources\V1\Permissions::CLIENT_WORK_ORDER],
//                                                ],
//                                                [
//                                                        "redirect"=>[
//                                                                    "route"=>"v1.admin.client.change_equipment.historical",
//                                                                    "binding"=>"client"
//                                                              ],
//                                                        "icon"=>"fas fa-server",
//                                                        "tooltip_title"=>"Historial de cambios de equipo",
//                                                        "permission"=>[\App\Http\Resources\V1\Permissions::CLIENT_SHOW],
//                                                ],
//                                                [
//                                                        "redirect"=>[
//                                                                    "route"=>"v1.admin.client.add.alerts",
//                                                                    "binding"=>"client"
//                                                              ],
//                                                        "icon"=>"fas fa-bell",
//                                                        "tooltip_title"=>"Alertas",
//                                                        "permission"=>[\App\Http\Resources\V1\Permissions::CLIENT_SHOW_ALERTS],
//                                                ],
//                                                [
//                                                        "redirect"=>[
//                                                                    "route"=>"v1.admin.client.monitoring.control",
//                                                                    "binding"=>"client"
//                                                              ],
//                                                        "icon"=>"fas fa-toggle-on",
//                                                        "tooltip_title"=>"On/Off",
//                                                        "permission"=>[\App\Http\Resources\V1\Permissions::CLIENT_MONITORING_CONTROL],
//                                                ],
//                                                 [
//                                                        "function"=>"disableClient",
//                                                        "icon"=>"fas fa-user-xmark",
//                                                        "tooltip_title"=>"Desactivar cliente",
//                                                        "modal"=>[
//                                                                "header"=>"Desactivar cliente",
//                                                                "body"=>"Esta seguro de desactivar cliente ?",
//                                                        ],
//                                                        "permission"=>[\App\Http\Resources\V1\Permissions::CLIENT_ACTION_DISABLE],
//                                                ],
//                                                [
//                                                        "redirect"=>[
//                                                                    "route"=>"v1.admin.client.invoicing",
//                                                                    "binding"=>"client"
//                                                              ],
//                                                        "icon"=>"fas fa-money-bill",
//                                                        "tooltip_title"=>"Facturas",
//                                                        "permission"=>[\App\Http\Resources\V1\Permissions::CLIENT_SHOW_INVOICING],
//                                                ],
//                                                [
//                                                        "redirect"=>[
//                                                                    "route"=>"v1.admin.client.hand_reading",
//                                                                    "binding"=>"client"
//                                                              ],
//                                                        "icon"=>"fas fa-file-signature",
//                                                        "tooltip_title"=>"Lecturas manuales",
//                                                        "permission"=>[\App\Http\Resources\V1\Permissions::CLIENT_HAND_READING],
//                                                ],
//                                                [
//                                                        "redirect"=>[
//                                                                    "route"=>"v1.admin.client.invoice_generate",
//                                                                    "binding"=>"client"
//                                                              ],
//                                                        "icon"=>"fas fa-receipt",
//                                                        "tooltip_title"=>"Generar factura de prueba",
//                                                        "permission"=>[\App\Http\Resources\V1\Permissions::CLIENT_INVOICE_GENERATE],
//                                                ],
//                                                 [
//                                                        "redirect"=>[
//                                                                    "route"=>"v1.admin.client.manual_payment",
//                                                                    "binding"=>"client"
//                                                              ],
//                                                        "icon"=>"fas fa-dollar-sign",
//                                                        "tooltip_title"=>"Registrar pagos",
//                                                        "permission"=>[\App\Http\Resources\V1\Permissions::CLIENT_INVOICE_MANUAL_PAYMENT],
//                                                ],
//                                    ]
//                                    ],


               "table_rows"=>$data

           ])

</x-app-layout>
