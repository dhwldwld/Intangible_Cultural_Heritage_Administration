<?php
    include('lib/lib.php');

    $showUid = $_POST['id'];
    $showName = $_POST["showName"];
    $showDate = $_POST["showDate"];
    $showTime = $_POST["showTime"];

	$sql = "UPDATE tb_show SET showName=?, showDate=?, showTime=? WHERE showUid=?";
	$result = query($sql, array($showName, $showDate, $showTime,$showUid));  

	if($result) {
		$result = "OK";
	}

    echo (json_encode($result));
?>
