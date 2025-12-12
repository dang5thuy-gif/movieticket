<?php
    echo"<H1>Nguyễn Thị Thanh Tuyền - DH52201742 - D22_TH04</H1>";    

function kiem_tra_chuoi_palindrome($string)   
        {  
            echo 'Chuổi hiện tại: $string';
            echo 'Chuổi đảo: '. strrev($string);
          if ($string == strrev($string))  
          {
                echo 'Chuổi đối xứng';
                return 1;
                
          }
          else  
          {
                echo 'Chuổi ko đối xứng';
                 return 0;
                
          }
        }  
kiem_tra_chuoi_palindrome("abcba");
?>