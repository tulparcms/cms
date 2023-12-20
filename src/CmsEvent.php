<?php

namespace Tulparstudyo\Cms;

class CmsEvent
{
    public $hash;
    public $filterName;
    public $callBack;
    public $priority;
    function __construct($filterName, $callBack, $priority){
        $this->filterName = $filterName;
        $this->callBack = $callBack;
        $this->priority = $priority;
    }
    function filter($content, $data){
        if(is_array($this->callBack)){
            if(count($this->callBack)==2){
                if(is_object($this->callBack[0]) && method_exists($this->callBack[0], $this->callBack[1])){
                    return $this->callBack[0]->{$this->callBack[1]}($content, $data);
                }else {
                    return call_user_func_array($this->callBack, [$content, $data]);
                }
            }
        } elseif(function_exists($this->callBack)){
            return call_user_func($this->callBack, $content, $data);
        }
    }
}
