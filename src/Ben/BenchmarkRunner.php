<?php
namespace Ben;
use CLIFramework\Logger;
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


    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function addCollector($collector)
    {
        $this->collectors[$collector->id] = $collector;
    }

    public function addMeasureBase($measureBase)
    {
        $this->measureBases[] = $measureBase;
    }

    public function run(BenchmarkSuite $suite)
    {
        $result = array();
        $this->logger->info("Collecting information...");

        if (!empty($this->measureBases)) {
            foreach ($this->measureBases as $measureBase) {
                $result['base'][ $measureBase->getType() ] = [
                    'identifier' => $measureBase->getIdentifier(),
                    'info' => $measureBase->getInformation(),
                ];
            }
        }

        foreach ($suite->benchmarks as $benchmark) {
            $this->logger->info("Benchmarking " . $benchmark->getName() . '...');
            $preparedCollectors = [];
            foreach ($this->collectors as $collector) {
                $preparedCollectors[] = $collector;
                $collector->prepare();
            }

            $benchmark->call($suite->N);

            while ($collector = array_pop($preparedCollectors)) {
                $collector->finalize();
            }

            foreach ($this->collectors as $collector) {
                $collected = $collector->getResult();
                foreach ($collected as $itemKey => $itemValue) {
                    $result['benchmark'][$benchmark->getName()][$itemKey] = $itemValue;
                }
            }
        }
        return $result;
    }
}






