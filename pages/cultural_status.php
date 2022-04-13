<?php
    $bcodeName = URLDecode($_GET['bcodeName']);
?>

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
<div class="modal fade" id="cultural-insert-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">문화재 등록</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type=hidden id="cultural-insert-ccbaKdcd" name=cultural-insert-ccbaKdcd value="17">
                <div class="form-group">
                    <label for="cultural-insert-ccbaCtcd" class="form-label">시도코드<sup style="color: red;">*</sup>: </label>
                    <input type="text" id="cultural-insert-ccbaCtcd" name="cultural-insert-ccbaCtcd" required>
                </div>
                <div class="form-group">
                    <label for="cultural-insert-ccbaAsno" class="form-label">지정번호<sup style="color: red;">*</sup>: </label>
                    <input type="text" id="cultural-insert-ccbaAsno" name="cultural-insert-ccbaAsno" required>
                </div>
                <div class="form-group">
                    <label for="cultural-insert-name" class="form-label">문화재명<sup style="color: red;">*</sup>: </label>
                    <input type="text" id="cultural-insert-name" name="cultural-insert-name" required>
                </div>
                <div class="form-group">
                    <label for="cultural-insert-location" class="form-label">소재지: </label>
                    <input type="text" id="cultural-insert-location" name="cultural-insert-location">
                </div>
                <div class="form-group">
                    <label for="cultural-insert-admin" class="form-label">관리자(단체): </label>
                    <input type="text" id="cultural-insert-admin" name="cultural-insert-admin">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary" onclick="culturalInsert();">등록</button>
            </div>
        </div>
    </div>
</div>
<div class="container-lg">
    <div class="d-flex justify-content-between">
        <h3 class="px-5 pt-5 d-inlineblock">무형문화재 현황</h3>
        <p class="pe-5 pt-5">홈 > 무형문화재 현황 <?php if ($bcodeName) { echo '> '.$bcodeName; } ?></p>
    </div>
    <hr class="m-2">
    <div class="d-flex justify-content-between px-3 align-items-center">
        <p id="page-info" class="m-0 fw-bold">/p</p>
        <ul class="nav nav-pills my-1">
            <li class="nav-item">
                <a href="#cultural-album" class="nav-link active" data-bs-toggle="pill" onclick="enumerateType(this);">앨범</a>
            </li>
            <li class="nav-item">
                <a href="#cultural-list" class="nav-link" data-bs-toggle="pill" onclick="enumerateType(this);">목록</a>
            </li>
        </ul>
    </div>
    <hr class="m-2">
    <div class="d-flex justify-content-end px-3 align-items-center">
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#cultural-insert-modal">등록</button>
    </div>
    
    <div class="tab-content my-3" id="pills-contents">
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
    let numOfRows = 8;
    let listType = 'album';
    let bcodeName = "";

    $(document).ready(() => {
        selectIndex(1);
    })

    const enumerateType = (obj) => {
        let type = $(obj).text();

        if (type == '앨범') {
            currentPageIndex = 1;
            numOfRows = 8;
            listType = 'album';
        } else if (type == '목록') {
            currentPageIndex = 1;
            numOfRows = 10;
            listType = 'list';
        }
        updateLayout();
    }

    const getNihList = () => {
        let returnVal = "";
        $.ajax({
            url: 'openAPI/nihList.php',
            type: 'POST',
            data: { 'pageNo': currentPageIndex,  'numOfRows': numOfRows, 'bcodeName': <? if ($bcodeName) { echo "\"".$bcodeName."\""; } else { echo "\"\""; } ?>},
            cache: false,
            async: false,
            success: (res) => {
                returnVal = JSON.parse(res);
            }
        })

        return returnVal;
    }

    const updateLayout = () => {
        let result = getNihList();

        totalCnt = result.totalCount;
        finalpageIndex = Math.ceil(totalCnt / numOfRows);

        $('#page-info').text(`총 ${totalCnt}건 ${currentPageIndex}/${finalpageIndex}p`);

        let items = result.items;

        $('#cultural-album .row .col-12').remove();
        $('#cultural-list tbody tr').remove();

        if (listType == 'album') {
            let parent = $('#cultural-album .row');

            for (let i = 0; i < numOfRows; i++) {
                let item = items[i];
                if (item) {
                    let ccbaMnm1 = item.ccbaMnm1;
                    let image = item.image;

                    if (image) {
                        image = image;
                    } else {
                        image = "";
                    }

                    let obj = $(`
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="card">
                                <img src="${image}" class="card-img-top card-img position-relative" alt="${ccbaMnm1}" style="object-fit: cover; height: 180px;">
                                <div class="card-body">
                                    <p class="card-text">${ccbaMnm1}</p>
                                </div>
                            </div>
                        </div>
                    `)

                    parent.append(obj);
                } else {
                    break;
                }
            }  
        } else if (listType == 'list') {
            let parent = $('#cultural-list tbody');
            let no = 0;

            for (let i = 0; i < numOfRows; i++) {
                no++;
                let item = items[i];
                if (item) {
                    let ccbaMnm1 = item.ccbaMnm1;
                    let ccmaName = item.ccmaName;
                    let ccbaLcad = item.ccbaLcad;
                    let ccbaAdmin = item.ccbaAdmin;

                    let obj = $(`
                        <tr>
                            <td>${no}</td>
                            <td>${ccmaName}</td>
                            <td>${ccbaMnm1}</td>
                            <td>${ccbaLcad}</td>
                            <td>${ccbaAdmin}</td>
                        </tr>
                    `);

                    parent.append(obj);
                } else {
                    break;
                }
            }  
        }
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

    const culturalInsert = () => {
        let ccbaKdcd = $('#cultural-insert-ccbaKdcd').val();
        let ccbaCtcd = $('#cultural-insert-ccbaCtcd').val();
        let ccbaAsno = $('#cultural-insert-ccbaAsno').val();

        let ccbaMnm1 = $('#cultural-insert-name').val();
        let ccbaLcad = $('#cultural-insert-location').val();
        let ccbaAdmin = $('#cultural-insert-admin').val();

        $.ajax({
            url: 'insert_cultural.php',
            type: 'POST',
            data: {
                'ccbaKdcd': ccbaKdcd,
                'ccbaCtcd': ccbaCtcd,
                'ccbaAsno': ccbaAsno,
                'ccbaMnm1':ccbaMnm1,
                'ccbaLcad':ccbaLcad,
                'ccbaAdmin':ccbaAdmin
            },
            cache: false,
            async: false,
            success: (res) => {
                result = JSON.parse(res);
                if(result == "OK") {
                    $('#cultural-insert-ccbaKdcd').val('');
                    $('#cultural-insert-ccbaCtcd').val('');
                    $('#cultural-insert-ccbaAsno').val('');
                    $('#cultural-insert-name').val('');
                    $('#cultural-insert-location').val('');
                    $('#cultural-insert-admin').val('');
                    $('#cultural-insert-modal').modal('hide');
                    updateLayout();
                }
            }
        })
    }
</script>