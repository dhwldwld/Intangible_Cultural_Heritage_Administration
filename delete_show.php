<?php
    include('lib/lib.php');

    $showUid = $_GET['id'];

	$sql = "DELETE FROM tb_show WHERE showUid = ?";
	$result = query($sql, array($showUid));  

	if($result) {
		$result = "OK";
	}

    echo (json_encode($result));
?>
