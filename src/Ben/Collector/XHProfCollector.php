<?php
namespace Ben\Collector;
use XHProfRuns_Default;

class XHProfCollector
{
    protected $options = array();

    protected $profile;

    protected $runId;

    protected $namespace;

    public function __construct(array $options = array())
    {
        $this->options = array_merge([
            'flags' => XHPROF_FLAGS_CPU + XHPROF_FLAGS_MEMORY,
            'output_dir' => ini_get('xhprof.output_dir') ?: '/tmp',
            'export_profile' => false,
        ], $options);
    }

    public function getId()
    {
        return 'xhprof';
    }

    public function prepare($suite, $benchmark)
    {
        xhprof_enable($this->options['flags']);
    }

    public function finalize($suite, $benchmark)
    {
        $this->profile = xhprof_disable();

        $this->profile = array_filter($this->profile, function($key) {
            return !preg_match('/Ben\\\\Collector/', $key);
        }, ARRAY_FILTER_USE_KEY);

        $runs = new XHProfRuns_Default($this->options['output_dir']);
        $this->namespace = $suite->name . ':' . $benchmark->getName();
        $this->runId = $runs->save_run($this->profile, $this->namespace);
    }

    public function getProfile()
    {
        return $this->profile;
    }

    public function getResult()
    {
        $result = [
            'xhprof_runid' => $this->runId,
            'xhprof_namespace' => $this->namespace,
        ];
        if ($this->options['export_profile']) {
            $result['xhprof_profile'] = $this->profile;
        }
        return $result;
    }
}


  
