<?php
    echo"<H1>Đặng Thị Thùy - DH52201546 - D22_TH12</H1>";    

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