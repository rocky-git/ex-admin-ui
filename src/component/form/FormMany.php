<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-02-22
 * Time: 21:00
 */

namespace ExAdmin\ui\component\form;


use ExAdmin\ui\component\Component;

/**
 * Class FormMany
 * @method static $this create($bindField = null,$value = []) 创建
 * @package ExAdmin\ui\component\form
 */
class FormMany extends Component
{
    protected $name = 'ExFormMany';

    protected $vModel = 'value';
    public function __construct($field = null,$value = [])
    {

        $this->vModel($this->vModel, $field, $value);
        parent::__construct();
    }
    
}