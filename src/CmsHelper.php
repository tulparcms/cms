<?php
$TCMS = new \Tulparstudyo\Cms\Cms();
function TCMS(){
    global $TCMS;
    if(!is_a($TCMS, '\Tulparstudyo\Cms\Cms')){
        $TCMS = new \Tulparstudyo\Cms\Cms();
    }
    return $TCMS;
}
function tcms_asset($file){
    return url('assets/'.$file).'?_v='.time();
}
