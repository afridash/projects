function calculate_boxSize() {
    headerHeight = $('#mmc-chat.inbox .box-header').css('height').replace('px', '');
    footerHeight = $('#mmc-chat.inbox .box-footer').css('height').replace('px', '');
    optionsHeight = $('#mmc-chat.inbox .options').css('height').replace('px', '');

    bodyHeight = $(window).height() - parseInt(headerHeight) - parseInt(footerHeight) - parseInt(optionsHeight);

    $('#mmc-chat.inbox .message-scrooler').css('height', bodyHeight)
}
function hideStickerBox() {
    $('#mmc-chat .box .icons').removeClass('show');
    $('#mmc-chat .box .icons').find('.smiles-set').removeAttr('style');
}
function stickersTab() {
    setTimeout(function () {
        $('.stickers ul.tabs').tabs();
        $('.stickers ul.tabs').css({ 'height': '55px' });
    }, 1);
}
$(function () {
    calculate_boxSize();
    messageScrollMoveEnd();
});
$(window).resize(function () {
    calculate_boxSize();
});

