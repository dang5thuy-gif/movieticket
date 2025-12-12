<?php
    echo"<H1>Đặng Thị Thùy - DH52201546 - D22_TH12</H1>";    

echo"nang cao". "<br>";
    $a = array(6, 2, 7, 8, 5,9,20);
	showArraytable($a);
	function showArraytable($arr)
	{
		echo"<table border=1>";
		echo"<tr><td>Key</td><td>Value</td></tr>";
			foreach($arr as $k=>$v)
			{	
				echo "<td>$k</td>";
				echo "<td>$v</td></tr>";
			}
		echo"</table>";
	}
?>