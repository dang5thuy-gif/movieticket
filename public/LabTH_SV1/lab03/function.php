<?php
    echo"<H1>Nguyễn Thị Thanh Tuyền - DH52201742 - D22_TH04</H1>";    
function tongHop() {
    $functions = ['BCC','BanCo'];
    $result="";
    foreach($functions as $value) {
        if(function_exists($value)) {
            $result.=$value()."";
        }
    }
    return trim($result);
}
    echo tongHop();
?>