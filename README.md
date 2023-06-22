# strawberry-di

This is a simple di container for [strawberry](https://github.com/elderguardian/strawberry), but you could easily use it in other frameworks.

## Setup

### Installation

1. Download the repository or clone its content
2. Move the `strawberry-di/` directory inside `src/` into the strawberry's `src/foundations`

Or add it as a submodule.

#### How to add mappings

Pass an array like this to the constructor when creating a new instance of the Kernel class.

```php
<?php

return [
    IInterface::class => Implementation::class,
];
```

#### How to use the di container

Create a new instance of the kernel inside the Router and pass it to the controller action when it gets executed.

##### **`src/foundations/router/Router.php:route:35`**

```php
        [...]
            $diContainer = new Kernel($mappings);

            echo (new $controllerName)->$actionName($diContainer);
        [...]
```

Now you can accept the Kernel as a parameter inside your controller.

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
