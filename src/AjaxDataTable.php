<?php

namespace Tulparstudyo\Cms;

class AjaxDataTable
{
    protected $cols = [];
    protected $url = '';
    protected $tableId = '';
    protected $recordsTotal = 0;
    protected $recordsFiltered = 0;
    protected $items =[];
    protected $attr =[
        'tableId'=>'',
        'tableClass'=>'',
    ];
    function  setCols(array $cols){
        $this->cols = $cols;
    }
    function  cols(){
        return $this->cols;
    }
    function  setUrl(string $url){
        $this->url = $url;
    }
    function  url(){
        return $this->url;
    }
    function  setTableId(string $tableId){
        $this->tableId = $tableId;
    }
    function  tableId(){
        return $this->tableId;
    }
    function  setRecordsTotal(string $recordsTotal){
        $this->recordsTotal = (int)$recordsTotal;
    }
    function  recordsTotal(){
        return $this->recordsTotal;
    }
    function  setRecordsFiltered(string $recordsFiltered){
        $this->recordsFiltered = (int)$recordsFiltered;
    }
    function  recordsFiltered(){
        return $this->recordsFiltered;
    }
    function  setItems(array $items){
        $this->items = (array)$items;
    }
    function  items(){
        return $this->items;
    }
    function toJson(){
        $result['recordsTotal'] = $this->recordsTotal();
        $result['recordsFiltered'] = $this->recordsFiltered();
        $result['data'] = $this->items;
        return $result;
    }
}
