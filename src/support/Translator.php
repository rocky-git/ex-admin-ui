<?php
namespace ExAdmin\ui\support;

use Symfony\Component\Translation\Loader\ArrayLoader;
use Symfony\Component\Translation\MessageSelector;

class Translator extends \Symfony\Component\Translation\Translator
{
    public function __construct($locale)
    {
        parent::__construct($locale);
        $this->addLoader('array', new ArrayLoader());
        foreach (glob(__DIR__.'/../lang/*') as $item){
            if(is_dir($item)){
                $locale =  basename($item);

                foreach (glob($item.'/*.php') as $file){
                    $resource = include $file;

                    $domain = str_replace('.php','',basename($file));

                    $this->addResource('array',$resource,$locale,$domain);
                }
            }
        }
    }
}
