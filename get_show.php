<?php
    include ('lib/lib.php');

    $year = $_POST['year'];
    $month = $_POST['month'];

    $start_date = $year.'-'.$month.'-01';
	$end_date = $year . "-" . $month . "-31";

    $sql = "
    SELECT GROUP_CONCAT(showUid order by showUid asc) as showUid, 
		   GROUP_CONCAT(showName order by showUid asc) as showName, showDate,
		   GROUP_CONCAT(showTime order by showUid asc) as  showTime,
		   GROUP_CONCAT(organizer order by showUid asc) as  organizer,
		   GROUP_CONCAT(place order by showUid asc) as  place,
		   GROUP_CONCAT(cast order by showUid asc) as  cast,
		   GROUP_CONCAT(rm order by showUid asc) as  rm,
		   GROUP_CONCAT(registDt order by showUid asc) as  registDt,
		   GROUP_CONCAT(updtDt order by showUid asc) as  updtDt 
           FROM tb_show
           WHERE showDate between ? and ? 
           group by showDate
    ";
    $result = getRowAll($sql, array($start_date, $end_date));

    echo json_encode($result);
?>