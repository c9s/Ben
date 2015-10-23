<?php
namespace Ben\MeasureBase;

class HardwareMeasureBase
{
    public function getType()
    {
        return 'hardware';
    }

    public function getInformation()
    {
        $info = array();
        if (PHP_OS == 'Darwin') {
            $info['cpu.brand_string'] = trim(exec('sysctl -n machdep.cpu.brand_string'));
            $info['cpu.vendor'] = trim(exec('sysctl -n machdep.cpu.vendor'));
            $info['cpu.features'] = trim(exec('sysctl -n machdep.cpu.features'));
            $info['vm_stat'] = trim(exec('vm_stat'));
        }
        return $info;
    }

    public function getIdentifier()
    {
        return 'cpu:' . trim(exec('sysctl -n machdep.cpu.brand_string'));
    }
}




