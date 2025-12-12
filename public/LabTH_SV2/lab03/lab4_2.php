<?php
    echo"<H1>Đặng Thị Thùy - DH52201546 - D22_TH12</H1>";    

    $tong = 0;
    $i = 1;
    while($tong<=1000){
        $tong += $i;
        $i = $i + 1;
    }
    echo $i . " la n nho nhat de tong 1 + 2 + ... + n > 1000";
    echo "xai while";
?>