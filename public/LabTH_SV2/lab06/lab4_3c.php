<?php
    echo"<H1>Đặng Thị Thùy - DH52201546 - D22_TH12</H1>";    
    $url = 'https://vnexpress.net/the-thao';
    $content = file_get_contents($url);
    echo $content;
?>