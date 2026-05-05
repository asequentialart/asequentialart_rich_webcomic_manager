<?php
namespace Classes;
//use Classes\Settings;
//use Classes\Comic;
class Init{   
    
    private Paths $paths;
    private Admin $admin;
    private Comic $comic;
    public function __construct(Paths $paths, Admin $admin, Comic $comic)
    {
        $this->paths=$paths;
        $this->admin= $admin;
        $this->comic= $comic;
    }
    public function entrypoint()
    {
        add_action('init', array($this, 'pluginentrypoint'),50);
    }
    public function pluginentrypoint()
    {
        $this->admin->api->APIentrypoint();
        $this->admin->getPluginList();
        $this->admin->db->prepareCustomDB();
        $this->admin->selectpipeline();
        $this->admin->register_scripts();
        $this->admin->loadSettings();
        $this->comic->comicEntryPoint();
    }
}