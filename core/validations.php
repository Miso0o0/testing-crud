 
 <?php

function requiredVal($input) {
    if(empty($input)){
        return true ;
    }else{
        return false ;
    }
}


function minVal($input,$length){
    if(strlen($input)<$length){
        return true ;
    }else{
        return false ;
    }

}

function maxVal($input,$length){
    if(strlen($input)>$length){
        return true ;
    }else{
        return false ;
    }

}


function emailVal($email){
   if (filter_var($email,FILTER_VALIDATE_EMAIL)){
    return true ;
   }else{
    return false ;
   }


}

 
 