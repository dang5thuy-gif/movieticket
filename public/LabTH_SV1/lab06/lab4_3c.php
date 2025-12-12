<?php
    echo"<H1>Nguyễn Thị Thanh Tuyền - DH52201742 - D22_TH04</H1>";    
    
    $url = 'https://vnexpress.net/the-thao';
    $content = file_get_contents($url);
    echo $content;
?>