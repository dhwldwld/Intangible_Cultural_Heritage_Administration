<!-- history-insert-Modal -->
<div class="modal fade" id="history-insert-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">연혁 관리</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="history-insert-title" class="form-label">내용<sup style="color: red;">*</sup>: </label>
                    <input type="text" id="history-insert-title" name="history-insert-title" required>
                </div>
                <div class="form-group">
                    <label for="history-insert-date" class="form-label">날짜<sup style="color: red;">*</sup>: </label>
                    <input type="date" id="history-insert-date" name="history-insert-date" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary" onclick="historyInsert();">등록</button>
            </div>
        </div>
    </div>
</div>

<!-- history-update-Modal -->
<div class="modal fade" id="history-update-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">연혁 수정</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="history-update-id" name="history-update-id" value="-1">
                <div class="form-group">
                    <label for="history-update-title" class="form-label">내용<sup style="color: red;">*</sup>: </label>
                    <input type="text" id="history-update-title" name="history-update-title" required>
                </div>
                <div class="form-group">
                    <label for="history-update-date" class="form-label">날짜<sup style="color: red;">*</sup>: </label>
                    <input type="date" id="history-update-date" name="history-update-date" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary" onclick="historyUpdate();">수정</button>
            </div>
        </div>
    </div>
</div>

<div class="container-lg">
    <div class="d-flex justify-content-between">
        <h3 class="px-5 pt-5 d-inlineblock">연혁</h3>
        <p class="pe-5 pt-5">홈 > 무형문화재관리원 > 일반현황 > 연혁</p>
    </div>
    <hr class="m-2">
    <div class="d-flex justify-content-end px-3">
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#history-insert-modal">
            연혁 등록
        </button>
    </div>
    <hr class="m-2">
    <div class="px-3">
        <ul class="nav nav-pills mb-3 nav-justified px-3" id="history-pills">
        </ul>
        <div class="tab-content" id="history-contents">
        </div>
    </div>
</div>

<script>
    let historyData = [];
    let latestId = 0;
    let selectId = -1;

    $(document).ready(()=> {
        historyData = JSON.parse(localStorage.getItem('historyData'));
        if (Array.isArray(historyData)) {
            historyData = historyData;
            historyData.forEach(e => {
                if (e.id >= latestId) {
                    latestId = e.id + 1;
                }
            });
            updateLayout();
        } else {
            historyData = [];
        }
    });

    const updateLayout = () => {
        historyData.forEach(e => {
            let currentYear = e.date.split('-')[0];
            let parent = $(`#history-${currentYear}`);
            
            if (!parent.html()) {
                let is_firstItem = false;

                parent = $('#history-pills');

                if (!parent.find('li').html()) {
                    is_firstItem = true;
                }
                let obj = $(`
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#history-${currentYear}" type="button" aria-selected="true">${currentYear}</button>
                    </li>
                `)

                if (is_firstItem) {
                    obj.find('button').addClass('active');
                }
                parent.append(obj);

                parent = $('#history-contents');

                obj = $(`
                    <div class="tab-pane fade" id="history-${currentYear}">
                        <table class="table table-light text-center">
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                `)
                
                if (is_firstItem) {
                    obj.addClass('show active');
                }
                
                parent.append(obj);
            }

            parent = $(`#history-${currentYear}`).find('tbody');

                obj = $(`
                    <tr data-id="${ e.id }">
                        <td>${ e.date }</td>
                        <td>${ e.title }</td>
                        <td>
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#history-update-modal" onClick="historyUpdateModal(this)">
                                수정
                            </button>
                            <button class="btn btn-danger" type="button" onclick="historyDelete(this);">삭제</button>
                        </td>
                    </tr>
                `)

                parent.append(obj);
        });
    }

    const historyInsert = () => {
        let title = $('#history-insert-title').val();
        let date = $('#history-insert-date').val();
        
        let valid = historyInputValid(title, date);

        if (valid) {
            historyData.push({
                title: title,
                date: date,
                id: latestId++,
            })
            historySave();
            location.reload();
        }
    }

    const historyUpdateModal = (obj) => {
        selectId = $(obj).parent().parent().data().id;
        let title = '';
        let date = '';

        historyData.forEach(e => {
            if (e.id === selectId) {
                title = e.title;
                date = e.date;
            }
        })
        $('#history-update-id').val(selectId);
        $('#history-update-title').val(title);
        $('#history-update-date').val(date);
    }

    const historyUpdate = () => {
        let id = $('#history-update-id').val();
        let title =  $('#history-update-title').val();
        let date = $('#history-update-date').val();

        let valid = historyInputValid(title, date);

        if (valid) {
            historyData.forEach(e => {
                if (e.id == id) {
                    e.title = title;
                    e.date =  date;
                }
            })
            historySave();
            location.reload();
        }
    }

    const historyDelete = (obj) => {
        selectId = $(obj).parent().parent().data().id;
        let NewHistoryData = [];
        NewHistoryData = historyData.filter(e => {
            return e.id != selectId
        })
        historyData = NewHistoryData;
        historySave();
        location.reload();
    }

    const historySave = () => {
        historyData.sort((a,b) => {
            if (a.date > b.date) {
                return -1;
            } else if (a.date < b.date) {
                return 1;
            } else {
                return 0;
            }
        })
        localStorage.setItem('historyData', JSON.stringify(historyData));
    }

    const historyInputValid = (title, date) => {
        if (!title) {
            alert('내용을 입력하세요');
            return false;
        } else if (!date) {
            alert('날짜를 입력하세요');
            return false;
        } else {
            return true;
        }
    }
</script>