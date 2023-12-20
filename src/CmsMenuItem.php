<?php

namespace Tulparstudyo\Cms;

class CmsMenuItem{
    public $id;
    public $url;
    public $title;
    public $class;
    public $icon;
    public function __construct($id, $title='', $url='', $class='', $icon=''){
        $this->id = $id;
        $this->url = $url;
        $this->title = $title;
        $this->class = $class;
        $this->icon = $icon;
    }
}
