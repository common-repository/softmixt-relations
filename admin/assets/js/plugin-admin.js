(function ($) {
    'use strict';

    $(function () {
        init_sortable();
    });

    /**
     * Insert connection
     */
    $(document).on('click', '.js-add-connection', function () {

        // Get parent li

        var post_id = $(this).data('post-id');
        var post_title = $(this).data('post-title');
        var post_type = $(this).data('post-type');

        var parent = $('.js-relations-itm[data-post-id="' + post_id + '"]');
        var item_container = parent.find('.js-posts-to-connect-tax-data');

        var master_li = $('<li>');
        master_li.attr('data-post-title', post_title);
        master_li.attr('data-post-type', post_type);
        master_li.attr('data-post-id', post_id);
        master_li.addClass('js-connected-itm');
        master_li.addClass('sft-rel-connected-item');

        // div1
        var div_1 = $('<div>').addClass("sft-rel-section-item-head");

        var div_1_span_1 = $("<span>");
        div_1_span_1.attr('data-post-id', post_id);
        div_1_span_1.addClass('dashicons');
        div_1_span_1.addClass('dashicons-trash');
        div_1_span_1.addClass('js-remove-connection');
        div_1_span_1.addClass('sft-rel-remove-connection');

        var div_1_span_2 = $("<span>").text(post_title);

        var div_1_span_3 = $("<span>");
        div_1_span_3.attr('data-post-id', post_id);
        div_1_span_3.addClass('dashicons');
        div_1_span_3.addClass('dashicons-arrow-down');
        div_1_span_3.addClass('sft-rel-toggle-connected-item');
        div_1_span_3.addClass('js-toggle-connected-item');

        div_1.append(div_1_span_1).append(div_1_span_2).append(div_1_span_3);

        // div1
        var div_2 = $('<div>').hide();
        div_2.addClass("sft-rel-section-item");
        div_2.addClass("js-section-item");

        var ul_el = $('<ul>').addClass('categorychecklist');
        ul_el.addClass('form-no-clear');

        div_2.append(ul_el);

        //  hidden input
        var hidden_input = $('<input>').val(post_id);
        hidden_input.attr('type', 'hidden');
        hidden_input.attr('name', "connected_post[]");

        master_li.append(div_1).append(div_2).append(hidden_input);

        console.log(item_container.length);

        if (item_container.length) {
            item_container.each(function (index, val) {
                var tax_name = $(this).data('taxonomy-name');
                var tax_label = $(this).val();

                var inpt = $('<input>').val(1);
                inpt.attr('type', 'checkbox');
                inpt.attr('id', 'in-taxonomy-' + tax_name);
                inpt.attr('name', 'connected_post_taxonomies[' + post_id + '][' + tax_name + ']');
                inpt.val(tax_name);

                var lbl = $('<label>').addClass('selectit').text(tax_label).prepend(inpt);
                var li_element = $('<li>').append(lbl);

                li_element.attr('id', 'sft-rel-taxonomy-' + tax_name);
                li_element.addClass('popular-category');

                ul_el.append(li_element);
            });
        }
        else {
            var li_no_tax = $('<li>').text($('.js-text-references').data('no-taxonomies')).addClass('sft-rel-post-no-taxonomies');
            ul_el.append(li_no_tax);
        }

        // Add li connection to Post Related
        $('.js-connected-posts').append(master_li);
        parent.hide();
        show_update_alert();

        $('.js-connected-no-connections').hide();

    });

    $(document).on('change', '.js-connected-post-taxonomies-checkbox', function () {
        show_update_alert();
    });

    /**
     * Remove connection
     */
    $(document).on('click', '.js-toggle-connected-item', function () {

        var _this_ = this;
        var post_id = $(this).data('post-id');
        $('[data-post-id="' + post_id + '"]').find('.js-section-item').slideToggle("fast", function () {

            if ($(_this_).hasClass('dashicons-arrow-down')) {
                $(_this_).removeClass('dashicons-arrow-down').addClass('dashicons-arrow-up');
            }
            else {
                $(_this_).removeClass('dashicons-arrow-up').addClass('dashicons-arrow-down');
            }
        });
    });

    /**
     * Remove connection
     */
    $(document).on('click', '.js-remove-connection', function () {

        if (confirm($('.js-text-references').data('remove-taxonomy'))) {
            var post_id = $(this).data('post-id');
            $('.js-connected-itm[data-post-id="' + post_id + '"]').remove();
            $('.sft-rel-not-connected[data-post-id="' + post_id + '"]').show();
            if ($('.js-connected-itm').length === 0) {
                $('.js-connected-no-connections').show();
            }
            show_update_alert();
        }
    });

    /**
     * Filter by Post type
     */
    $(document).on('change', '.js-select-post-type', function () {
        filter_by_post_type(this, '.js-relations-itm', '.js-posts-to-connect', '.js-search-posts');
    });

    /**
     * Filter by Post Name
     */
    $(document).on('keyup paste', '.js-search-posts', function () {
        filter_by_post_name(this, '.js-select-post-type', '.js-posts-to-connect', '.js-relations-itm')
    });

    /**
     * Filter by Post Type
     */
    $(document).on('change', '.js-select-related-post-type', function () {
        filter_by_post_type(this, '.js-connected-itm', '.js-connected-posts', '.js-search-connected-posts');
    });

    /**
     * Filter by Post Name
     */
    $(document).on('keyup paste', '.js-search-connected-posts', function () {
        filter_by_post_name(this, '.js-select-related-post-type', '.js-connected-posts', '.js-connected-itm')
    });

    /**
     * Initialize Post Related Sortable
     */
    function init_sortable() {
        // Enable jquery ui sortable  , now we are able to sort the add-ons.
        $(".js-connected-posts").sortable(
            {
                handle: '.sft-rel-section-item-head',
                revert: true,
                update: function (ev, ui) {
                    show_update_alert();
                }
            }
        );
    }

    /**
     * Filter by post type
     * @param $this
     * @param posts_items_class
     * @param post_to_connect
     * @param post_name
     */
    function filter_by_post_type($this, posts_items_class, post_to_connect, post_name) {
        var post_type = $($this).val();
        var posts_items = $(posts_items_class);
        var post_name = $(post_name).val();

        if (post_type === 'all') {
            if (post_name) {
                posts_items.each(function () {
                    var data_post_title = $(this).attr('data-post-title');
                    var check_regex = new RegExp(post_name.toLowerCase());
                    if (check_regex.test(data_post_title.toLowerCase())) {
                        $(this).show();
                    }
                    else {
                        $(this).hide();
                    }
                });
            }
            else {
                posts_items.show();
            }
        }
        else {
            posts_items.hide();

            if (post_name) {
                posts_items.each(function () {
                    var data_post_type = $(this).attr('data-post-type');
                    var data_post_title = $(this).attr('data-post-title');

                    var check_regex = new RegExp(post_name.toLowerCase());
                    if (check_regex.test(data_post_title.toLowerCase()) && data_post_type === post_type) {
                        $(this).show();
                    }
                    else {
                        $(this).hide();
                    }
                });

            }
            else {
                $(post_to_connect + ' > [data-post-type="' + post_type + '"] ').show();
            }

        }
    }

    /**
     * Filter by post name
     * @param $this
     * @param post_type_class
     * @param posts_to_connect
     * @param post_items
     */
    function filter_by_post_name($this, post_type_class, posts_to_connect, post_items) {
        var post_type = $(post_type_class).val();
        var post_name = $($this).val();
        var posts_items = $(post_items);

        if (post_type === 'all') {
            posts_items.show();
            posts_items.each(function () {
                var data_post_title = $(this).attr('data-post-title');
                var check_regex = new RegExp(post_name.toLowerCase());

                if (check_regex.test(data_post_title.toLowerCase())) {
                    $(this).show();
                }
                else {
                    $(this).hide();
                }
            });
        }
        else {
            posts_items.hide();
            $(posts_to_connect + ' > [data-post-type="' + post_type + '"] ').show();
            posts_items.each(function () {
                var data_post_title = $(this).attr('data-post-title');
                var check_regex = new RegExp(post_name.toLowerCase());
                if (check_regex.test(data_post_title.toLowerCase())) {
                    if ($(this).attr('data-post-type') === post_type) {
                        $(this).show();
                    }
                    else {
                        $(this).hide();
                    }
                }
                else {
                    $(this).hide();
                }
            });
        }
    }

    /**
     * Show Update Alert
     */
    function show_update_alert() {
        $('.js-update-your-post').show();
    }

})
(jQuery);
