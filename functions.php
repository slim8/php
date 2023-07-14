<?php
    function nb_part($id){
        global  $db;
        $sql = $db->query("SELECT * FROM participant_event WHERE id_event = '$id'");
        $count = $sql->num_rows;
        return $count;
    }
//get event name by participant id
function get_name($id){
    global  $db;


    $sql = $db->query("   SELECT name 
                                FROM events E 
                                INNER JOIN participant_event PE 
                                ON E.id=PE.id_event 
                                WHERE PE.id_participant = '$id'
                            ");
    $name = $sql->fetch_object()->name;

    return $name;
}


function get_role($role){
        if($role==0){
            return  "<span class='badge text-info'>User</span>";
        }
        return "<span class='badge text-danger'>Admin</span>";
}