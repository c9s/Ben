<?php
use Ben\Benchmark;
use Ben\BenchmarkSuite;
use Ben\BenchmarkRunner;
use Ben\MeasureBase\PHPMeasureBase;
use Ben\Collector\TimeUsageCollector;
use CLIFramework\Logger;
use Ben\BenchmarkComparator;
use CLIFramework\Component\Table\Table;
use CLIFramework\Component\Table\CompactTableStyle;
use CLIFramework\Component\Table\BorderlessTableStyle;

class BenchmarkSuiteTest extends PHPUnit_Framework_TestCase
{

    public function testSimple()
    {
        $suite = new BenchmarkSuite;
        $suite->setN(100000);

        $suite->add(new Benchmark('call_user_func', function($N) {
            for ($i = 0; $i < $N; $i++) {
                call_user_func("intval", "10");
            }
        }));
        $suite->add(new Benchmark('call_user_func_array', function($N) {
            for ($i = 0; $i < $N; $i++) {
                call_user_func_array("intval", ["10"]);
            }
        }));
        $runner = new BenchmarkRunner(new Logger);
        $runner->addCollector(new TimeUsageCollector);
        $runner->addMeasureBase(new PHPMeasureBase);
        $result = $runner->run($suite);
        var_dump($result); 

        $comparator = new BenchmarkComparator;
        $matrix = $comparator->compare($suite, $result, 'duration');
        var_dump($matrix);
        ;

        $table = new Table;
        $table->setHeaders(array_merge(["--"],array_keys($matrix)));
        $table->setStyle(new CompactTableStyle);
        $table->setStyle(new BorderlessTableStyle);
        foreach ($matrix as $aId => $aRows) {
            $row = [$aId];
            foreach ($aRows as $bId => $ratio) {
                $row[] = $ratio;
            }
            $table->addRow($row);
        }
        echo $table->render();
    }
}
