<?php
defined('datalist_db_encoding') or define('datalist_db_encoding', 'UTF-8');
defined('BASE_URL') or define('BASE_URL', 'http://example.com'); // Replace with your base URL

if (function_exists('date_default_timezone_set')) {
    date_default_timezone_set('Africa/Nairobi');
}

// Force caching
$last_modified = filemtime(__FILE__);
$last_modified_gmt = gmdate('D, d M Y H:i:s', $last_modified) . ' GMT';
$headers = getallheaders();
if (isset($headers['If-Modified-Since']) && strtotime($headers['If-Modified-Since']) == $last_modified) {
    header("Last-Modified: {$last_modified_gmt}", true, 304);
    header("Cache-Control: public, max-age=240", true);
    exit;
}
header("Last-Modified: {$last_modified_gmt}", true, 200);
header("Cache-Control: public, max-age=240", true);
header('Content-Type: text/javascript; charset=' . datalist_db_encoding);

// Include necessary files
$currDir = dirname(__FILE__);
require_once("{$currDir}/defaultLang.php");
require_once("{$currDir}/language.php");

// Define AppGini object
var AppGini = {};

// Add a check function to AppGini object
AppGini.addCheck = function (check) {
    if (typeof check === 'function') {
        _tests.push(check);
    }
};

// AJAX caching
(function ($) {
    $.ajaxPrefilter(function (options, originalOptions, jqXHR) {
        var success = originalOptions.success || $.noop,
            data = _jqAjaxData(originalOptions),
            oUrl = originalOptions.url || '',
            url = oUrl.match(/\?/) ? oUrl.match(/(.*)\?/)[1] : oUrl;

        options.beforeSend = function () {
            var req, cached = false, resp;

            for (var i = 0; i < reqTests.length; i++) {
                resp = reqTests[i](url, data);
                if (resp === false) continue;

                success(resp);
                return false;
            }

            return true;
        }
    });

    function _jqAjaxData(opt) {
        var opt = opt || {};
        var url = opt.url || '';
        var data = opt.data || {};

        var params = url.match(/\?(.*)$/);
        var param = (params !== null ? params[1] : '');

        var sPageURL = decodeURIComponent(param),
            sURLVariables = sPageURL.split('&'),
            sParameter,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameter = sURLVariables[i].split('=');
            if (sParameter[0] == '') continue;
            data[sParameter[0]] = sParameter[1] || '';
        }

        return data;
    }
})(jQuery);

// Initialize AppGini
jQuery(function () {
    AppGini.count_ajaxes_blocking_saving = 0;

    // Add ":truncated" pseudo-class to detect elements with clipped text
    $.expr[':'].truncated = function (obj) {
        var $this = $(obj);
        var $c = $this
            .clone()
            .css({
                display: 'inline',
                width: 'auto',
                visibility: 'hidden',
                'padding-right': 0
            })
            .css({
                'font-size': $this.css('font-size')
            })
            .appendTo('body');

        var e_width = $this.outerWidth();
        var c_width = $c.outerWidth();
        $c.remove();

        return (c_width > e_width);
    };

    // Fix lookup width
    function fix_lookup_width(field) {
        var s2 = $('div.select2-container[id=s2id_' + field + '-container]');
        if (!s2.length) return;

        var s2new_width = 0,
            s2view_width = 0,
            s2parent_width = 0;

        var s2new = s2.parent().find('.add_new_parent:visible');
        var s2view = s2.parent().find('.view_parent:visible');
        if (s2new.length) s2new_width = s2new.outerWidth(true);
        if (s2view.length) s2view_width = s2view.outerWidth(true);
        s2parent_width = s2.parent().innerWidth();

        s2.css({
            width: '100%',
            'max-width': (s2parent_width - s2new_width - s2view_width - 1) + 'px'
        });
    }

    // Window resize event
    $(window).resize(function () {
        var window_width = $(window).width();
        var max_width = $('body').width() * 0.5;

        $('.select2-container:not(.option_list)').each(function () {
            var field = $(this).attr('id').replace(/^s2id_/, '').replace(/-container$/, '');
            fix_lookup_width(field);
        });

        // Fix table-responsive behavior on Chrome
        fix_table_responsive_width();

        // Remove labels from truncated buttons, leaving only glyphicons
        $('.btn.truncate:truncated').each(function () {
            // hide text
            var label = $(this).html();
            var mlabel = label.replace(/.*(
