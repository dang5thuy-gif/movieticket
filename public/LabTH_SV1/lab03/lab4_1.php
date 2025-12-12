<?php
    echo"<H1>Nguyễn Thị Thanh Tuyền - DH52201742 - D22_TH04</H1>";    

    $tong = 0;
    for($i=2;$i<=100;$i++) {
        if($i%2==0){
            $tong+=$i;
        }
    }
    echo $tong;
?>