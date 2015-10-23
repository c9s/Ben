<?php
namespace Ben\MeasureBase;

/**
 * Measure Base returns an identifier for measuring benchmarks
 */
class PHPMeasureBase extends MeasureBase
{
    public function getType()
    {
        return 'php';
    }

    public function getInformation()
    {
        return [
            'type'    => 'php',
            'os'      => PHP_OS,
            'version' => phpversion(),
            'uname'   => php_uname(),
            'features' => [
                'opcache_enabled' => extension_loaded('opcache'),
                'apcu_enabled' => extension_loaded('apcu'),
                'gc_enabled' => gc_enabled(),
            ],
        ];
    }

    public function getIdentifier()
    {
        return join('-',['php', phpversion(), PHP_OS]);
    }
}


