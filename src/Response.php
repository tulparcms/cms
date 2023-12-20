<?php

namespace Tulparstudyo\Cms;

class Response
{
    public $status = 0;
    public $message ='';
    public $html = '';
    public $data = [];
    public $redirect = false;
    public $refresh = false;
    public $callback = false;

    public function toArray()
    {
        return json_decode(json_encode($this, JSON_UNESCAPED_UNICODE), 1);
    }

}
