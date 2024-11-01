(function () {
    tinymce.create('tinymce.plugins.sftrelations', {
        /**
         * Initializes the plugin, this will be executed after the plugin has been created.
         * This call is done before the editor instance has finished it's initialization so use the onInit event
         * of the editor instance to intercept that event.
         *
         * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
         * @param {string} url Absolute URL to where the plugin is located.
         */
        init: function (ed, url) {

            /**
             * Register the button
             */
            ed.addButton('sftrelations', {
                title: 'SFT Relations',
                cmd: 'sftrelations',
                image: url + '/sftrelations.png'
            });

            /**
             * Register button callback
             */
            ed.addCommand('sftrelations', function () {

                /**
                 * Open relations settings popup
                 */
                ed.windowManager.open({
                    title: 'Add related posts',
                    body: [
                        {
                            type: 'listbox',
                            name: 'sft_container',
                            label: 'Container element',
                            values: [
                                {text: 'Div', value: 'div'},
                                {text: 'Ul', value: 'ul'},
                                {text: 'Section', value: 'section'},
                                {text: 'Article', value: 'article'}
                            ],
                            minWidth: 350
                        },
                        {
                            type: 'textbox',
                            name: 'sft_container_class',
                            label: 'Custom container class',
                            placeholder: 'Custom container class ...',
                            multiline: false,
                            minWidth: 700,
                            minHeight: 30
                        },
                        {
                            type: 'listbox',
                            name: 'sft_item_container',
                            label: 'Item container element',
                            values: [
                                {text: 'Div', value: 'div'},
                                {text: 'Span', value: 'span'},
                                {text: 'Li', value: 'li'},
                                {text: 'Section', value: 'section'},
                                {text: 'Article', value: 'article'},
                                {text: 'P', value: 'p'}
                            ],
                            minWidth: 350
                        }, {
                            type: 'listbox',
                            name: 'sft_item_title_element',
                            label: 'Item container title element',
                            values: [
                                {text: 'None', value: 'none'},
                                {text: 'H1', value: 'h1'},
                                {text: 'H2', value: 'h2'},
                                {text: 'H3', value: 'h3'},
                                {text: 'H4', value: 'h4'},
                                {text: 'H5', value: 'h5'},
                                {text: 'H6', value: 'h6'},
                                {text: 'Paragraph', value: 'p'},
                                {text: 'Span', value: 'span'}
                            ],
                            minWidth: 350
                        }, {
                            type: 'textbox',
                            name: 'sft_item_container_class',
                            label: 'Custom item class',
                            placeholder: 'Custom container item class ...',
                            multiline: false,
                            minWidth: 700,
                            minHeight: 30
                        }, {
                            type: 'listbox',
                            name: 'sft_item_terms_container',
                            label: 'Custom item terms container element',
                            values: [
                                {text: 'None', value: 'none'},
                                {text: 'Div', value: 'div'},
                                {text: 'Span', value: 'span'},
                                {text: 'Li', value: 'li'},
                                {text: 'Section', value: 'section'},
                                {text: 'Article', value: 'article'},
                                {text: 'P', value: 'p'}
                            ],
                            minWidth: 350
                        },



                        {
                            type: 'textbox',
                            name: 'sft_item_terms_container_class',
                            label: 'Custom item terms container class',
                            placeholder: 'Custom item terms container class ...',
                            multiline: false,
                            minWidth: 700,
                            minHeight: 30
                        },
                        {
                            type: 'listbox',
                            name: 'sft_item_term_container',
                            label: 'Custom item term container element',
                            values: [
                                {text: 'Span', value: 'span'},
                                {text: 'Div', value: 'div'},
                                {text: 'Li', value: 'li'},
                                {text: 'Section', value: 'section'},
                                {text: 'Article', value: 'article'},
                                {text: 'P', value: 'p'}
                            ],
                            minWidth: 350
                        },
                        {
                            type: 'textbox',
                            name: 'sft_item_term_container_class',
                            label: 'Custom item term container class',
                            placeholder: 'Custom item term container class ...',
                            multiline: false,
                            minWidth: 700,
                            minHeight: 30
                        }, {
                            label: 'Show post meta',
                            type: 'checkbox',
                            name: 'sft_item_show_title',
                            text: 'Show post title',
                            checked: true
                        },
                        {
                            label: ' ',
                            text: 'Show post date',
                            type: 'checkbox',
                            name: 'sft_item_show_date',
                            checked: true
                        },
                        {
                            label: ' ',
                            text: 'Show post author',
                            type: 'checkbox',
                            name: 'sft_item_show_author',
                            checked: false
                        },
                        {
                            label: ' ',
                            text: 'Show post feature image',
                            type: 'checkbox',
                            name: 'sft_item_show_feature_image',
                            checked: false
                        },
                        {
                            label: ' ',
                            text: 'Show post excerpt',
                            type: 'checkbox',
                            name: 'sft_item_show_excerpt',
                            checked: false
                        },
                        {
                            label: ' ',
                            text: 'Show post content',
                            type: 'checkbox',
                            name: 'sft_item_show_content',
                            checked: false
                        }
                    ],
                    onsubmit: function (e) {
                        var container_element = 'container="' + e.data.sft_container + '" ';
                        var container_class = e.data.sft_container_class ? 'container_class="' + e.data.sft_container_class + '" ' : '';
                        var item_container = 'item_container="' + e.data.sft_item_container + '" ';
                        var item_title_container = 'item_title_container="' + e.data.sft_item_title_element + '" ';
                        var item_container_class = e.data.sft_item_container_class ? 'item_container_class="' + e.data.sft_item_container_class + '" ' : '';
                        var item_terms_container = 'item_terms_container="' + e.data.sft_item_terms_container + '" ';
                        var item_terms_container_class = e.data.sft_item_terms_container_class ? 'item_terms_container_class="' + e.data.sft_item_terms_container_class + '" ' : '';
                        var item_term_container = 'item_term_container="' + e.data.sft_item_term_container + '" ';
                        var item_term_container_class = e.data.sft_item_term_container_class ? 'item_term_container_class="' + e.data.sft_item_term_container_class + '" ' : '';
                        var item_show_title = e.data.sft_item_show_title === true ? 'item_show_title="' + e.data.sft_item_show_title + '" ' : '';
                        var item_show_date = e.data.sft_item_show_date === true ? 'item_show_date="' + e.data.sft_item_show_date + '" ' : '';
                        var item_show_author = e.data.sft_item_show_author === true ? 'item_show_author="' + e.data.sft_item_show_author + '" ' : '';
                        var item_show_feature_image = e.data.sft_item_show_feature_image === true ? 'item_show_feature_image="' + e.data.sft_item_show_feature_image + '" ' : '';
                        var item_show_excerpt = e.data.sft_item_show_excerpt === true ? 'item_show_excerpt="' + e.data.sft_item_show_excerpt + '" ' : '';
                        var item_show_content = e.data.sft_item_show_content === true ? 'item_show_content="' + e.data.sft_item_show_content + '" ' : '';

                        ed.insertContent('[sftrelations ' +
                            container_element +
                            container_class +
                            item_container +
                            item_title_container +
                            item_container_class +
                            item_terms_container +
                            item_terms_container_class +
                            item_term_container +
                            item_term_container_class +
                            item_show_title +
                            item_show_date +
                            item_show_author +
                            item_show_feature_image +
                            item_show_excerpt +
                            item_show_content +
                            '  ]');
                    }
                });

            });

        },

        /**
         * Creates control instances based in the incomming name. This method is normally not
         * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
         * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
         * method can be used to create those.
         *
         * @param {String} n Name of the control to create.
         * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
         * @return {tinymce.ui.Control} New control instance or null if no control was created.
         */
        createControl: function (n, cm) {
            return null;
        },

        /**
         * Returns information about the plugin as a name/value array.
         * The current keys are longname, author, authorurl, infourl and version.
         *
         * @return {Object} Name/value array containing information about the plugin.
         */
        getInfo: function () {
            return {
                longname: 'Add related posts.',
                author: 'softmixt',
                authorurl: 'http://softmixt.com',
                infourl: 'http://softmixt.com/wordpress/plugins/softmixt-relations/',
                version: "0.1"
            };
        }
    });

    // Register plugin
    tinymce.PluginManager.add('sftrelations', tinymce.plugins.sftrelations);
})();