<?php

namespace ExAdmin\ui\contract;

abstract class MenuAbstract
{
    abstract public function create(array $data,$plugin);

    abstract public function enable($plugin);

    abstract public function disable($plugin);

    abstract public function delete($plugin);

}
