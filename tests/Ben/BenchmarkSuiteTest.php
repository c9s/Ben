<?php
use Ben\Benchmark;
use Ben\BenchmarkSuite;
use Ben\BenchmarkRunner;
class BenchmarkSuiteTest extends PHPUnit_Framework_TestCase
{

    public function testSimple()
    {
        $suite = new BenchmarkSuite;
        $suite->add(new Benchmark('call_user_func', function($N) {
            for ($i = 0; $i < $N; $i++) {
                call_user_func("intval", "10");
            }
        }));
        $runner = new BenchmarkRunner;
        $runner->run($suite);
    }
}
