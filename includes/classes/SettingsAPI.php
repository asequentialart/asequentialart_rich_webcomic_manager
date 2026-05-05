<?php
namespace Classes;
class SettingsApi{
    public $admin_pages = array();
    public $admin_subpages = array();
    public $settings = array();
    public $sections = array();
    public $fields = array();
    public function __construct()
    {
    }
    public function register() 
    {
        if (! empty($this->admin_pages)){
            add_action('admin_menu', array($this, 'addAdminMenu'));

        }
        if (! empty($this->settings)){
            add_action('admin_init', array( $this, 'registerCustomFields'));
        }
    }
    public function addAdminMenu(){
        foreach($this->admin_pages as $page){
            add_menu_page($page['page_title'], $page['menu_title'],$page['capability'],$page['menu_slug'], $page['callback'], $page['icon_url'], $page['position']);
        }
        foreach($this->admin_subpages as $page){ 
            add_submenu_page($page['parent_slug'],$page['page_title'], $page['menu_title'],$page['capability'],$page['menu_slug'], $page['callback']);
        }
    }
    public function registerCustomFields()
    {
        // register setting
        foreach($this->settings as $setting){
            register_setting($setting["option_group"], $setting["option_name"], ((isset($setting["callback"]))?$setting["callback"]:'')); // Originally :    register_setting($option_group, $option_name, array('')); third param callback is optional
        }
        // register settings section
        foreach($this->sections as $section){
            add_settings_section($section["id"], $section["title"], ((isset($section["callback"]))?$section["callback"]:''), $section["page"]);// originally:  add_settings_section($id, $title, $callback, $page);  callback also optional
        }
        // add settings field 
        foreach($this->fields as $field){
            add_settings_field($field["id"], $field["title"], ((isset($field["callback"]))?$field["callback"]:''), $field["page"], $field["section"], ((isset($field["args"]))?$field["args"]:'')); // originally:   add_settings_field($id, $title, $callback, $page, 'default', array(''));   page has to be identical to the page of the section.  section field 'default'. last param list or arguments
        }
    }
    public function TestsetSettings_API()
    {
        echo "ready!!!";
    }
    public function setSettings_API(array $settings)
    {
        $this->settings=$settings;
        return $this;
    }
    public function setSections_API(array $sections)
    {
        $this->sections=$sections;
        return $this;
    }
    public function setFields_API(array $fields)
    {
        $this->fields=$fields;
        return $this;
    }
    public function addPages(array $pages)
    {
        $this->admin_pages=$pages;
        return $this;
    }       
}