<?php
    include('../lib/lib.php');

    $pageNo = $_POST["pageNo"];  //필수
    $numOfRows = $_POST["numOfRows"]; //필수

    if(!$pageNo || !$numOfRows)
    {
        echo "필수항목 누락";
        exit;
    }

    $bcodeName = $_POST["bcodeName"]; //포함 LIKE 검색
    if(!$bcodeName) {
        $bcodeName = "";
    }

    $start = ($pageNo - 1) * $numOfRows;

    $sql = " SELECT count(A.no) as cnt FROM nihlist_mst A LEFT OUTER join nihlist_dtl B
    ON A.ccbaKdcd = B.ccbaKdcd and A.ccbaCtcd=B.ccbaCtcd and A.ccbaAsno=B.ccbaAsno  
    WHERE INSTR(B.bcodeName, ?) > 0
    ";
    $result = getRow($sql, array($bcodeName));    
	$totalCnt = $result->cnt;
	
    $sql = " SELECT A.no, A.ccbaKdcd, A.ccbaAsno, A.ccbaCtcd, A.ccbaCpno, A.ccmaName, A.ccbaMnm1, A.ccbaMnm2,
    B.gcodeName , B.bcodeName, B.mcodeName, B.scodeName, B.ccbaQuan, B.ccbaAsdt, B.ccbaCtcdNm, B.ccsiName, 
    B.ccbaLcad, B.ccceName, B.ccbaPoss, B.ccbaAdmin, B.ccbaCncl, B.ccbaCndt, B.image AS image, B.content
    FROM nihlist_mst A LEFT OUTER join nihlist_dtl B
    ON A.ccbaKdcd = B.ccbaKdcd and A.ccbaCtcd=B.ccbaCtcd and A.ccbaAsno=B.ccbaAsno  
    WHERE INSTR(B.bcodeName, ?) > 0
    limit $start , $numOfRows
    ";
    $result = getRowAll($sql, array($bcodeName));    

    $items = array();
    foreach($result as $row) {
        $item["ccbaKdcd"] = $row->ccbaKdcd;
        $item["ccbaAsno"] = $row->ccbaAsno;
        $item["ccbaCtcd"] = $row->ccbaCtcd;
        $item["ccbaCpno"] = $row->ccbaCpno;
        $item["ccmaName"] = $row->ccmaName;
        $item["ccbaMnm1"] = $row->ccbaMnm1;
        $item["ccbaMnm2"] = $row->ccbaMnm2;
        $item["gcodeName"] = $row->gcodeName;
        $item["bcodeName"] = $row->bcodeName;
        $item["mcodeName"] = $row->mcodeName;
        $item["scodeName"] = $row->scodeName;
        $item["ccbaQuan"] = $row->ccbaQuan;
        $item["ccbaAsdt"] = $row->ccbaAsdt;                                                                              
        $item["ccbaCtcdNm"] = $row->ccbaCtcdNm;
        $item["ccsiName"] = $row->ccsiName;
        $item["ccbaLcad"] = $row->ccbaLcad;
        $item["ccceName"] = $row->ccceName;
        $item["ccbaPoss"] = $row->ccbaPoss;
        $item["ccbaAdmin"] = $row->ccbaAdmin;
        $item["ccbaCncl"] = $row->ccbaCncl;
        $item["ccbaCndt"] = $row->ccbaCndt;                       

        $imagecontent = null;
        $path = 'C:\\xampp\\nihcImage\\' . $row->image;
        if($row->image && file_exists($path)) {
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $imagecontent = 'data:image/' . $type . ';base64,' . base64_encode($data);
        }
        
        $item["image"] = $imagecontent;                                                                                                                                                
        $item["content"] = $row->content;                                                                                                                                                        
        array_push($items, $item);
    }

    $output = array();
    $output["numOfRows"] = $numOfRows;
    $output["pageNo"] = $pageNo;    
    $output["totalCount"] = $totalCnt;        
    $output["items"] = $items;

    echo (json_encode($output));
?>