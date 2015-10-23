<?php
namespace Ben;
use Ben\BenchmarkSuite;

class BenchmarkRunner
{
    /**
     * @var RevisionBase only have one Revision Base 
     */
    protected $revisionBase;

    /**
     * @var measure base (the same baseline for benchmarking results)
     */
    protected $measureBases = array();

    protected $collectors = array();

    public function addCollector($collector)
    {
        $this->collectors[$collector->id] = $collector;
    }

    public function run(BenchmarkSuite $suite)
    {
        foreach ($suite->benchmark as $benchmark) {
            foreach ($this->collectors as $collector) {
                $collector->prepare();
            }

            $benchmark->call($suite->N);

            foreach ($this->collectors as $collector) {
                $collector->finalize();
            }
        }
    }
}






