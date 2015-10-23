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

    public function pushCollector($collector)
    {
        $this->collectors[$collector->getId()] = $collector;
    }

    public function getCollector($id)
    {
        if (isset($this->collectors[$id])) {
            return $this->collectors[$id];
        }
    }

    public function getAvailableCollectors()
    {
        return $this->collectors;
    }

    public function addMeasureBase($measureBase)
    {
        $this->measureBases[] = $measureBase;
    }

    public function setRevisionBase($revisionBase)
    {
        $this->revisionBase = $revisionBase;
    }

    public function run(BenchmarkSuite $suite)
    {
        $result = array();
        $this->logger->info("Collecting information...");

        if ($this->revisionBase) {
            // $result['revision_system'] = $this->revisionBase->getRevisionSystemType();
            // $result['revision_info'] = $this->revisionBase->getRevisionInfo();
            $result['revision'] = $this->revisionBase->getRevisionInfo();
        }

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
                $collector->prepare($suite, $benchmark);
            }

            $benchmark->call($suite->N, $this);

            while ($collector = array_pop($preparedCollectors)) {
                $collector->finalize($suite, $benchmark);
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






