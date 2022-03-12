<?php
    include('lib/lib.php');
    $showName = $_POST["showName"];
    $showDate = $_POST["showDate"];
    $showTime = $_POST["showTime"];

	$sql = "insert into tb_show(showName, showDate, showTime) values(?,?,?)";
	$result = query($sql, array($showName, $showDate, $showTime));  

	if($result) {
		$result = "OK";
	}

    echo (json_encode($result));
?>
