<?php
    include('lib/lib.php');
    $ccbaKdcd = $_POST["ccbaKdcd"];
    $ccbaCtcd = $_POST["ccbaCtcd"];
    $ccbaAsno = $_POST["ccbaAsno"];

    $ccbaMnm1 = $_POST["ccbaMnm1"];
    $ccbaLcad = $_POST["ccbaLcad"];
    $ccbaAdmin = $_POST["ccbaAdmin"];

	$sql = "select (max(sn) + 1) as sn from nihlist_mst";
	$sn = getRow($sql, null)->sn;

	$sql = "select (max(no) + 1) as no from nihlist_mst";
	$no = getRow($sql, null)->no;

 
	$sql = "insert into nihlist_mst(sn, no, ccbaKdcd, ccbaCtcd, ccbaAsno, ccbaMnm1, ccbaAdmin) values(?,?,?,?,?,?,?)";
	$result1 = query($sql, array($sn, $no, $ccbaKdcd, $ccbaCtcd, $ccbaAsno, $ccbaMnm1, $ccbaAdmin));

	$sql = "insert into nihlist_dtl(ccbaKdcd, ccbaCtcd, ccbaAsno, ccbaMnm1, ccbaLcad, ccbaAdmin) values(?,?,?,?,?,?)";
	$result2 = query($sql, array($ccbaKdcd, $ccbaCtcd, $ccbaAsno, $ccbaMnm1, $ccbaLcad, $ccbaAdmin));

    if($result1 && $result2) {
		$result = "OK";
	}

    echo (json_encode($result));
?>