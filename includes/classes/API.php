<?php
namespace Classes; 
class API{
    private Paths $paths;
    private DB $db;
    public function __construct(Paths $paths, DB $db)
    {
        $this->paths=$paths;
        $this->db=$db;
    }
    public function APIentrypoint()
    {
        add_action('rest_api_init', array($this,'createAPIroute'));
    }
    public function createAPIroute(){
        register_rest_route('asequentialart/v1','/json',array(
                'methods'=>'POST',
                'callback'=>array($this,'asequentialartAPIcallback'),
                'permission_callback' => '__return_true'
            ));
    }
    public function asequentialartAPIcallback($request)
    {
        $params = $request->get_params();
        $type= $params['type'];
        $action=$params['action'];
        if ($type===1){
            if ($action==="enhance"){
                $comicTitle=$params['comicTitle'];
                $comicID=$params['comicID'];
                $comicJSONraw=$params['comicJSON'];
                $imgs_upload_month=$params['imgs_mth'];
                $comicJSON= json_decode($comicJSONraw, true);
                $message1=$this->db->consultDB($params);
                $message2=$this->checkComicFlag($comicID,"on");
                return $message1."/".$message2;
            }else if ($action==="de-enhance"){
                $comicTitle=$params['comicTitle'];
                $comicID=$params['comicID'];
                $message=$this->checkComicFlag($comicID,"off");
                return $message;
            }else {return "incorrect action requested";}
        }
    }
    
    public function checkComicFlag($post_id,$onoroff)
    {
        $message="";;
        if ($onoroff==="on"){
            if (!get_post_meta($post_id, 'aart_active', true)){
            
                $message="This post has no flag, let's give it a flag";
                update_post_meta($post_id, 'aart_active' , 1);
            }else{
                $message="This post already has a flag";
            }
        }else if($onoroff==="off"){
            if (!get_post_meta($post_id, 'aart_active', true)){
            
                $message="post has no flag";
                
            }else{
                update_post_meta($post_id, 'aart_active' , 0);
                $message="Flag has been deactivated";
            }
        }
        return $message;
    }

}