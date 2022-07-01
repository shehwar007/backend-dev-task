<?php

use Illuminate\Support\Facades\DB;

function chk($name)
{
    try {
   
    } catch (exception $e) {
        return false;
      
    }
}
function super_admin()
{
    $data=session('AdminData')['admin_role'];
    if($data=="Super-Admin"){
        return true;
    }else{
        return false;
    }
  
}

function admin_user(){
    $data=session('AdminData')['admin_role'];
    if($data=="Admin" || $data=="User"){
        return true;
    }else{
        return false;
    }
}

function blogger(){
    $data=session('AdminData')['admin_role'];
    if($data=="Blogger"){
        return true;
    }else{
        return false;
    }
}
function blogger_id(){
    $data=session('AdminData')['admin_role'];
    if($data=="Blogger"){
        (int)$id=session('AdminData')['admin_id'];
        return $id;
    }else{
        return false;
    }
}


