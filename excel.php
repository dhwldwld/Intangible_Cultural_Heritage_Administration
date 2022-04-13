<?php
    include('lib/lib.php');

	$xml = simplexml_load_file('xmldata/nihList.xml');

    foreach ($xml as $key => $value) {
        if ($key == 'item') {
            $query = 'INSERT into nihlist_mst values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
            query($query, array($value->sn, $value->no, $value->ccmaName, $value->crltsnoNm, $value->ccbaMnm1, $value->ccbaMnm2, $value->ccbaCtcdNm, $value->ccsiName, $value->ccbaAdmin, $value->ccbaKdcd, $value->ccbaCtcd, $value->ccbaAsno, $value->ccbaCncl, $value->ccbaCpno, $value->longitude, $value->latitude));
        }
    }
?>