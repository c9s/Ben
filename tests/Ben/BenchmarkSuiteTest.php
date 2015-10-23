<?php
use Ben\Benchmark;
use Ben\BenchmarkSuite;
use Ben\BenchmarkRunner;
use Ben\MeasureBase\PHPMeasureBase;
use Ben\MeasureBase\OSMeasureBase;
use Ben\RevisionBase\GitRevisionBase;
use Ben\Collector\TimeUsageCollector;
use Ben\Collector\XHProfCollector;
use Ben\BenchmarkComparator;
use Ben\MatrixRenderer\ConsoleMatrixRenderer;
use CLIFramework\Component\Table\Table;
use CLIFramework\Component\Table\CompactTableStyle;
use CLIFramework\Component\Table\BorderlessTableStyle;
use CLIFramework\Logger;

class BenchmarkSuiteTest extends PHPUnit_Framework_TestCase
{

    public function testSimple()
    {
        $suite = new BenchmarkSuite('function_call', 'Benchmark for Different Kinds of Function Call');
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
        $runner->pushCollector(new TimeUsageCollector);
        $runner->pushCollector(new XHProfCollector);

        $runner->addMeasureBase(new PHPMeasureBase);
        $runner->addMeasureBase(new OSMeasureBase);

        $result = $runner->run($suite);
        var_dump($result); 

        $comparator = new BenchmarkComparator;
        // compare by duration
        $matrix = $comparator->compare($suite, $result, 'duration');
        var_dump($matrix);
        ;

        $renderer = new ConsoleMatrixRenderer;
        echo $renderer->render($matrix);
    }
}
