# Ao-Scrud

Resources for SCRUD with Laravel 5.1

## SearchRepository
````
$rep = new SearchRepository();
$rep->model(User::class)
    ->data($data)
    ->columns(['id', 'nickname'])
    ->otherColumns(['name', 'email', 'created_at', 'updated_at'])
    ->orders(['id', 'name', 'nickname', 'email', 'created_at', 'updated_at'])
    ->rules([
        ['id' => '='],
        ['email' => '%like%'],
        ['name' => '%like%|get:search'],
        ['nickname' => '%like%|get:search']
    ]);
    
$result = $rep->run();
````

## CreateRepository
````
$rep = new CreateRepository();

$rep->model(User::class)
    ->data($data)
    ->columns(['name', 'nickname', 'email'])
    ->rules([
        'name' => 'required|max:100',
        'nickname' => 'required|max:50|unique:users,nickname',
        'email' => 'required|email|unique:users,email'
    ]);
    
$result = $rep->run();
````

## ReadRepository
````
$rep = new ReadRepository();
$rep->model(User::class)
    ->data($data)
    
    ->columns(['id', 'nickname'])
    ->otherColumns(['name', 'email', 'created_at', 'updated_at']);
        
$result = $rep->run();
````

## UpdateRepository
````
$rep = new UpdateRepository();

$rep->model(User::class)
    ->data($data)
    ->columns(['name', 'nickname'])
    ->rules([
        'name' => 'required|max:100',
        'nickname' => 'required|max:50|unique:users,nickname,{{id}}' . $data['id']
    ]);
    
$result = $rep->run();
````

##### Customizando select do update
````
$rep->select(function ($rep) {
     return $rep->model()->find($rep->data()->get('id'));
});
````

## DestroyRepository
````
$rep = new DestroyRepository();

$rep->model(User::class)
    ->data($data)
    ->title('usuário')
    ->block(['requests', 'logs'])
    ->dissociate(['groups', 'routes'])
    ->cascade(['accounts', 'contacts', 'files'])
    ->soft(true);
    
$result = $rep->run();
````

## RestoreRepository
````
$rep = new RestoreRepository();

$rep->model(Group::class)
    ->data($data);
    
$result = $rep->run();
````

## Callbacks 

### OnPrepare
* Disparado quando a preparação é iniciada.
* Available in: CreateRepository, UpdateRepository.

````
$rep->onPrepare(function ($rep) {

    // TODO: your code.
    
});
````

### OnPrepareEnd
* Disparado quando a preparação é finalizada.
* Available in: CreateRepository, UpdateRepository.

````
$rep->onPrepareEnd(function ($rep) {

    // TODO: your code.
    
})
````

### OnPrepareError
* Disparado quando ocorre erro durante a preparação.
* Available in: CreateRepository, UpdateRepository.

````
$rep->onPrepareError(function ($rep, $exception) {

    // TODO: your code.
    
})
````

### OnExecute
* Disparado quando a execução é iniciada.
* Available in: CreateRepository, UpdateRepository.

````
$rep->onExecute(function ($rep) {

    // TODO: your code.
    
})
````

### OnExecuteEnd
* Disparado quando a execução é finalizada.
* Available in: CreateRepository, UpdateRepository.

````
$rep->onExecuteEnd(function ($rep, $result) {

    // TODO: your code.
      
});
````

### OnExecuteEnd
* Disparado quando a execução é finalizada.
* Available in: CreateRepository, UpdateRepository.

````
$rep->onExecuteEnd(function ($rep, $result) {

    // TODO: your code.
      
});
````

### OnExecuteError
* Disparado quando ocorre erro durante a execução.
* Available in: CreateRepository, UpdateRepository.

````
$rep->onExecuteError(function ($rep, $exception) {

    // TODO: your code.
       
});
````

### OnSuccess
* Disparado quando tudo é processado sem erros.
* Available in: CreateRepository, UpdateRepository.

````
$rep->onSuccess(function ($rep, $result) {

    // TODO: your code.
         
});
````

### OnError
* Disparado quando qualquer erro ocorre, desde que ele não possua callback de erro específico 
* Available in: CreateRepository, UpdateRepository.

````
$rep->onError(function ($rep, $exception) {

    // TODO: your code.
         
});
````