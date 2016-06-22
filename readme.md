# Ao-Scrud

Resources for SCRUD with Laravel 5.1

## SearchRepository
````
$rep = new SearchRepository();

$rep->model(User::class)
    ->data($data)
    ->columns(['id', 'name'])
    ->otherColumns(['description', 'created_at', 'updated_at'])
    ->orders(['id', 'name', 'created_at', 'updated_at'])
    ->limit(50)
    ->criteria([
        //
    ])->rules([
        //
    ])->with([
        //
    ]);
    
$result = $rep->run();
````

## CreateRepository
````
$rep = new CreateRepository();

$rep->model(User::class)
    ->data($data)
    ->columns(['name', 'description'])
    ->rules([
        'name' => 'required|max:100|unique:users,name',
        'email' => 'required|email|unique:users,email'
    ]);
    
$result = $rep->run();
````

## UpdateRepository
````
$rep = new UpdateRepository();

$rep->model(User::class)
    ->data($data)
    ->columns(['name', 'description'])
    ->rules([
        'name' => 'required|max:100|unique:users,name',
        'email' => 'required|email|unique:users,email'
    ]);
    
$result = $rep->run();
````

##### Customizando select do update
````
$rep->select(function ($rep) {
     return $rep->model()->find($rep->data()->get('id'));
});
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