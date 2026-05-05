<?php
namespace Classes;

class Comic
{
    private Paths $paths;
    private DB $db;
    public function __construct(Paths $paths, DB $db)
    {   
        $this->paths=$paths;
        $this->db=$db;
    }
    public function comicEntryPoint(){
        add_action('template_redirect', [$this,'conditionallyModifyHTML'], 200);
    }
    public function conditionallyModifyHTML()
    {
        if (!is_singular('comic')){
            return;
        }
        $post_id=get_queried_object_id();

        if (!get_post_meta($post_id, 'aart_active', true)){
            return;
        }
        $JSONraw=$this->db->getComicJson($post_id);
        $JSON=json_decode($JSONraw);
        $slice=$JSON->page_100;
        $uploaddateOb=$JSON->u_date;
        $xtras=["y"=>$uploaddateOb->year, "m"=>$uploaddateOb->month];
        $firstdiv="<div id='comic_page_container'></div>";
        $newdom= new \DOMDocument();
        $newdom->loadHTML('<?xml encoding="utf-8" ?>'.$firstdiv);
        $updated_doc=$this->processlines($slice,$newdom,$xtras);
        $nodetoinsert=$updated_doc->getElementById('comic_page_container');
        ob_start(function($html) use ($nodetoinsert){
            libxml_use_internal_errors(true);
            $dom2= new \DOMDocument();
            $dom2->loadHTML('<?xml encoding="utf-8" ?>'.$html);
            $parent=$dom2->getElementById("comic");
            if (!$parent){
                libxml_clear_errors();
                return $html;
            }
            $first=$parent->firstElementChild;
            $parent->removeChild($first);
            $imported=$dom2->importNode($nodetoinsert,true);
            $parent->appendChild($imported);
            
            return $dom2->saveHTML();
        });
        
        
    }
    function processlines($slice, $mydoc="" ,$xtras=""){
        $doc= $mydoc;
        $appento="";
        $renderedfrg="";
        foreach($slice as $index=>$line){
            $nf=$line[0][0];
            if ($nf===1||$nf===2){$this->doline1or2($line,$index,$doc,$xtras);}
            else if ($nf===4){$this->doline4($line, $index,$doc,$xtras);}
           
        }
        return $doc;
    }
    function doline1or2($line,$index,$doc,$xtras){
        $artpath=$this->paths->pathsArray["uploads_baseurl"]."/".$xtras["y"]."/".$xtras["m"]."/";
        $newelmnt = $doc->createElement($line[1]);
       
        foreach($line[2] as $paramkey => $paramval){
            if($paramkey==="src"||$paramkey==="srcset"){
                if($line[1]!=="iframe"){
                $newelmnt->setAttribute($paramkey, ($artpath.$paramval));
                }
                else {
                    $newelmnt->setAttribute($paramkey, ($paramval));
                }
            }
            else {
                $newelmnt->setAttribute($paramkey, $paramval);
            }
            if ($line[3]!==0){
                $newnode= $doc->createDocumentFragment();
                $newnode->appendXML($line[3]);
                $newelmnt->appendChild($newnode);
            }
        }
        $mypar=$doc->getElementById($line[4]);
        $mypar->appendChild($newelmnt);
    }
    function doline4($line,$index,$doc,$xtras){
        $elmntid=$line[4];
        $selectelmnt=$doc->getElementById($elmntid);
        foreach($line[2] as $paramkey => $paramval){
            if($paramkey==="src"||$paramkey==="srcset"){
                if($line[1]!=="iframe"){
                $selectelmnt->setAttribute($paramkey, ($artpath.$paramval));
                }
                else {
                    $selectelmnt->setAttribute($paramkey, ($paramval));
                }
            }
            else {
                $selectelmnt->setAttribute($paramkey, $paramval);
            }
        }
       
    }
    
}