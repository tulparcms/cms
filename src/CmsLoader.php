<?php
namespace Tulparstudyo\Cms;
use Illuminate\Support\ServiceProvider;
use Symfony\Contracts\EventDispatcher\Event;

class CmsLoader extends ServiceProvider{
    const ADMIN = 'admin';
    const AUTH = 'App\\Http\\Middleware\\TcmsAuthenticate';
    const AUTH_PATH = 'tulparstudyo/cms-auth/controller/TcmsAuthenticate.php';
    protected $reposities = [];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        if(is_file(__DIR__.'/CmsHelper.php')){
            include_once(__DIR__.'/CmsHelper.php');
        }

        $this->loadAuth();
        $reposities = $this->createReposityList();
        if($reposities){
            foreach($reposities as $reposity){
                if($reposity['status']){
                    $this->loadReposity($reposity['code']);
                }
            }
        }
        TCMS()->setReposityList($reposities);
        TCMS()->addAction('routing', [$this, 'main_routing'], 10);
        TCMS()->doActions('auth_register', null, null);
        TCMS()->doActions('routing', null, null);

        /*
        TCMS()->addFilter('deneme', 'denem_filter', 10);
        TCMS()->addFilter('deneme', [self::class, 'denem_filter'], 20);
        TCMS()->addFilter('deneme', [$this, 'denem_filter2'], 30);
        $content = TCMS()->applyFilters('deneme', 'eski', '_ekdata');
        echo $content;
        TCMS()->addAction('deneme', [$this, 'denem_action'], 10);
        TCMS()->doActions('deneme', 'eski', '_ekdata');
        */
    }
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->addLocation(__DIR__.'/../views' );
        $this->checkInstall();
        TCMS()->doActions('localize', null, null);
    }
    private static function checkInstall(){
        $instal_path = storage_path('tcms' );
        if(!is_dir($instal_path)){
            if(url()->current()!=url('install')){
                echo '<script>window.location.href="'.url('install').'"</script>';
            }
        }
    }
    function main_routing(){
        \Route::get('/install', function () {
            $installed = TCMS()->installRequiredReposity();
            if($installed){
                return view('install-success', []);
            } else{
                return view('install-failure', []);
            }
        });

    }
    private static function loadReposities(){

    }
    private static function loadAuth(){
        $auth_file = storage_path('tcms/'.self::AUTH_PATH);
        if(is_file($auth_file)){
            include_once($auth_file);
        }
    }
    private  function setLanguagePath($reposity){
        /*$path = storage_path('tcms/'.$reposity.'/lang');
        \Lang::addNamespace($reposity, $path);*/
    }
    private function createReposityList(){
        $result = [];
        $path = storage_path('tcms');
        if(!is_dir($path)){
            return [];
        }
        $vendorList = scandir($path);
        if(empty($vendorList)){
            return [];
        }
        foreach($vendorList as $vendor){
            $providerDir = $path.DIRECTORY_SEPARATOR.$vendor;
            if(is_dir( $providerDir) && !in_array($vendor,array(".",".."))){
                $reposityList = scandir($providerDir);
                if($reposityList){
                    foreach($reposityList as $reposity){
                        $reposityDir = $path.DIRECTORY_SEPARATOR.$vendor.DIRECTORY_SEPARATOR.$reposity;
                        if(is_dir( $reposityDir) && !in_array($reposity,array(".",".."))){
                            $jsonData = $this->getReposityJson($reposityDir);
                            $result[] =  [
                                'code'=>$vendor.'/'.$reposity,
                                'vendor'=> $vendor,
                                'reposity'=> $reposity,
                                'path'=>$reposityDir,
                                'version'=>$jsonData['version'],
                                'name'=>$jsonData['name'],
                                'description'=>$jsonData['description'],
                                'license'=>$jsonData['license'],
                                'author'=>$jsonData['author'],
                                'status'=>is_file($reposityDir.DIRECTORY_SEPARATOR.'active'),
                            ];
                        }
                    }
                }
            }
        }
        return $result;
    }
    private function getReposityJson($path){
        $jsonData = [];
        if(is_file($path.DIRECTORY_SEPARATOR.'composer.json')){
            $json = file_get_contents($path.DIRECTORY_SEPARATOR.'composer.json');
            if($json){
                $jsonData = json_decode($json, 1);
            }
        }
        $jsonData['name'] = isset($jsonData['name'])?$jsonData['name']:'';
        $jsonData['description'] = isset($jsonData['description'])?$jsonData['description']:'';
        $jsonData['license'] = isset($jsonData['license'])?$jsonData['license']:'';
        $jsonData['version'] = isset($jsonData['version'])?$jsonData['version']:'';
        $jsonData['homepage'] = isset($jsonData['homepage'])?$jsonData['homepage']:'';
        $jsonData['author'] = isset($jsonData['authors'])&&isset($jsonData['authors'][0])?$jsonData['authors'][0]:['name'=>'', 'email'=>''];
        return $jsonData;
    }
    private  function loadReposity($reposity){
        $path = storage_path('tcms/'.$reposity);
        if(is_dir($path)){
            $register = $path.'/register.php';
            if(is_file($register)){
                include_once($register);
            }
        }
    }
}
