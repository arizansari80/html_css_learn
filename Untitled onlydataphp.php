<?php
	$str=stristr("DL Delhi MU Mumbai CH Chennai KO Kolkata","deLHI",true);
	$str=substr($str,strlen($str)-3,2);
	$abc="IBSN0011553";
	$pr=substr($abc,5);
	print "$str"."This is message";
	print "<br>$pr";
?>