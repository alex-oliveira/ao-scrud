### SearchConfig
````
$this->search
    ->model(User::class)
    ->columns(['id', 'nickname'])
    ->otherColumns(['name', 'email', 'created_at', 'updated_at'])
    ->orders(['id', 'name', 'nickname', 'email', 'created_at', 'updated_at'])
    -with([
        'status',
        'accounts' => '*',
        'contacts' => ['id', 'fone']
        'requests' => [
            'columns' => ['id', 'status'] // OR 'id,status'
            'otherColumns' => ['description', 'created_at', 'updated_at'] // OR 'description,created_at,updated_at'
        ]
    ])
    ->rules([
        ['id' => '='],
        ['email' => '%like%'],
        ['name' => '%like%|get:search'],
        ['nickname' => '%like%|get:search']
    ]);
````

### CreateConfig
````
$this->create
    ->model(User::class)
    ->columns(['name', 'nickname', 'email'])
    -with([
            'status',
            'accounts' => '*',
            'contacts' => ['id', 'fone']
            'requests' => [
                'columns' => ['id', 'status'] // OR 'id,status'
                'otherColumns' => ['description', 'created_at', 'updated_at'] // OR 'description,created_at,updated_at'
            ]
    ])
    ->rules([
        'name' => 'required|max:100',
        'nickname' => 'required|max:50|unique:users,nickname',
        'email' => 'required|email|unique:users,email'
    ]);
````

### ReadConfig
````
$this->read
    ->model(User::class)
    ->columns(['id', 'nickname'])
    ->otherColumns(['name', 'email', 'created_at', 'updated_at']);
````

### UpdateConfig
````
$this->update
    ->model(User::class)
    ->columns(['name', 'nickname'])
    ->rules(function($config){
        return [
            'name' => 'required|max:100',
            'nickname' => 'required|max:50|unique:users,nickname,' . $config->data()->get('id')
        ]
    });
````

### DestroyConfig
````
$this->destroy
    ->model(User::class)
    ->title('usuário')
    ->block(['requests' => 'pedido', 'logs' => 'log'])
    ->dissociate(['groups', 'routes'])
    ->cascade(['accounts', 'contacts', 'files'])
    ->soft(true);
````

### RestoreConfig
````
$this->restore
    ->model(Group::class);
````

## Customizations

### Select
````
$config->select(function ($config) {
     return User::find(1);
});
````
````
$config->select(function ($config) {
     return $config->model()->find($config->data()->get('id'));
});
````

### Rules
````
$config->rules([
    'nickname' => 'required|max:50|unique:users,nickname'
]);
````
````
$config->rules(function($config){
    return [
        'nickname' => 'required|max:50|unique:users,nickname,' . $config->data()->get('id')
    ]
});
````

## Callbacks 

### OnPrepare
It is dispatched when the "prepare" is started.

````
$config->onPrepare(function ($config) {
    
});
````

### OnPrepareEnd
It is dispatched when the "prepare" is ended.

````
$config->onPrepareEnd(function ($config) {
    
})
````

### OnPrepareError
It is dispatched when happen error during the "prepare".

````
$config->onPrepareError(function ($config, $exception) {
    
})
````

### OnExecute
It is dispatched when the "execute" is started.

````
$config->onExecute(function ($config) {

})
````

### OnExecuteEnd
It is dispatched when the "execute" is ended.

````
$config->onExecuteEnd(function ($config, $result) {

});
````

### OnExecuteError
It is dispatched when happen error during the "execute".

````
$config->onExecuteError(function ($config, $exception) {

});
````

### OnSuccess
It is dispatched when all is processed without erros. 

````
$config->onSuccess(function ($config, $result) {

});
````

### OnError
It is dispatched when any error happen, since that it not has a specific error callback. 

````
$config->onError(function ($config, $exception) {

});
````