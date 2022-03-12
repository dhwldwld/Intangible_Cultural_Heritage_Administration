<div class="container-lg">
    <div class="d-flex justify-content-between">
        <h3 class="px-5 pt-5 d-inlineblock">전화번호</h3>
        <p class="pe-5 pt-5">홈 > 무형문화재관리원 > 전화번호</p>
    </div>
    <hr class="m-2">
    <div class="px-3">
        <ul class="nav nav-pills mb-3 px-3" id="phone-pills">
            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="pill" type="button" aria-selected="true" onclick="selectDeptNm(this);">전체</button>
            </li>
        </ul>
        <div class="tab-content" id="phone-contents">
        </div>
    </div>
</div>

<script>
    phoneData = [];

    $(document).ready(()=>{
        updateLayout();
    })

    const updateLayout = () => {
        $.ajax({
            url: 'restAPI/phone.php',
            type: 'GET',
            dataType: 'json',
            cache: false,
            async: false,
            success: (res) => {
                if (res.statusCd != 200) {
                    alert(res.statusMsg);

                    location.href = '/';
                }

                res.items.forEach(e=>{
                    let parent;

                    $.each($('.phone-pane h4'), (i, v) => {
                        v = $(v);

                        if (v.text() === e.deptNm) {
                            parent = v.parent();
                        }
                    })

                    if (!parent) {
                        parent = $('#phone-pills');

                        let is_firstItem = false;

                        if (!parent.find('li').html()) {
                            is_firstItem = true;
                        }

                        let obj = $(`
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="pill" type="button" aria-selected="false" onclick="selectDeptNm(this);">${e.deptNm}</button>
                            </li>
                        `)

                        if (is_firstItem) {
                            obj.find('button').addClass('active');
                        }

                        parent.append(obj);

                        parent = $('#phone-contents');

                        obj = $(`
                        <div class="phone-pane my-3">
                            <h4 class="border-bottom border-primary p-3 m-3">${e.deptNm}</h4>
                            <div class="row">
                            </div>
                        </div>
                        `)
                        parent.append(obj);

                        $.each($('.phone-pane h4'), (i,v) => {
                            v = $(v);

                            if (v.text() === e.deptNm) {
                                parent = v.parent();
                            }

                            parent = parent.find('.row');

                            obj = $(`
                                <div class="col-2 my-3">
                                    <div class="card text-center">
                                        <div class="card-body p-3">
                                            <h5 class="card-title border-bottom pb-1 mb-1">${ e.name }</h5>
                                            <p class="card-text">${ e.telNo }</p>
                                        </div>
                                    </div>
                                </div>
                            `)

                            parent.append(obj);
                        })
                    }
                })
            }
        })
    }

    const selectDeptNm = (obj) => {
        let str = $(obj).text();
        if (str == '전체') {
            $.each($('.phone-pane h4'), (i, v) => {
                $(v).parent().show();
            });
        } else {
            $.each($('.phone-pane h4'), (i, v) => {
                v = $(v);

                let currentStr = v.text();

                if (currentStr == str) {
                    v.parent().show();
                } else {
                    v.parent().hide();
                }
        });
        }
    }
</script>

<!-- obj = $(`
    <div class="phone-pane my-3">
        <h4 class="border-bottom border-primary p-3 m-3">${e.deptNm}</h4>
        <div class="row">
        </div>
    </div>
`) -->


<!-- let obj = $(`
    <div class="col-2 my-3">
        <div class="card text-center">
            <div class="card-body py-2 px-3">
                <h5 class="card-title border-bottom pb-1 mb-1">${ e.name }</h5>
                <p class="card-text">${ e.telNo }</p>
            </div>
        </div>
    </div>
`) -->