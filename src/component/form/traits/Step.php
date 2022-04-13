<?php

namespace ExAdmin\ui\component\form\traits;

use ExAdmin\ui\component\form\step\StepForm;
use ExAdmin\ui\support\Request;

trait Step
{
    protected $steps;
    /**
     * 表单步骤条
     * @param int $current 初始步数
     * @return StepForm
     */
    public function steps($current = 0){
        $this->setEvent('Success', 'custom', []);
        $this->steps = StepForm::create(null,$current,$this);
        $this->bindAttr('stepCurrent',$this->steps->getModel(),true);
        $this->push($this->steps);
        return $this->steps;
    }
    public function getSteps(){
        return $this->steps;
    }

    /**
     * 步骤表单完成阶段
     * @return bool
     */
    public function isStepfinish(){
        if($this->steps){
            $stepCount = $this->steps->getStepCount();
            if(Request::input('CURRENT_VALIDATION_STEP') == $stepCount - 2){
                return true;
            }
        }
        return false;
    }
}
