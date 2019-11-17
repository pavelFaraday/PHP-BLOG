<?php 
session_start();
function message(){
    if(isset($_SESSION["ErrorMessage"])) {
        $output="<div class=\"alert alert-danger\">" ;
        $output.=htmlentities($_SESSION["ErrorMessage"]);
        $output.="</div>";
        $_SESSION["ErrorMessage"] = null;
        return $output;
    }
}

function Successmessage(){
    if(isset($_SESSION["Successmessage"])) {
        $output="<div class=\"alert alert-success\">" ;
        $output.=htmlentities($_SESSION["Successmessage"]);
        $output.="</div>";
        $_SESSION["Successmessage"] = null;
        return $output;
    }
}

?>