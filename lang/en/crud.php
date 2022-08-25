<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    '' => [
        'name' => '',
        'index_title' => 'AllPedidos List',
        'new_title' => 'New Pedidos',
        'create_title' => 'Create Pedidos',
        'edit_title' => 'Edit Pedidos',
        'show_title' => 'Show Pedidos',
        'inputs' => [
            'folio' => 'Folio',
            'destino' => 'Destino',
            'monto_solicitado' => 'Monto Solicitado',
            'plazo' => 'Plazo',
        ],
    ],

    'pedidos' => [
        'name' => 'Pedidos',
        'index_title' => ' List',
        'new_title' => 'Nuevo pedido',
        'create_title' => 'Registrar Pedido',
        'edit_title' => 'Editar',
        'show_title' => 'Mostrar',
        'inputs' => [
            'folio' => 'Folio',
            'destino' => 'Destino',
            'monto_solicitado' => 'Monto Solicitado',
            'plazo' => 'Plazo',
            'applicant_id' => 'Solicitante',
        ],
    ],

    'solicitantes' => [
        'name' => 'Solicitantes',
        'index_title' => 'Registros',
        'new_title' => 'Nuevo',
        'create_title' => 'Registrar nuevo',
        'edit_title' => 'Editar',
        'show_title' => 'Ver mas',
        'inputs' => [
            'nombre' => 'Nombre',
            'apellidos' => 'Apellidos',
            'fecha_de_nacimiento' => 'Fecha De Nacimiento',
            'sexo' => 'Sexo',
            'curp' => 'Curp',
            'correo_electronico' => 'Correo Electronico',
            'direccion' => 'Direccion',
        ],
    ],

    'ingresos' => [
        'name' => 'Ingresos',
        'index_title' => 'Ingresos List',
        'new_title' => 'New Ingreso',
        'create_title' => 'Create Ingreso',
        'edit_title' => 'Edit Ingreso',
        'show_title' => 'Show Ingreso',
        'inputs' => [
            'empresa' => 'Empresa',
            'comprobante_ingresos' => 'Comprobante Ingresos',
            'salario_bruto' => 'Salario Bruto',
            'salario_neto' => 'Salario Neto',
            'tipo_empleo' => 'Tipo Empleo',
            'fecha_contratacion' => 'Fecha Contratacion',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
