<style>
    td {
        height: 180px;
    }
</style>
<?php
    if(isset($_GET["year"]) && $_GET["year"] && isset($_GET["month"]) && $_GET["month"]) {
		$year = $_GET["year"]; //현재 년도
		$month = $_GET["month"];  //현재 월
	}
	else {
		$year = date("Y"); //현재 년도
		$month = date("m");  //현재 월
	}

    $this_date = strtotime($year."-".$month."-01");
    $preYear = date("y", strtotime("-1 month",$this_date));
    $preMonth = date("m", strtotime("-1 month",$this_date));

    $nextYear = date("y", strtotime("+1 month",$this_date));
    $nextMonth = date("m", strtotime("+1 month",$this_date));
?>
<div class="modal fade" id="date-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="date-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="date-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
            </div>
        </div>
    </div>
</div>

<!--schedule-insert-Modal -->
<div class="modal fade" id="schedule-insert-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">일정 등록</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="schedule-insert-name" class="form-label">공연명<sup style="color: red;">*</sup>: </label>
                    <input type="text" id="schedule-insert-name" name="schedule-insert-name" required>
                </div>
                <div class="form-group">
                    <label for="schedule-insert-date" class="form-label">공연일<sup style="color: red;">*</sup>: </label>
                    <input type="date" id="schedule-insert-date" name="schedule-insert-date" required>
                </div>
                <div class="form-group">
                    <label for="schedule-insert-time" class="form-label">공연시간<sup style="color: red;">*</sup>: </label>
                    <input type="time" id="schedule-insert-time" name="schedule-insert-time" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary" onclick="scheduleInsert();">등록</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="schedule-edit-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">일정 수정</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="schedule-edit-uid" name="schedule-edit-uid" value="-1">
                <div class="form-group">
                    <label for="schedule-edit-name" class="form-label">공연명<sup style="color: red;">*</sup>: </label>
                    <input type="text" id="schedule-edit-name" name="schedule-edit-name" required>
                </div>
                <div class="form-group">
                    <label for="schedule-edit-date" class="form-label">공연일<sup style="color: red;">*</sup>: </label>
                    <input type="date" id="schedule-edit-date" name="schedule-edit-date" required>
                </div>
                <div class="form-group">
                    <label for="schedule-edit-time" class="form-label">공연시간<sup style="color: red;">*</sup>: </label>
                    <input type="time" id="schedule-edit-time" name="schedule-edit-time" required>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="scheduleDelete();">삭제</button>
                <div>
                    <button type="button" class="btn btn-primary" onclick="scheduleUpdate();">수정</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-lg">
    <div class="d-flex justify-content-between">
        <h3 class="px-5 pt-5 d-inlineblock">월간 공연 일정</h3>
        <p class="pe-5 pt-5">홈 > 행사 안내 > 공연 > 월간 공연 일정</p>
    </div>
    <hr class="m-2">
    <div class="p-4">
        <div class="d-flex justify-content-center align-items-center">
            <a class="text-secondary text-decoration-none" href="/month_calendar.php?year=<?=$preYear?>&month=<?=$preMonth?>"><h5><?=$preYear?>년 <?=$preMonth?>월</h5></a>
            <h4 class="mx-3"><?=$year?>년 <?=$month?>월</h4>
            <a class="text-secondary text-decoration-none" href="/month_calendar.php?year=<?=$nextYear?>&month=<?=$nextMonth?>"><h5><?=$nextYear?>년 <?=$nextMonth?>월</h5></a>
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#schedule-insert-modal">일정 등록</button>
        </div>
        <table class="table table-light text-center">
            <thead>
                <tr>
                    <th class="sun">일</th>
                    <th>월</th>
                    <th>화</th>
                    <th>수</th>
                    <th>목</th>
                    <th>금</th>
                    <th class="sat">토</th>
                </tr>
            </thead>
            <tbody class="text-start" id="calendar">
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(() => {
        updateLayout();
    })

    const makeTwoLen = (num) => {
        if(num) {
            if(num.length == 1)
            {
                num = `0${num}`;
            }
        }
        return num;
    }

    const getShowList = () => {
        let returnVal = "";
        $.ajax({
            url: 'get_show.php',
            type: 'POST',
            data: {'year': <?=$year?>, 'month':<?=$month?>},
            cache: false,
            async: false,
            success: (res) => {
                returnVal = JSON.parse(res);
            }
        })

        return returnVal;
    }

    const updateLayout = () => {
        let firstDate = new Date(<?=$year?>, <?=$month?>, 1);
        let lastDate = new Date(<?=$year?>, <?=$month?>, 0);
        let firstDay = firstDate.getDay();
        let lastDay = lastDate.getDate();
        let totalRow = Math.ceil((firstDay + lastDay) / 7);

        emptyIdx = 0;
        dayIdx = 1;
        $('#calendar').find('tr').remove();
        for (let i = 0; i < totalRow; i++) {
            let parent = $('#calendar');
            let obj = $(`<tr class="tr-${i}"></tr>`);
            parent.append(obj);

            parent = $(`#calendar .tr-${i}`);
            for(let j = 0; j < 7; j++) {
                let displayDay = "";
                if (emptyIdx < firstDay) {
                    displayDay = "";
                } else if (dayIdx > lastDay) {
                    displayDay = "";
                } else {
                    displayDay = dayIdx;
                    dayIdx++;
                }
                obj = $(`
                    <td>
                        <div class="mb-3">${displayDay}</div>
                        <div id="<?=$year."-".$month?>-${makeTwoLen(String(displayDay))}" class="class_date_obj" data-bs-toggle="modal" data-bs-target="#date-modal">
                        </div>
                    </td>
                `);

                parent.append(obj);
                emptyIdx++;
            }
        }
        
        $('.class_date_obj').html('');
        let showList = getShowList();
        for (let i = 0; i < showList.length; i++) {
            let showUid = showList[i].showUid.split(',');
            let showName = showList[i].showName.split(',');
            let date = showList[i].showDate;
            let showTime = showList[i].showTime.split(',');

            let totalCnt = showName.length;
            let count3 = showName.length;
            let isOver = false;

            if (totalCnt > 3) { 
                count3 = 3;
                isOver = true;
            }
            let parent = $(`#${date}`);
            for (let j = 0; j < count3; j++) {
                let obj = $(`
                    <div style='text-align:left; margin-bottom:4px; background-color: #ccc;'> ${showName[j]} </div>
                `);
                parent.append(obj);

            }
            if(isOver == true) {
                let obj = $(`
                    <div style='text-align:left; margin-bottom:4px'> .... (총 ${totalCnt}) </div>
                `);
                parent.append(obj);
            }

            parent.click(() => {
                $('#date-title').text(date);
                $('#date-body').find('div').remove();
                for(var j=0; j < totalCnt; j++) {
                    thisShowName = showName[j];
                    let obj =$(`
                        <div onclick="scheduleEditModal('${showUid[j]}', '${thisShowName}', '${date}', '${showTime[j]}');" data-bs-toggle="modal" data-bs-target="#schedule-edit-modal" class="border border-primary my-2"> ${thisShowName} </div>
                    `);
                    $('#date-body').append(obj);
                }
            })
        }
    }

    const scheduleInsert = () => {
        let showName = $('#schedule-insert-name').val();
        let showDate = $('#schedule-insert-date').val();
        let showTime = $('#schedule-insert-time').val();

        $.ajax({
            url: 'insert_show.php',
            type: 'POST',
            data: {'showName': showName, 'showDate': showDate, 'showTime':showTime},
            cache: false,
            async: false,
            success: (res) => {
                result = JSON.parse(res);
                if(result == "OK") {
                    $('#schedule-insert-name').val('');
                    $('#schedule-insert-date').val('');
                    $('#schedule-insert-time').val('');
                    $('#schedule-insert-modal').modal('hide');
                    updateLayout();
                }
            }
        })
    }

    const scheduleEditModal = (uid, name, date, time) => {
        $('#schedule-edit-uid').val(uid);
        $('#schedule-edit-name').val(name);
        $('#schedule-edit-date').val(date);
        $('#schedule-edit-time').val(time);
    }

    const scheduleUpdate = () => {
        let uid = $('#schedule-edit-uid').val();
        let showName = $('#schedule-edit-name').val();
        let showDate = $('#schedule-edit-date').val();
        let showTime = $('#schedule-edit-time').val();

        $.ajax({
            url: 'update_show.php',
            type: 'POST',
            data: {'id': uid,'showName': showName, 'showDate': showDate, 'showTime':showTime},
            cache: false,
            async: false,
            success: (res) => {
                result = JSON.parse(res);
                if(result == "OK") {
                    $('#schedule-edit-modal').modal('hide');
                    $('#date-modal').modal('hide');
                    updateLayout();
                }
            }
        })
    }

    const scheduleDelete = () => {
        let uid = $('#schedule-edit-uid').val();

        if (confirm('정말로 삭제하시겠습니까?')) {
            $.ajax({
                url: 'delete_show.php',
                type: 'GET',
                data: {'id': uid},
                cache: false,
                async: false,
                success: (res) => {
                    result = JSON.parse(res);
                    if(result == "OK") {
                        $('#schedule-edit-modal').modal('hide');
                        $('#date-modal').modal('hide');
                        updateLayout();
                    }
                }
            })
        }
    }
</script>