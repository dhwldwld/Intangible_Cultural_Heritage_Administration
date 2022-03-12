CREATE TABLE `nihlist_dtl` (
  `ccbaKdcd` varchar(100) NOT NULL,
  `ccbaAsno` varchar(100) NOT NULL,
  `ccbaCtcd` varchar(100) NOT NULL,
  `ccbaCpno` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `ccmaName` varchar(100) NOT NULL,
  `crltsnoNm` varchar(100) NOT NULL,
  `ccbaMnm1` varchar(100) NOT NULL,
  `ccbaMnm2` varchar(100) NOT NULL,
  `gcodeName` varchar(100) NOT NULL,
  `bcodeName` varchar(100) NOT NULL,
  `mcodeName` varchar(100) NOT NULL,
  `scodeName` varchar(100) NOT NULL,
  `ccbaQuan` varchar(100) NOT NULL,
  `ccbaAsdt` varchar(100) NOT NULL,
  `ccbaCtcdNm` varchar(100) NOT NULL,
  `ccsiName` varchar(100) NOT NULL,
  `ccbaLcad` varchar(100) NOT NULL,
  `ccceName` varchar(100) NOT NULL,
  `ccbaPoss` varchar(100) NOT NULL,
  `ccbaAdmin` varchar(100) NOT NULL,
  `ccbaCncl` varchar(100) NOT NULL,
  `ccbaCndt` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 테이블 구조 `nihlist_mst`
--

CREATE TABLE `nihlist_mst` (
  `sn` int(11) NOT NULL,
  `no` int(11) NOT NULL,
  `ccmaName` varchar(100) NOT NULL,
  `crltsnoNm` varchar(100) NOT NULL,
  `ccbaMnm1` varchar(100) NOT NULL,
  `ccbaMnm2` varchar(100) NOT NULL,
  `ccbaCtcdNm` varchar(100) NOT NULL,
  `ccsiName` varchar(100) NOT NULL,
  `ccbaAdmin` varchar(100) NOT NULL,
  `ccbaKdcd` varchar(100) NOT NULL,
  `ccbaCtcd` varchar(100) NOT NULL,
  `ccbaAsno` varchar(100) NOT NULL,
  `ccbaCncl` varchar(100) NOT NULL,
  `ccbaCpno` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `latitude` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- 테이블 구조 `tb_show`
--

CREATE TABLE `tb_show` (
  `showUid` int(11) NOT NULL,
  `showName` varchar(300) NOT NULL,
  `showDate` varchar(40) NOT NULL,
  `showTime` varchar(40) NOT NULL,
  `organizer` varchar(100) NOT NULL,
  `place` varchar(100) NOT NULL,
  `cast` varchar(100) NOT NULL,
  `rm` varchar(100) NOT NULL,
  `registDt` datetime NOT NULL DEFAULT current_timestamp(),
  `updtDt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `tb_show`
--

INSERT INTO `tb_show` (`showUid`, `showName`, `showDate`, `showTime`, `organizer`, `place`, `cast`, `rm`, `registDt`, `updtDt`) VALUES
(2, '자유공연', '2022-02-19', '14:00', '미정', '미정', '미정', '미정', '2022-02-23 12:47:17', '2022-02-23 04:47:03'),
(3, '	\r\n야외일정2', '2022-02-18', '11:00', '미정', '미정', '미정', '미정', '2022-02-23 12:48:33', '2022-02-23 04:48:21');
