<?php
namespace Ben\Collector;
use Ben\BenchmarkSuite;

interface Collector {


    public function getId();

    public function getResult(BenchmarkSuite $suite);

}
