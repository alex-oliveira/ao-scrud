# Ao-Scrud

Resources for SCRUD with Laravel 5.1

# Installation

### 1) Install
````
$ composer require alex-oliveira/ao-scrud
````

### 2) Configure "config/app.php" file
````
'providers' => [
    /*
     * Vendors Service Providers...
     */
    AoScrud\ServiceProvider::class,
],
````

# Samples

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
        'nickname' => 'required|max:50|unique:users,nickname,' . $data['id']
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
It is dispatched when the "prepare" is started.

````
$rep->onPrepare(function ($rep) {
    
});
````

### OnPrepareEnd
It is dispatched when the "prepare" is ended.

````
$rep->onPrepareEnd(function ($rep) {
    
})
````

### OnPrepareError
It is dispatched when happen error during the "prepare".

````
$rep->onPrepareError(function ($rep, $exception) {
    
})
````

### OnExecute
It is dispatched when the "execute" is started.

````
$rep->onExecute(function ($rep) {

})
````

### OnExecuteEnd
It is dispatched when the "execute" is ended.

````
$rep->onExecuteEnd(function ($rep, $result) {

});
````

### OnExecuteError
It is dispatched when happen error during the "execute".

````
$rep->onExecuteError(function ($rep, $exception) {

});
````

### OnSuccess
It is dispatched when all is processed without erros. 

````
$rep->onSuccess(function ($rep, $result) {

});
````

### OnError
It is dispatched when any error happen, since that it not has a specific error callback. 

````
$rep->onError(function ($rep, $exception) {

});
````