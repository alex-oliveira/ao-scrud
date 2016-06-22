# Ao-Scrud

Resources for SCRUD with Laravel 5.1

# CreateRepository

### Utilização básica
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

### Utilizando callbacks 
````
$rep->onPrepare(function ($rep) {

    // disparado quando a preparação é iniciada.
    
})->onPrepareEnd(function ($rep) {
    
    // disparado quando a preparação é finalizada.
            
})->onPrepareError(function ($rep, $exception) {
    
    // disparado quando ocorre erro durante a preparação.
         
})->onExecute(function ($rep) {
    
    // disparado quando a execução é iniciada.
         
})->onExecuteEnd(function ($rep, $result) {
    
    // disparado quando a execução é finalizada.
         
})->onExecuteError(function ($rep, $exception) {
    
    // disparado quando ocorre erro durante a execução.
         
})->onSuccess(function ($rep, $result) {
    
    // disparado quando tudo é processado sem erros.
         
})->onError(function ($rep, $exception) {
    
    // disparado quando qualquer erro ocorre
    // desde que ele não possua callback de erro específico 
         
});
````