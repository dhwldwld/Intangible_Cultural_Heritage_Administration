<style>
    .card-img::before {
        position: absolute;
        content: "no image";
        width: 100%;
        line-height: 180px;
        text-align: center;
        left: 50%;
        background-color: #ccc;
        transform: translateX(-50%);
    }
</style>
<div class="container-lg">
    <div class="d-flex justify-content-between">
        <h3 class="px-5 pt-5 d-inlineblock">무형문화재 현황</h3>
        <p class="pe-5 pt-5">홈 > 무형문화재 현황</p>
    </div>
    <hr class="m-2">
    <div class="d-flex justify-content-between px-3">
        <p>1/20p</p>
        <ul class="nav nav-pills my-1">
            <li class="nav-item">
                <a href="#cultural-album" class="nav-link active" data-bs-toggle="pill">앨범</a>
            </li>
            <li class="nav-item">
                <a href="#cultural-list" class="nav-link" data-bs-toggle="pill">목록</a>
            </li>
        </ul>
    </div>
    <hr class="m-2">
    <div class="tab-content my-5" id="pills-contents">
        <div class="tab-pane fade show active" id="cultural-album">
            <div class="row">
            </div>
        </div>
        <div class="tab-pane fade" id="cultural-list">
            <table class="table table-light table-hover my-3 text-center">
                <thead class="thead-light">
                    <tr>
                        <th>순번</th>
                        <th>종목</th>
                        <th>명칭</th>
                        <th>소재지</th>
                        <th>관리자(단체)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>국가무형문화재 제1호</td>
                        <td>종묘제례악</td>
                        <td>서울</td>
                        <td>(사)국가무형문화재 종묘제례악보존회</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>국가무형문화재 제2호</td>
                        <td>양주별산대놀이</td>
                        <td>경기 양주시</td>
                        <td>(사)국가무형문화재 제2호 양주별산대놀이보존회</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>국가무형문화재 제3호</td>
                        <td>남사당놀이</td>
                        <td>서울</td>
                        <td>남사당놀이보존회</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>국가무형문화재 제4호</td>
                        <td>갓일</td>
                        <td>기타</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>국가무형문화재 제5호</td>
                        <td>판소리</td>
                        <td>기타 .</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>국가무형문화재 제6호</td>
                        <td>통영오광대</td>
                        <td>경남 통영시</td>
                        <td>(사)국가무형문화재 제6호 통영오광대보존회</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>국가무형문화재 제7호</td>
                        <td>고성오광대</td>
                        <td>경남 고성군</td>
                        <td>(사)국가무형문화재 제7호 고성오광대보존회</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>국가무형문화재 제8호</td>
                        <td>강강술래</td>
                        <td>전남 진도군</td>
                        <td>(사)국가무형문화재 강강술래보존회</td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>국가무형문화재 제9호</td>
                        <td>은산별신제</td>
                        <td>충남 부여군</td>
                        <td>(사)국가무형문화재 은산별신제</td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>국가무형문화재 제10호</td>
                        <td>나전장</td>
                        <td>강원 원주시</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="d-flex justify-content-center mb-3">
        <div aria-label="Page navigation">
            <ul class="pagination" id="cultural-pagination">
            </ul>
        </div>
    </div>
</div>

<script>
    let totalCnt = 0;
    let currentPageIndex = 1;
    let finalpageIndex = -1;
    $(document).ready(() => {
        updateLayout();
        selectIndex(1);
    })

    const updateLayout = () => {
        $.ajax({
            url: 'xmldata/nihList.xml',
            type: 'GET',
            dataType: 'xml',
            cache: false,
            async: false,
            success: (res) => {
                res = $(res);
                totalCnt = parseInt(res.find('totalCnt').text());
                finalpageIndex = Math.ceil(totalCnt / 8);

                let items = res.find('item');

                $('#cultural-album .row .col-12').remove();

                for (let i = (currentPageIndex - 1) * 8; i < currentPageIndex * 8; i++) {
                    let parent = $('#cultural-album .row');

                    let item = $(items[i]);
                    let ccbaMnm1 = item.find("ccbaMnm1").text();
                    let ccbaKdcd = item.find("ccbaKdcd").text();
                    let ccbaCtcd = item.find("ccbaCtcd").text();
                    let ccbaAsno = item.find("ccbaAsno").text();
                    let imageUrl = "";

                    $.ajax({
                        url: `xmldata/detail/${ccbaKdcd}_${ccbaCtcd}_${ccbaAsno}.xml`,
                        type: 'GET',
                        dataType: 'xml',
                        cache: false,
                        async: false,
                        success: (res) => {
                            imageUrl = $(res).find('imageUrl').text();
                        }
                    })

                    let obj = $(`
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="card">
                                <img src="/xmldata/nihcImage/${imageUrl}" class="card-img-top card-img position-relative" alt="${ccbaMnm1}" style="object-fit: cover; height: 180px;">
                                <div class="card-body">
                                    <p class="card-text">${ccbaMnm1}</p>
                                </div>
                            </div>
                        </div>
                    `)

                    parent.append(obj);
                }
            }
        })
    }

    const selectIndex = (obj) => {
        let str = '';
        let index = -1;
        
        if (typeof obj === 'object') {
            str = $(obj).text().trim();
        } else {
            str = obj;
        }

        if (parseInt(str)) {
            index = parseInt(str);
        }

        switch (str) {
            case '<<':
                currentPageIndex = 1;
                break;
            case '<':
                if (currentPageIndex - 1 >= 1) {
                    currentPageIndex--;
                }
                break;
            case '>':
                if (currentPageIndex + 1 <= finalpageIndex) {
                    currentPageIndex++;
                }
                break;
            case '>>':
                currentPageIndex = finalpageIndex;
                break;
            default:
                currentPageIndex = index;
                break;
        }

        let tmp_i = 0;
        
        if (currentPageIndex - 5 < 0) {
            tmp_i = 1;
        } else if (currentPageIndex - 5 >= 0 && currentPageIndex + 5 <= finalpageIndex) {
            tmp_i = currentPageIndex - 4;
        } else if (currentPageIndex + 5 > finalpageIndex) {
            tmp_i = finalpageIndex - 8;
        }

        $('#cultural-pagination li').remove();

        let parent = $('#cultural-pagination');

        obj = $(`
            <li class="page-item">
                <a class="page-link" onClick="selectIndex(this)">
                    &lt;&lt;
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" onClick="selectIndex(this)">
                    &lt;
                </a>
            </li>
        `)

        parent.append(obj);

        for (let i = tmp_i; i < tmp_i + 9; i++) {
            obj = $(`
                <li class="page-item">
                    <a class="page-link" onClick="selectIndex(${i})">
                        ${i}
                    </a>
                </li>
            `)

            if (i === currentPageIndex) {
                obj.addClass('active');
            }

            parent.append(obj);
        }

        obj = $(`
        <li class="page-item">
            <a class="page-link" onClick="selectIndex(this)">
                &gt;
            </a>
        </li>
        <li class="page-item">
            <a class="page-link" onClick="selectIndex(this)">
                &gt;&gt;
            </a>
        </li>
        `)

        parent.append(obj);

        updateLayout();
    }
</script>