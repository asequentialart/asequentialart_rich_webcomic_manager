<?php
namespace Classes;

class DB{
    private Paths $paths;
    public function __construct(Paths $paths)
    {
        $this->paths=$paths;
    }
    public function consultDB($params)
    {
        $comicTitle=$params['comicTitle'];
        $comicID=$params['comicID'];
        $comicJSONraw=$params['comicJSON'];

        global $wpdb;
        
        $table_name=$wpdb->prefix. "asequentialart_plugin";
        $id_to_check=$comicID;
        $row_count= $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) FROM $table_name WHERE comicID= '%d'", $id_to_check
        ));
        $message="empty";
        if ($row_count==="0"){
            $data=[
                'comicID'=>$comicID,
                'comicname'=>$comicTitle,
                'comicJSON'=>$comicJSONraw];
            $format=['%s','%s','%s'];
            $wpdb->insert($table_name, $data, $format);
            $new_id = $wpdb->insert_id;
            $message="A new Rich Comic entry has been created. ID: ".$new_id;
        }else if ($row_count==="1"){
            $data=[
                'comicname'=>$comicTitle,
                'comicJSON'=>$comicJSONraw];
            $where= ['comicID'=>$comicID];
            $format=['%s','%s'];
            $where_format=['%s'];
            $wpdb->update($table_name,$data, $where, $format, $where_format );
            $message="An existing Rich Comic entry has been updated";
            }
        return $message;
    }
    public function getComicJson($comicID){
        global $wpdb;
        $table_name=$wpdb->prefix. "asequentialart_plugin";
        $id_to_check=$comicID;
        $JSONRAW= $wpdb->get_var($wpdb->prepare(
            "SELECT comicJSON FROM $table_name WHERE comicID= '%d'", $id_to_check
        ));
        return $JSONRAW;
    }
    public function prepareCustomDB()
    {
        global $wpdb;
        $table_name=$wpdb->prefix. "asequentialart_plugin";
        //check if table exists
        $query =$wpdb->prepare("SHOW TABLES LIKE %s", $wpdb->esc_like($table_name));
        if ($wpdb->get_var($query)=== $table_name){
        }else{
            $charset_collate=$wpdb->get_charset_collate();
            $sql="
                CREATE TABLE $table_name(
                comicID varchar(255) NOT NULL,
                comicname varchar(255),
                comicJSON  varchar(4095)
                ) $charset_collate;
            ";
            require_once( ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }
    }

}