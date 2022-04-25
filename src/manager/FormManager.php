<?php

namespace ExAdmin\ui\manager;



use ExAdmin\ui\component\form\driver\Arrays;
use ExAdmin\ui\component\form\driver\File;
use ExAdmin\ui\component\form\Form;
use ExAdmin\ui\contract\FormAbstract;


class FormManager extends Manager
{
    public function setDriver($repository,$component)
    {
        if (is_array($repository)) {
            $this->driver = new Arrays($repository, $component);
        } elseif ($repository instanceof FormAbstract) {
            $this->driver = $repository;
        } elseif (is_string($repository) && is_file($repository)){
            $this->driver = new File($repository, $component);
        }
    }
}
