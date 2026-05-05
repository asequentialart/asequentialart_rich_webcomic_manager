<?php
namespace Classes; 

class Admin{
    public Paths $paths;
    public API $api;
    public Settings $settings;
    public DB $db;
    public $pathsArray=[
       "plugin_path"=>"",
        "plugin_url"=>"",
        "plugin"=>"",
        "uploads_baseurl"=>""
    ];
    public $pluginsList;
    public $posts="";
    public function __construct(Paths $paths, API $api ,Settings $settings, DB $db){
        $this->paths=$paths;
        $this->api=$api;
        $this->settings=$settings;
        $this->db=$db;
        $pathsArray=$paths->pathsArray;
        $this->pathsArray["plugin_path"]=$pathsArray["plugin_path"];
        $this->pathsArray["plugin_url"]=$pathsArray["plugin_url"];
        $this->pathsArray["plugin"]=$pathsArray["plugin"];
        $this->pathsArray["uploads_baseurl"]=$pathsArray["uploads_baseurl"];
    }
    public function getPluginList()
    {
        if (! function_exists('get_plugins')){
            require_once ABSPATH.'wp-admin/includes/plugin.php';
        }
        $all_plugins=get_plugins();
        $this->pluginsList=$all_plugins;
    }
    public function selectpipeline()
    {
        if(in_array('comic-easel-master/comiceasel.php',(array_keys($this->pluginsList)))){
            if (is_plugin_active('comic-easel-master/comiceasel.php')){
                $this->initComicEasel();
            }
            $post_types= get_post_types([], 'objects');
            }
        else {
            echo "no suitable plugin is available";
        }
    }
    public function initComicEasel()
    {
        $post_types= get_post_types([], 'objects');
        if (post_type_exists('comic')){
                $posts=get_posts([
                    'post_type'=> 'comic',
                    'post_per_page'=> -1,
                    'post_status' => 'publish'
                ]);
                $this->posts=$posts;
                $this->settings->posts=$posts;
        }
    }
    public function register_scripts()
    {
       add_action('admin_enqueue_scripts',array($this, 'enqueue'));
       add_action('wp_enqueue_scripts', array($this, 'enqueuefrontend'));
    }
    public function enqueue()
    {   wp_enqueue_style('mypluginstyle',$this->pathsArray["plugin_url"].'/assets/mystyle.css');
        wp_enqueue_script('mypluginscript',$this->pathsArray["plugin_url"].'/assets/myscript.js');
        wp_localize_script('mypluginscript','myscript_object ',['pathsArray'=>$this->paths->pathsArray]);
    }
    public function enqueuefrontend()
    {   wp_enqueue_style('mypluginstyle',$this->pathsArray["plugin_url"].'/assets/f_e_style.css');
       
    }
    public function loadSettings()
    {

        $prepPostsforSettings=$this->settings->prepPosts4Settings();
        $this->settings->tw_admin_menu($prepPostsforSettings);
    }
    
}