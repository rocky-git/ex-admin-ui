<?php
namespace ExAdmin\ui\manager;

use ExAdmin\ui\component\grid\grid\driver\Arrays;
use ExAdmin\ui\contract\GridAbstract;


class GridManager extends Manager
{
    public function setDriver($repository,$component){
        if (is_array($repository)) {
            $this->driver = new Arrays($repository, $component);
        } elseif ($repository instanceof GridAbstract) {
            $this->driver = $repository;
        }
    }
}
