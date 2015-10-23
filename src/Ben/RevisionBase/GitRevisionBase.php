<?php
namespace Ben\RevisionBase;

class GitRevisionBase
{
    public function getRevisionInfo()
    {
        return [
            'type' => 'git',
            'revision' => trim(exec('git rev-list -1 HEAD')),
            'branch'   => trim(exec('git symbolic-ref --short HEAD')),
        ];
    }

    public function getRevision()
    {
        return trim(exec('git rev-list -1 HEAD'));
    }

    public function getIdentifier()
    {
        $revision = trim(exec('git rev-list -1 HEAD'));
        $branch   = trim(exec('git symbolic-ref --short HEAD'));
        return 'git-' . $revision . '@' . $branch;
    }
}

