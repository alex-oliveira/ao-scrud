# Installation

### 1) Install
````
$ composer require alex-oliveira/ao-scrud
````

### 2) Configure "config/app.php" file
````
'providers' => [
    /*
     * Vendor Service Providers...
     */
    AoScrud\ServiceProvider::class,
],
````

### 3) Configure "app/Exceptions/Handler.php" file
````
class Handler extends ExceptionHandler
{
    use \AoScrud\Core\ScrudHandler;
    .
    .
    .
    public function render($request, Exception $exception)
    {
        return $this->scrudRender($request, $exception);
    }
    .
    .
    .
}
````

# Utilization

Discover all in the [**wiki**](https://github.com/alex-oliveira/ao-scrud/wiki).