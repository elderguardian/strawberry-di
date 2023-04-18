# strawberry-di

This is a simple di container for [strawberry](https://github.com/elderguardian/strawberry), but you could easily use it in other frameworks.

## Setup

### Installation

1. Download the repository or clone its content
2. Move the `strawberry-di/` directory inside `src/` into the strawberry's `src/foundations`

#### How to add mappings

##### **`src/foundatins/di/mappings.php`**

```php
<?php

return [
    IInterface::class => Implementation::class,
];
```

#### How to use the di container

Create a new instance of the kernel and pass it to the controller

##### **`src/foundations/router/Router.php:route:35`**

```php
        if (is_array($routerResult)) {
            $controllerName = $routerResult[0];
            $actionName = $routerResult[1];
            $diContainer = new Kernel();

            echo (new $controllerName)->$actionName($diContainer);
        } else {
            echo $routerResult();
        }
```

Then take it as a parameter in your controller

##### **`src/controllers/YourController.php`**

```php
    ...

    public function world(IKernel $kernel) {
   
        //Get class from interface string
        $implementation = $kernel->get('IInterface');
    
        return 'Hello World!';
    }

    ...
```
