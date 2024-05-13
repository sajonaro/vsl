## VSL stands for Vertical Slice (architecture) Library

So current lib contains useful middleware (handlers) and other types helping develop web applications built on vertical slice architecture principles
The code implements concepts used in popular .Net library MediatR [https://github.com/jbogard/MediatR] 



## how to use in in other php applications
- reference vsl library via composer.json like so:

```
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/sajonaro/vsl"
        }
    ],
    "require": {
        "vsl/vsl": "dev-master"
    }
}

```

- in your index.php file (root) use: 

```
require __DIR__ . '/vendor/autoload.php';

use Vsl\;
use Vsl\Core;

``` 