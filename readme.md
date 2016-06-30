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

Bellow, do you can see some fast samples, but if you need more information, do you can [**open the wiki**](https://github.com/alex-oliveira/ao-scrud/wiki).

## Controllers

### ScrudController
````
namespace My\Controllers;

use AoScrud\Controllers\ScrudController;
use My\Services\UserService;

class UsersController extends ScrudController
{
    /**
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }
}
````

### BaseScrudController
````
namespace My\Controllers;

use AoScrud\Actions\Index;
use AoScrud\Actions\Show;
use My\Services\UserService;

class UsersController extends BaseScrudController
{
    use Index, Show;
    
    /**
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }
}
````

## Services

### ScrudService
````
namespace MY\Services;

use AoScrud\Services\ScrudService;

class UserService extends ScrudService
{
    public function __construct()
    {
        parent::__construct();
        
        // WRITE HERE THE YOUR CONFIGS //        
    }
}
````

### SearchConfig
````
$this->search
    ->model(User::class)
    ->columns(['id', 'nickname'])
    ->otherColumns(['name', 'email', 'created_at', 'updated_at'])
    ->orders(['id', 'name', 'nickname', 'email', 'created_at', 'updated_at'])
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

### Roles
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
