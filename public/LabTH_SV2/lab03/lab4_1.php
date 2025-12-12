<?php
    echo"<H1>Đặng Thị Thùy - DH52201546 - D22_TH12</H1>";    

    $tong = 0;
    for($i=2;$i<=100;$i++) {
        if($i%2==0){
            $tong+=$i;
        }
    }
    echo $tong;
?>