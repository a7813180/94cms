(function ($) {
    var timer;
    function hide() {
        var $zbox = $("#zbox");
        if ($zbox[0]) {
            $zbox.remove();
        }
    }

    $.zbox = {
        show: function (obj, msg) {
            clearTimeout(timer);
            hide();
            var o = $(obj);
            var ow = o.width();
            var oh = o.height();
            var ot = o.position().top;
            var ol = o.position().left;

            var zbox = $('<div id="zbox"></div>');
            var zbox_close = $('<div id="zbox_close"></div>');
            zbox_close.on("click", function () { hide(); });
            var zbox_msg = $('<div id="zbox_msg"></div>');
            zbox_msg.html(msg);
            zbox.append(zbox_close);
            zbox.append(zbox_msg);
            $("body").append(zbox);

            var $w = $(window);
            var zw = zbox.width();
            var zh = zbox.height();
            var zt = ($w.height() - zh) / 2 + $w.scrollTop();
            var zl = ($w.width() - zw) / 2;

            zbox.css({ width: ow, height: oh, top: ot, left: ol, display: "block", opacity: 0.1 });
            zbox.animate({ width: zw, height: zh, top: zt, left: zl, opacity: 1 }, 300);

            timer = setTimeout(function () { zbox.fadeOut(function () { hide(); }) }, 2000);

        }
    };
})(jQuery);