function demo_messages() {
    setTimeout(function () {
        username = 'Irina Shayk';
        userId = '5';

        $('#mmc-chat .chat-box .boxs').append(newBox.format(userId, username, 'online'));
        conversation = $('#mmc-chat .chat-box .boxs .box:not(".minimized")').last();
        hasNewMessage('1');
        conversation.find('.messages')
            .append('<div class="date">Today</div>')
            .append('<div class="message in "><div class="sender"><a href="javascript:void(0);" title="{0}"><img src="assets/img/user-{1}.png" class="avatar" alt="{0}"></a></div><div class="body"><div class="content"><span>Hello, welcome to chat </span></div><div class="seen"><span>few seconds ago </span> </div></div><div class="clear"></div></div>'.format(username, userId));

        setTimeout(function () {
            conversation.find('.messages')
                   .append('<div class="message in "><div class="sender"><a href="javascript:void(0);" title="{0}"><img src="assets/img/user-{1}.png" class="avatar" alt="{0}"></a></div><div class="body"><div class="content"><span>If you want BUY this item click <a href="http://codecanyon.net/item/material-modern-chat/14211560">here</a> </span></div><div class="seen"><span>few seconds ago </span> </div></div><div class="clear"></div></div>'.format(username, userId));

        }, 1000);

        messageScrollMoveEnd();
        generatePlaceholder(); initializeTooltip();
    }, 3000);
}

$(document).on('click', '.color-theme li', function () {

    $('#mmc-chat').removeAttr('class');
    $('#mmc-chat').addClass('color-' + $(this).data('skin'));

});

$(function () {
    demo_messages();
});
