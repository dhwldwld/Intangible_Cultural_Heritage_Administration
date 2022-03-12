<?php
session_start();
/*
comment: 조건에 맞는 JSON 내용 제작 후 반환
*/

/* 생성될 데이터 갯수(평가시 변경) */
$telphoneSize = 31;

/* 결과 객체 */
$result = array();

/* 타입*/


$typeArr = array("기획운영과", "기획서무", "홍보", "시설", "전승지원과", "전승활성", "이수심사", "조사연구기록과", "조사연구", "기록화사업", "무형유산진흥과", "교육협력", "전시", "공연");

/* 평가시 변경(주최 기관) */
$hostOrg = "고용노동부|C|각 시도|C|각 시도 교육청";

/* 평가시 변경(주관 기관) */
$mainOrg = "국제기능올림픽대회 한국기술위원회(한국산업인력공단)|C|각 시도 기능경기위원회(각 시도 한국산업인력공단)|C|마이스터기능경기협회";


/* 필수 입력 값 체크
if(!isset($_REQUEST['pageNo']) || !isset($_REQUEST['numOfRows']) || !isset($_REQUEST['scaleId']))
{
	$result['statusCd'] = "401";
	$result['statusMsg'] = "입력값이 올바르지 않습니다.";
	echo json_encode($result);
	exit;
}
*/

/* 데이터 생성 시작 */
$result['statusCd'] = "200";
$result['statusMsg'] = "정상";

$result['totalCount'] = $telphoneSize;



/* 컬렉션 정보 생성 */
$telphoneList = array();

for($i = 0; $i < $telphoneSize; $i++)
{
	$telNo = rand(1000, 9999);
	$ty = rand(0, count($typeArr) - 1);
	
	$telphoneArr = array(
		"sn" => $i+1,
		"deptNm" => $typeArr[$ty], 
		"name" => "홍길동" . ($i+1), 
		"telNo" => $telNo
	 );
	 
	 $telphoneList[] = $telphoneArr;
	 
}

$result['items'] = $telphoneList;

if(isset($_SESSION['phoneReqCnt']))
{
	$phoneReqCnt = $_SESSION['phoneReqCnt'];
	$phoneReqCnt++; 
	$phoneReqCnt = $_SESSION['phoneReqCnt'] = $phoneReqCnt;
}
else 
{
	$phoneReqCnt = $_SESSION['phoneReqCnt'] = 0;
}

if($phoneReqCnt % 5 == 0)
{
	$result['statusCd'] = "411";
	$result['statusMsg'] = "데이터베이스에 연결할 수 없습니다.";	
}
else
{
	$result['statusCd'] = "200";
	$result['statusMsg'] = "정상";
	
}


echo json_encode($result);
?>