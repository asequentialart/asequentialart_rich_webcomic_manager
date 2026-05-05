<?php

namespace Classes;

class Paths{
    public $homeURL;
    public $plugin_path;
    public $plugin_url;
    public $plugin;
    public $uploads_baseurl;
    public $pathsArray=[
        "home_URL"=>"",
        "plugin_path"=>"",
        "plugin_url"=>"",
        "plugin"=>"",
        "uploads_baseurl"=>""
        ];

    public function __construct(){
        $this->homeURL=home_url();
        $this->pathsArray["home_URL"]=$this->homeURL;
        $this->plugin_path= plugin_dir_path(dirname(__DIR__));
        $this->pathsArray["plugin_path"]=$this->plugin_path;
        $this->plugin_url= plugin_dir_url(dirname(__DIR__));
        $this->pathsArray["plugin_url"]=$this->plugin_url;
        $this->plugin= plugin_basename(dirname(__DIR__,2)).'/aart_plugin.php';
        $this->pathsArray["plugin"]=$this->plugin;
        $upload_dir=wp_upload_dir();
        $this->uploads_baseurl=$upload_dir['baseurl'];
        $this->pathsArray["uploads_baseurl"]=$this->uploads_baseurl;
        
    }
}