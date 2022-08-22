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

    'applicants' => [
        'name' => 'Applicants',
        'index_title' => 'Applicants List',
        'new_title' => 'New Applicant',
        'create_title' => 'Create Applicant',
        'edit_title' => 'Edit Applicant',
        'show_title' => 'Show Applicant',
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

    'incomes' => [
        'name' => 'Incomes',
        'index_title' => 'Incomes List',
        'new_title' => 'New Income',
        'create_title' => 'Create Income',
        'edit_title' => 'Edit Income',
        'show_title' => 'Show Income',
        'inputs' => [
            'empresa' => 'Empresa',
            'comprobante_ingresos' => 'Comprobante Ingresos',
            'salario_bruto' => 'Salario Bruto',
            'salario_neto' => 'Salario Neto',
            'tipo_empleo' => 'Tipo Empleo',
            'fecha_contratacion' => 'Fecha Contratacion',
            'applicant_id' => 'Applicant',
        ],
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
        ],
    ],

    'orders' => [
        'name' => 'Orders',
        'index_title' => 'Pedidos realizados',
        'new_title' => 'Nuevo pedido',
        'create_title' => 'Generar nuevo',
        'edit_title' => 'Editar pedido',
        'show_title' => 'Ver detalles',
        'inputs' => [
            'folio' => 'Folio',
            'destino' => 'Destino',
            'monto_solicitado' => 'Monto Solicitado',
            'plazo' => 'Plazo',
        ],
    ],

    'ingresos' => [
        'name' => 'Ingresos',
        'index_title' => 'Ingresos',
        'new_title' => 'Nuevo Ingreso',
        'create_title' => 'Registrar nuevo ingreso',
        'edit_title' => 'Editar ingreso',
        'show_title' => 'Detalles',
        'inputs' => [
            'empresa' => 'Empresa',
            'comprobante_ingresos' => 'Comprobante Ingresos',
            'salario_bruto' => 'Salario Bruto',
            'salario_neto' => 'Salario Neto',
            'tipo_empleo' => 'Tipo Empleo',
            'fecha_contratacion' => 'Fecha Contratacion',
        ],
    ],

    'applicant_orders' => [
        'name' => 'Applicant Orders',
        'index_title' => 'Orders List',
        'new_title' => 'New Order',
        'create_title' => 'Create Order',
        'edit_title' => 'Edit Order',
        'show_title' => 'Show Order',
        'inputs' => [
            'folio' => 'Folio',
            'destino' => 'Destino',
            'monto_solicitado' => 'Monto Solicitado',
            'plazo' => 'Plazo',
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
