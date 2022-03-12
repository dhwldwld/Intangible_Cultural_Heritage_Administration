var active = true;
for (let i = 0; i < $('.history-tab').length; i++) {
    if($('.history-tab').eq(i).hasClass('active') && active) {
        $('.history-tab-content').eq(i).addClass('show');
        active = false;
    }
    $('.history-tab').eq(i).click(() => {
        $('.history-tab').removeClass('active');
        $('.history-tab-content').removeClass('show');
        $('.history-tab').eq(i).addClass('active');
        $('.history-tab-content').eq(i).addClass('show');
    });
}