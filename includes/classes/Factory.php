<?php
namespace Classes;

class Factory{
    private static ?Paths $paths= null;
    
    public static function init(){
        
        $paths= new Paths();
        $db=new DB($paths);
        $api=new API($paths,$db);
        $settingsAPI= new SettingsAPI();
        $settings= new Settings($paths,$settingsAPI);
        $admin = new Admin($paths, $api, $settings, $db);
        $comic= new Comic($paths,$db);
        return new Init($paths, $admin, $comic);
    }
}