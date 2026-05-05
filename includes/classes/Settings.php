<?php

namespace Classes;
use Classes\SettingsAPI;
class Settings
{
    public Paths $paths;
    public SettingsAPI $settingsAPI;
    public $CPT;
    public $pages = array();
    public $subpages = array();
    public $posts;
    public $storage;

    public function __construct(Paths $paths, SettingsAPI $settingsAPI)
    {
        $this->paths=$paths;
        $this->settingsAPI=$settingsAPI;
    }
    public function tw_admin_menu($prepposts){
        $this->storage=$prepposts;
        $page=[
            'page_title'=>'Asequentialart Control Panel',
            'menu_title'=>'asequentialart',
            'capability'=>'manage_options',
            'menu_slug'=>'aart_rich_comic_plugin',
            'callback'=> function(){
                return require_once($this->paths->pathsArray["plugin_path"]."/templates/admin_page.php");
            },
            'icon_url'=>'dashicons-store',
            'position'=>110
            ];
        add_menu_page($page['page_title'], $page['menu_title'],$page['capability'],$page['menu_slug'], $page['callback'], $page['icon_url'], $page['position']);
    }
    public function prepPosts4Settings(){
        $prep=[];
        $i=0;
        foreach($this->posts as $post){
            $p_post=[
                "title"=>$this->posts[$i]->post_title,
                "ID"=>$this->posts[$i]->ID
            ];
            array_push($prep,$p_post);
            $i++;
        }
        
        return $prep;
    }
}