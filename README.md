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

A more detailed example:

```php
use Ben\Benchmark;
use Ben\BenchmarkSuite;
use Ben\BenchmarkRunner;
use Ben\MeasureBase\PHPMeasureBase;
use Ben\MeasureBase\OSMeasureBase;
use Ben\RevisionBase\GitRevisionBase;
use Ben\Collector\TimeUsageCollector;
use Ben\BenchmarkComparator;
use CLIFramework\Logger;

$suite = new BenchmarkSuite;
$suite->setN(100000);

$suite->add(new Benchmark('call_user_func', function($N, $runner) {
    for ($i = 0; $i < $N; $i++) {
        call_user_func("intval", "10");
    }
}));
$suite->add(new Benchmark('call_user_func_array', function($N, $runner) {
    for ($i = 0; $i < $N; $i++) {
        call_user_func_array("intval", ["10"]);
    }
}));
$runner = new BenchmarkRunner(new Logger);
$runner->setRevisionBase(new GitRevisionBase);
$runner->addCollector(new TimeUsageCollector);
$runner->addMeasureBase(new PHPMeasureBase);
$runner->addMeasureBase(new OSMeasureBase);

$result = $runner->run($suite);
var_dump($result); 

$comparator = new BenchmarkComparator;
$matrix = $comparator->compare($suite, $result, 'duration');
var_dump($matrix);
;
```


