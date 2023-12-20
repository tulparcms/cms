<?php

namespace Tulparstudyo\Cms;

class Cms
{
    public $replace = [];
    public $filters = [];
    public $actions = [];
    public $dataTable = ['css'=>0, 'js'=>0];
    public $reposities = [];

    public function addReplace($view, $find, $replace){
        if($eventName && $callBack){
            $this->replace[$view][] = ['find'=>$find, 'replace'=>$replace];
        }
    }
    public function addFilter($eventName, $callBack, $priority=10){
        if($eventName && $callBack){
            $this->filters[$eventName][$priority][] = new CmsEvent($eventName, $callBack, $priority);
        }
    }

    public function addAction($eventName, $callBack, $priority=10){
        if($eventName && $callBack){
            $this->actions[$eventName][$priority][] = new CmsEvent($eventName, $callBack, $priority);
        }
    }

    public function applyFilters($eventName, $content, $data){
        if(array_key_exists($eventName, $this->filters)){
            foreach($this->filters as $filters){
                foreach($filters as $events){
                    foreach($events as $event){
                        $content = $event->filter($content, $data);
                    }
                }
            }
        }
        return $content;
    }

    public function doActions($eventName, $content, $data){
        if(array_key_exists($eventName, $this->actions)){
            foreach($this->actions as $actions){
                foreach($actions as $events){
                    foreach($events as $event){
                        if($eventName == $event->filterName){
                            $event->filter($content, $data);
                        }
                    }
                }
            }
        }
    }

    public function loadAdminTemplate($template, $data, $path=null){
        if($path) view()->addLocation(storage_path('tcms/'.$path.'/views'));
        return view($template, $data);
    }
    public function setReposityList($reposities){
        $this->reposities = $reposities;
    }
    public function getReposityList(){
        return $this->reposities;
    }
    public function dataTableCss(){
        if($this->dataTable['css']){
            return '';
        }
        $this->dataTable['css'] = 1;
        return '
    <link rel="stylesheet" href="'.tcms_asset('vendor/libs/datatables-bs5/datatables.bootstrap5.css').'" />
    <link rel="stylesheet" href="'.tcms_asset('vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css').'" />
    <link rel="stylesheet" href="'.tcms_asset('vendor/libs/datatables-select-bs5/select.bootstrap5.css').'" />
    <link rel="stylesheet" href="'.tcms_asset('vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css').'" />
    <link rel="stylesheet" href="'.tcms_asset('vendor/libs/datatables-fixedcolumns-bs5/fixedcolumns.bootstrap5.css').'" />
    <link rel="stylesheet" href="'.tcms_asset('vendor/libs/datatables-fixedheader-bs5/fixedheader.bootstrap5.css').'" />';
    }
    public function dataTableJs(){
        if($this->dataTable['js']){
            return '';
        }
        $this->dataTable['js'] = 1;
        return ' <script src="'.tcms_asset('vendor/libs/datatables-bs5/datatables-bootstrap5.js').'"></script>';
    }
    public static function downloadReposity($reposity){
        $url = 'https://codeload.github.com'.$reposity.'/zip/refs/heads/main';
        $client = new \GuzzleHttp\Client(['verify' => false]);
        $reposities = explode('/', $reposity);
        $filename = array_pop($reposities);
        $folder  = storage_path('tcms'.implode('/', $reposities));
        $file_path  = $folder.'/'.$filename.'.zip';

        try {
            $response = $client->get($url, ['sink' => $file_path]);
           if(is_file($file_path)){
               $zip = new \ZipArchive();
               $status = $zip->open($file_path);
               if ($status !== true) {
                   throw new \Exception($status);
               }
               else{
                   if (!\File::exists( $folder)) {
                       \File::makeDirectory($folder, 0755, true);
                   }
                   $zip->extractTo($folder);
                   $zip->close();
                   return true;
               }
           }
            return true;
        } catch (\Exception $e) {

        }
        return false;

    }

}
