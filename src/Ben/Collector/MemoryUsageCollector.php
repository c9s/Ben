<?php
namespace Ben\Collector;

class MemoryUsageCollector
{
    protected $usageBefore;

    protected $usageAfter;

    protected $peakUsageBefore;

    protected $peakUsageAfter;

    public function prepare()
    {
        $this->usageBefore = memory_get_usage();
        $this->peakUsageBefore = memory_get_peak_usage();
    }

    public function finalize()
    {
        $this->usageAfter = memory_get_usage();
        $this->peakUsageAfter = memory_get_peak_usage();
    }

    public function getResult()
    {
        return [
            'memory_usage' => $this->usageAfter - $this->usageBefore,
            'memory_peak_usage' => $this->peakUsageAfter - $this->peakUsageBefore,
        ];
    }

}
