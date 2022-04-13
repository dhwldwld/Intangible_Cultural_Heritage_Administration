<?php
    include('lib/lib.php');

    $dir = "xmldata/detail";
    $handle  = opendir($dir);

    $files = array();
    while (false !== ($filename = readdir($handle))) {
        if ($filename == '.' || $filename == '..') {
            continue;
        }

        if (is_file($dir.'/'.$filename)) {
            array_push($files, $dir.'/'.$filename);
        }
    }
    closedir($handle);

    foreach ($files as $thisfile) {
        $xml = simplexml_load_file($thisfile);
        
        $query = 'INSERT into nihlist_dtl values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
        query($query, array($xml->ccbaKdcd, $xml->ccbaAsno, $xml->ccbaCtcd, $xml->ccbaCpno, $xml->longitude, $xml->latitude, $xml->item->ccmaName, $xml->item->crltsnoNm, $xml->item->ccbaMnm1, $xml->item->ccbaMnm2, $xml->item->gcodeName, $xml->item->bcodeName, $xml->item->mcodeName, $xml->item->scodeName, $xml->item->ccbaQuan, $xml->item->ccbaAsdt, $xml->item->ccbaCtcdNm, $xml->item->ccsiName, $xml->item->ccbaLcad, $xml->item->ccceName, $xml->item->ccbaPoss, $xml->item->ccbaAdmin, $xml->item->ccbaCncl, $xml->item->ccbaCndt, $xml->item->imageUrl, $xml->item->content));
    }
?>