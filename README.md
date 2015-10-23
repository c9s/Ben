Ben
================================
A powerful benchmark toolkit designed in PHP.



OBJECTIVE
------------

- Compare benchmark between different implementation in the same benchmark suite.
- Compare benchmark suite between different revision.
- Compare benchmark suite between different platform or base.


SYNOPSIS
-----------

```php
use Ben\BenchmarkSuite;

$suite = new BenchmarkSuite;

function setupCallUserFunc(BenchmarkSuite $suite) {
    // prepare data

    $suite->add(new Benchmark('call_user_func', function($N) use (...) {
        for ($i = 0; $i < $N; $i++) {

        }
    }));
}

$runner = new BenchmarkRunner;
$runner->run($suite);
```


