/******/ (() => { // webpackBootstrap
/*!**********************************!*\
  !*** ./src/blocksolid-gather.js ***!
  \**********************************/
var registerBlockType = wp.blocks.registerBlockType;
var __ = wp.i18n.__;
var _wp$blockEditor = wp.blockEditor,
  InspectorControls = _wp$blockEditor.InspectorControls,
  MediaUpload = _wp$blockEditor.MediaUpload,
  MediaUploadCheck = _wp$blockEditor.MediaUploadCheck;
var _wp$components = wp.components,
  IconButton = _wp$components.IconButton,
  BaseControl = _wp$components.BaseControl,
  Button = _wp$components.Button,
  ButtonGroup = _wp$components.ButtonGroup,
  CheckboxControl = _wp$components.CheckboxControl,
  ToggleControl = _wp$components.ToggleControl,
  TextControl = _wp$components.TextControl,
  SelectControl = _wp$components.SelectControl,
  Panel = _wp$components.Panel,
  PanelRow = _wp$components.PanelRow,
  PanelBody = _wp$components.PanelBody,
  ResponsiveWrapper = _wp$components.ResponsiveWrapper;
var _wp = wp,
  ServerSideRender = _wp.serverSideRender;
var _wp$data = wp.data,
  withSelect = _wp$data.withSelect,
  select = _wp$data.select,
  useSelect = _wp$data.useSelect;
var blocksolid_gather_media_url = jsData.blocksolid_gather_media_url;
var el = wp.element.createElement;

// https://www.zamzar.com/ - converted from EPS z added to end
var octopus = el('svg', {
  width: 20,
  height: 20,
  viewBox: '0 0 760 800',
  transform: "scale(1.5,1.5)",
  color: '#d654fd'
}, el('path', {
  d: "M 333.621094 280.796875 C 333.324219 287.863281 334.484375 294.683594 337.839844 300.914063 C 339.671875 304.320313 342.132813 307.863281 346.46875 307.84375 C 350.578125 307.820313 353.074219 304.5625 354.6875 301.144531 C 360.972656 287.808594 360.9375 274.332031 354.757813 260.984375 C 353.09375 257.394531 350.46875 254.316406 345.945313 254.507813 C 341.460938 254.691406 339.265625 257.976563 337.542969 261.574219 C 334.636719 267.644531 333.332031 274.070313 333.621094 280.796875 Z M 426.351563 281.152344 C 426.648438 274.6875 425.5625 268.207031 422.667969 262.113281 C 420.824219 258.238281 418.515625 254.617188 413.605469 254.457031 C 408.964844 254.304688 406.683594 257.78125 405.066406 261.289063 C 398.980469 274.5 399.015625 287.84375 405.21875 301.019531 C 406.898438 304.582031 409.449219 308.011719 413.84375 307.835938 C 417.902344 307.675781 420.308594 304.3125 422.074219 301.035156 C 425.34375 294.949219 426.582031 288.3125 426.351563 281.152344 Z M 231.214844 439.488281 C 216.804688 439.125 203.050781 438.09375 189.585938 434.113281 C 172.433594 429.046875 157.613281 420.25 145.394531 407.363281 C 135.671875 397.105469 127.550781 385.527344 123.355469 371.855469 C 118.773438 356.929688 120.144531 342.273438 128.828125 329.089844 C 137.710938 315.613281 153.257813 311.226563 170.09375 316.503906 C 178.757813 319.222656 185.8125 323.960938 189.992188 332.300781 C 190.765625 333.84375 191.941406 335.558594 190.382813 337.210938 C 188.902344 338.773438 187.347656 337.480469 185.945313 336.867188 C 179.90625 334.222656 173.859375 334.933594 168.003906 337.15625 C 159.925781 340.226563 156.066406 348.207031 157.835938 357.375 C 160.207031 369.671875 167.457031 378.632813 178.203125 384.234375 C 207.8125 399.660156 237.578125 397.976563 266.140625 381.917969 C 286.394531 370.535156 290.324219 355.628906 281.976563 332.667969 C 277.386719 320.046875 271.550781 307.984375 265.867188 295.867188 C 241.652344 244.238281 260.820313 182.089844 296.347656 148.855469 C 316.511719 129.996094 340.949219 120.386719 368.519531 118.359375 C 392.007813 116.632813 414.558594 119.730469 435.898438 130.019531 C 461.570313 142.394531 479.472656 162.289063 491.457031 187.828125 C 499.652344 205.296875 504.109375 223.742188 504.964844 242.96875 C 505.921875 264.480469 499.804688 284.441406 490.589844 303.59375 C 485.128906 314.949219 479.507813 326.265625 476.328125 338.503906 C 470.796875 359.816406 475.417969 372.183594 494.847656 382.609375 C 522.832031 397.625 551.828125 399.414063 580.738281 384.804688 C 591.007813 379.613281 598.527344 371.488281 601.535156 359.929688 C 605.691406 343.960938 593.636719 331.886719 577.484375 335.828125 C 576.234375 336.132813 575.007813 336.558594 573.796875 336.996094 C 572.324219 337.53125 570.792969 338.75 569.414063 337.035156 C 568.175781 335.496094 569.128906 333.925781 569.839844 332.507813 C 575.101563 322.039063 584.285156 317.269531 595.273438 315.273438 C 624.425781 309.976563 637.257813 332.472656 638.832031 352.03125 C 639.832031 364.453125 636.378906 375.71875 630.1875 386.222656 C 610.5 419.636719 580.90625 436.644531 542.441406 438.777344 C 540.347656 438.894531 538.261719 439.195313 536.167969 439.285156 C 534.097656 439.375 532.019531 439.304688 530.085938 439.304688 C 529.539063 440.960938 530.558594 441.0625 531.199219 441.320313 C 562.25 453.855469 585.238281 475.875 604.222656 502.808594 C 612.863281 515.0625 621.433594 527.453125 632.304688 537.9375 C 650.28125 555.273438 676.984375 556.179688 694.605469 540.171875 C 705.292969 530.457031 707.507813 518.027344 700.828125 505.214844 C 699.082031 501.867188 700.796875 499.472656 705.007813 499.800781 C 709.671875 500.167969 713.6875 502.277344 717.039063 505.492188 C 727.671875 515.679688 731.351563 528.464844 729.449219 542.617188 C 725.078125 575.230469 700.222656 593.765625 670.207031 596.734375 C 652.164063 598.519531 635.136719 596.460938 619.203125 587.480469 C 610.15625 582.382813 602.210938 575.769531 594.078125 569.394531 C 576.046875 555.253906 559.863281 538.878906 541.058594 525.664063 C 525.894531 515.011719 509.753906 506.355469 492.046875 500.765625 C 490.703125 500.339844 489.09375 499.25 487.894531 500.214844 C 486.292969 501.5 487.757813 503.230469 488.152344 504.664063 C 493.046875 522.394531 494.75 540.464844 494.535156 558.8125 C 494.394531 570.742188 493.558594 582.703125 495.199219 594.605469 C 498.773438 620.601563 515.742188 637.238281 541.8125 640.824219 C 550.539063 642.023438 558.816406 641.722656 566.773438 637.605469 C 579.265625 631.136719 584.429688 618.035156 579.578125 604.835938 C 579.191406 603.777344 578.761719 602.730469 578.34375 601.679688 C 576.917969 598.070313 578.589844 596.847656 581.964844 597.113281 C 586.007813 597.4375 589.359375 599.230469 592.082031 602.214844 C 601.4375 612.480469 602.28125 624.9375 600.632813 637.722656 C 597.773438 659.875 584.132813 672.859375 563.464844 678.878906 C 540.085938 685.683594 517.683594 680.953125 496.054688 671.476563 C 454.488281 653.261719 431.945313 620.496094 424.421875 576.542969 C 422.273438 563.984375 422.171875 551.152344 419.535156 538.636719 C 415.964844 521.683594 410.554688 505.570313 398.710938 492.410156 C 395.601563 488.953125 391.835938 486.089844 388.441406 482.878906 C 385.996094 480.558594 383.878906 480.859375 381.226563 482.816406 C 369.402344 491.554688 361.660156 503.191406 356.367188 516.699219 C 349.925781 533.136719 348.011719 550.433594 346.269531 567.808594 C 343.394531 596.554688 333.804688 622.765625 313.457031 643.691406 C 288.710938 669.140625 258.339844 682.859375 222.394531 681.632813 C 204.671875 681.03125 188.484375 675.101563 177.75 660.027344 C 166.394531 644.078125 165.242188 626.457031 172.960938 608.5625 C 175.515625 602.632813 180.246094 598.246094 187.0625 597.117188 C 191.382813 596.40625 192.855469 598.003906 191.070313 601.878906 C 179.695313 626.566406 203.132813 644.625 224.714844 641.257813 C 241.265625 638.679688 255.921875 633.058594 265.925781 618.757813 C 272.867188 608.828125 274.839844 597.40625 275.171875 585.660156 C 275.445313 575.820313 275.246094 565.964844 275.128906 556.117188 C 274.902344 537.101563 276.957031 518.417969 282.886719 500.261719 C 283.222656 499.234375 284.164063 498.027344 283.320313 497.082031 C 282.265625 495.894531 280.894531 496.953125 279.710938 497.253906 C 250.121094 504.675781 224.507813 519.523438 201.441406 539.15625 C 184.609375 553.484375 168.324219 568.484375 150.328125 581.40625 C 124.542969 599.921875 96.601563 602.257813 67.566406 591.117188 C 41.59375 581.152344 25.929688 552.996094 31.03125 527.4375 C 32.746094 518.828125 36.453125 511.242188 43.105469 505.304688 C 46.570313 502.210938 50.53125 500.042969 55.222656 499.800781 C 59.203125 499.59375 60.996094 501.980469 59.230469 505.019531 C 48.867188 522.875 60.300781 539.40625 73.820313 546.179688 C 95.101563 556.84375 116.664063 551.558594 133.53125 531.875 C 145.84375 517.511719 156.175781 501.652344 168.03125 486.941406 C 184.171875 466.929688 203.890625 451.792969 227.597656 441.835938 C 228.722656 441.363281 230.148438 441.320313 231.214844 439.488281z"
}));
registerBlockType('pwd/gather', {
  title: __('Gather'),
  category: __('common'),
  icon: octopus,
  description: 'Select posts to display',
  keywords: ['pwd gather'],
  attributes: {
    gather_max_posts: {
      type: 'string',
      "default": '1'
    },
    gather_first_post: {
      type: 'string',
      "default": '1'
    },
    gather_post_type: {
      type: 'string',
      "default": 'post'
    },
    gather_title: {
      type: 'string',
      "default": ''
    },
    gather_categories: {
      type: 'string',
      "default": ''
    },
    gather_excluded_categories: {
      type: 'string',
      "default": ''
    },
    gather_tags: {
      type: 'string',
      "default": ''
    },
    gather_number_per_row: {
      type: 'string',
      "default": '1'
    },
    gather_order_by: {
      type: 'string',
      "default": 'date'
    },
    gather_ascending: {
      type: 'boolean',
      "default": false
    },
    gather_media_position: {
      type: 'string',
      "default": 'top'
    },
    gather_media_size: {
      type: 'string',
      "default": 'thumbnail'
    },
    gather_excerpt_length: {
      type: 'string',
      "default": 'full'
    },
    gather_excerpt_signoff: {
      type: 'string',
      "default": '...'
    },
    gather_placeholder_image_src: {
      type: 'string',
      "default": blocksolid_gather_media_url + 'default-placeholder.png'
    },
    gather_placeholder_image_id: {
      type: 'string',
      "default": '0'
    },
    gather_show_media_only: {
      type: 'boolean',
      "default": false
    },
    gather_show_media_caption: {
      type: 'boolean',
      "default": false
    },
    gather_show_media_link: {
      type: 'boolean',
      "default": false
    },
    gather_move_title_above: {
      type: 'boolean',
      "default": false
    },
    gather_move_meta_above: {
      type: 'boolean',
      "default": false
    },
    gather_move_meta_above_title: {
      type: 'boolean',
      "default": false
    },
    gather_show_additional_full_excerpt: {
      type: 'boolean',
      "default": false
    },
    gather_media_hover: {
      type: 'boolean',
      "default": false
    },
    gather_show_figcaption_link: {
      type: 'boolean',
      "default": false
    },
    gather_hide_margins: {
      type: 'boolean',
      "default": false
    },
    gather_final_row_pad_empty: {
      type: 'boolean',
      "default": false
    },
    gather_show_date_created: {
      type: 'boolean',
      "default": false
    },
    gather_show_author: {
      type: 'boolean',
      "default": false
    },
    gather_show_categories: {
      type: 'boolean',
      "default": false
    },
    gather_show_tags: {
      type: 'boolean',
      "default": false
    },
    gather_taxonomy_slug: {
      type: 'string',
      "default": 'category'
    }
  },
  edit: function edit(props) {
    var attributes = props.attributes;
    var setAttributes = props.setAttributes;
    var gather_taxonomy = useSelect(function (select) {
      return select('core').getEntityRecords('root', 'taxonomy', {
        type: attributes.gather_post_type
      });
    });

    // An array of taxonomies
    if (Array.isArray(gather_taxonomy) && gather_taxonomy.length > 0) {
      // Extract the slug from the first taxonomy in the array
      var firstTaxonomy = gather_taxonomy[0];
      attributes.gather_taxonomy_slug = firstTaxonomy.slug;
    }
    var gather_placeholder_image_style = {
      height: '60px',
      width: '140px',
      padding: '0 0 2px 0'
    };
    var gather_placeholder_image_delete_button_hidden_style = {
      display: 'none'
    };
    var gather_placeholder_image_delete_button_show_style = {};
    var categories = useSelect(function (select) {
      return select('core').getEntityRecords('taxonomy', attributes.gather_taxonomy_slug, {
        per_page: -1,
        page: 1
      });
    });
    var tags = useSelect(function (select) {
      return select('core').getEntityRecords('taxonomy', 'post_tag', {
        per_page: -1,
        page: 1
      });
    });
    var available_image_sizes = wp.data.select('core/editor').getEditorSettings().imageSizes; // https://developer.wordpress.org/reference/functions/get_default_block_editor_settings/

    var available_post_types = useSelect(function (select) {
      var _getPostTypes;
      var _select = select('core'),
        getPostTypes = _select.getPostTypes;
      var excludedPostTypes = ['attachment'];
      var filteredPostTypes = (_getPostTypes = getPostTypes({
        per_page: -1
      })) === null || _getPostTypes === void 0 ? void 0 : _getPostTypes.filter(function (_ref) {
        var viewable = _ref.viewable,
          slug = _ref.slug;
        return viewable && !excludedPostTypes.includes(slug);
      });
      var result = (filteredPostTypes || []).map(function (_ref2) {
        var slug = _ref2.slug;
        return slug;
      });
      return result;
    }, []);
    var clientId = props.clientId; // Unique ID of the block

    function change_gather_max_posts(gather_max_posts) {
      setAttributes({
        gather_max_posts: gather_max_posts
      });
    }
    function change_gather_first_post(gather_first_post) {
      setAttributes({
        gather_first_post: gather_first_post
      });
    }
    function change_gather_post_type(gather_post_type) {
      setAttributes({
        gather_post_type: gather_post_type
      });
    }
    function change_gather_title(gather_title) {
      setAttributes({
        gather_title: gather_title
      });
    }
    function change_gather_categories(val) {
      //NB. val has a comma suffix  - Adding quotes makes the number into a string

      var gather_categories_temp = attributes.gather_categories;
      var category_choices_internal = [];
      if (categories) {
        // A constant containing the possible catagories

        categories.forEach(function (category) {
          category_choices_internal.push(category.id + '');
        });

        //Filter out any orphaned categories should any have been deleted since last save.
        var gather_categories_temp_array = gather_categories_temp.split(",");
        gather_categories_temp_array = gather_categories_temp_array.filter(Number); // Filter any empty elements

        if (!(gather_categories_temp_array === undefined || gather_categories_temp_array.length == 0)) {
          if (!(category_choices_internal === undefined || category_choices_internal.length == 0)) {
            var category_choices_internal_filter = gather_categories_temp_array.map(function (item) {
              if (category_choices_internal.indexOf(item) !== -1) {
                return item;
              } else {
                return '';
              }
            });
            var category_choices_internal_filter = category_choices_internal_filter.filter(function (a) {
              return a;
            });
            gather_categories_temp = category_choices_internal_filter.join(',') + ',';
          }
        }
      }
      if (!gather_categories_temp.includes(val)) {
        gather_categories_temp = gather_categories_temp + val;
        setAttributes({
          gather_categories: gather_categories_temp
        });
        return true;
      } else {
        var gather_categories_temp_without_val = gather_categories_temp.replace(val, "");
        setAttributes({
          gather_categories: gather_categories_temp_without_val
        });
        return false;
      }
    }
    function change_gather_excluded_categories(val) {
      //NB. val has a comma suffix  - Adding quotes makes the number into a string

      var gather_excluded_categories_temp = attributes.gather_excluded_categories;
      if (!gather_excluded_categories_temp.includes(val)) {
        gather_excluded_categories_temp = gather_excluded_categories_temp + val;
        setAttributes({
          gather_excluded_categories: gather_excluded_categories_temp
        });
        return true;
      } else {
        var gather_excluded_categories_temp_without_val = gather_excluded_categories_temp.replace(val, "");
        setAttributes({
          gather_excluded_categories: gather_excluded_categories_temp_without_val
        });
        return false;
      }
    }
    function change_gather_tags(val) {
      //NB. val has a comma suffix  - Adding quotes makes the number into a string

      var gather_tags_temp = attributes.gather_tags;
      var tag_choices_internal = [];
      if (tags) {
        // A constant containing the possible tags

        tags.forEach(function (tag) {
          tag_choices_internal.push(tag.id + '');
        });

        //Filter out any orphaned tags should any have been deleted since last save.
        var gather_tags_temp_array = gather_tags_temp.split(",");
        gather_tags_temp_array = gather_tags_temp_array.filter(Number); // Filter any empty elements

        if (!(gather_tags_temp_array === undefined || gather_tags_temp_array.length == 0)) {
          if (!(tag_choices_internal === undefined || tag_choices_internal.length == 0)) {
            var tag_choices_internal_filter = gather_tags_temp_array.map(function (item) {
              if (tag_choices_internal.indexOf(item) !== -1) {
                return item;
              } else {
                return '';
              }
            });
            var tag_choices_internal_filter = tag_choices_internal_filter.filter(function (a) {
              return a;
            });
            gather_tags_temp = tag_choices_internal_filter.join(',') + ',';
          }
        }
      }
      if (!gather_tags_temp.includes(val)) {
        gather_tags_temp = gather_tags_temp + val;
        setAttributes({
          gather_tags: gather_tags_temp
        });
        return true;
      } else {
        var gather_tags_temp_without_val = gather_tags_temp.replace(val, "");
        setAttributes({
          gather_tags: gather_tags_temp_without_val
        });
        return false;
      }
    }
    function change_gather_number_per_row(gather_number_per_row) {
      setAttributes({
        gather_number_per_row: gather_number_per_row
      });
    }
    function change_gather_media_position(ev) {
      var gather_media_position = ev.currentTarget.value;
      setAttributes({
        gather_media_position: gather_media_position
      });
    }
    function change_gather_media_size(gather_media_size) {
      setAttributes({
        gather_media_size: gather_media_size
      });
    }
    function change_gather_excerpt_length(gather_excerpt_length) {
      setAttributes({
        gather_excerpt_length: gather_excerpt_length
      });
    }
    function change_gather_excerpt_signoff(gather_excerpt_signoff) {
      setAttributes({
        gather_excerpt_signoff: gather_excerpt_signoff
      });
    }
    function change_gather_order_by(gather_order_by) {
      setAttributes({
        gather_order_by: gather_order_by
      });
    }
    function change_gather_ascending(gather_ascending) {
      setAttributes({
        gather_ascending: gather_ascending
      });
    }
    function change_gather_ignore_sticky(gather_ignore_sticky) {
      setAttributes({
        gather_ignore_sticky: gather_ignore_sticky
      });
    }
    function change_gather_get_related(gather_get_related) {
      setAttributes({
        gather_get_related: gather_get_related
      });
    }
    function change_gather_placeholder_image(media) {
      setAttributes({
        gather_placeholder_image_src: media.url + ''
      });
      setAttributes({
        gather_placeholder_image_id: media.id + ''
      });
    }
    ;
    function delete_gather_placeholder_image() {
      setAttributes({
        gather_placeholder_image_src: blocksolid_gather_media_url + 'no-image.png'
      });
      setAttributes({
        gather_placeholder_image_id: '0'
      });
    }
    ;
    function change_gather_show_media_only(gather_show_media_only) {
      setAttributes({
        gather_show_media_only: gather_show_media_only
      });
    }
    function change_gather_show_media_caption(gather_show_media_caption) {
      setAttributes({
        gather_show_media_caption: gather_show_media_caption
      });
    }
    function change_gather_show_media_link(gather_show_media_link) {
      setAttributes({
        gather_show_media_link: gather_show_media_link
      });
    }
    function change_gather_move_title_above(gather_move_title_above) {
      setAttributes({
        gather_move_title_above: gather_move_title_above
      });
    }
    function change_gather_move_meta_above(gather_move_meta_above) {
      setAttributes({
        gather_move_meta_above: gather_move_meta_above
      });
    }
    function change_gather_move_meta_above_title(gather_move_meta_above_title) {
      setAttributes({
        gather_move_meta_above_title: gather_move_meta_above_title
      });
    }
    function change_gather_show_additional_full_excerpt(gather_show_additional_full_excerpt) {
      setAttributes({
        gather_show_additional_full_excerpt: gather_show_additional_full_excerpt
      });
    }
    function change_gather_media_hover(gather_media_hover) {
      setAttributes({
        gather_media_hover: gather_media_hover
      });
    }
    function change_gather_show_figcaption_link(gather_show_figcaption_link) {
      setAttributes({
        gather_show_figcaption_link: gather_show_figcaption_link
      });
    }
    function change_gather_hide_margins(gather_hide_margins) {
      setAttributes({
        gather_hide_margins: gather_hide_margins
      });
    }
    function change_gather_final_row_pad_empty(gather_final_row_pad_empty) {
      setAttributes({
        gather_final_row_pad_empty: gather_final_row_pad_empty
      });
    }
    function change_gather_show_date_created(gather_show_date_created) {
      setAttributes({
        gather_show_date_created: gather_show_date_created
      });
    }
    function change_gather_show_author(gather_show_author) {
      setAttributes({
        gather_show_author: gather_show_author
      });
    }
    function change_gather_show_categories(gather_show_categories) {
      setAttributes({
        gather_show_categories: gather_show_categories
      });
    }
    function change_gather_show_tags(gather_show_tags) {
      setAttributes({
        gather_show_tags: gather_show_tags
      });
    }
    var category_choices = [];
    var tag_choices = [];
    var number_per_row_options = [];
    number_per_row_options.push({
      value: '1',
      label: '1'
    });
    number_per_row_options.push({
      value: '2',
      label: '2'
    });
    number_per_row_options.push({
      value: '3',
      label: '3'
    });
    number_per_row_options.push({
      value: '4',
      label: '4'
    });
    number_per_row_options.push({
      value: '5',
      label: '5'
    });
    number_per_row_options.push({
      value: '6',
      label: '6'
    });
    var media_size_options = [];
    if (available_image_sizes) {
      available_image_sizes.forEach(function (image_size) {
        media_size_options.push({
          value: image_size.slug,
          label: image_size.name
        });
      });
    } else {
      media_size_options.push({
        value: 0,
        label: __('Loading...', '')
      });
    }
    var post_type_options = [];
    if (available_post_types) {
      available_post_types.forEach(function (post_type) {
        var post_type_label = post_type[0].toUpperCase() + post_type.substring(1);
        post_type_options.push({
          value: post_type,
          label: post_type_label
        });
      });
    } else {
      post_type_options.push({
        value: 'post',
        label: 'Post'
      });
      post_type_options.push({
        value: 'page',
        label: 'Page'
      });
    }
    if (categories) {
      categories.forEach(function (category) {
        category_choices.push({
          value: category.id,
          label: category.name
        });
      });
    } else {
      category_choices.push({
        value: 0,
        label: __('Loading...', '')
      });
    }
    if (tags) {
      tags.forEach(function (tag) {
        tag_choices.push({
          value: tag.id,
          label: tag.name
        });
      });
    } else {
      tag_choices.push({
        value: 0,
        label: __('Loading...', '')
      });
    }
    var posts_returned_number_options = [];
    for (var i = 1; i < 51; i++) {
      posts_returned_number_options.push({
        value: i,
        label: i
      });
    }
    var first_returned_number_options = [];
    for (var _i = 1; _i < 51; _i++) {
      first_returned_number_options.push({
        value: _i,
        label: _i
      });
    }
    var order_by_options = [];
    order_by_options.push({
      value: 'post_date',
      label: 'Date Created'
    });
    order_by_options.push({
      value: 'modified',
      label: 'Date Last Modified'
    });
    order_by_options.push({
      value: 'title',
      label: 'Alphabetical'
    });
    order_by_options.push({
      value: 'rand',
      label: 'Random'
    });
    order_by_options.push({
      value: 'author',
      label: 'Author'
    });
    order_by_options.push({
      value: 'relevance',
      label: 'Relevance'
    });
    order_by_options.push({
      value: 'menu_order',
      label: 'Menu Order'
    });
    var category_checkboxes = [];
    category_choices.map(function (item) {
      return category_checkboxes.push(el(CheckboxControl, {
        key: item.value,
        label: item.label,
        name: 'gatherCategories[]',
        onChange: function onChange() {
          change_gather_categories(item.value + ',');
        },
        checked: !!attributes.gather_categories.split(',').includes(item.value + ""),
        __nextHasNoMarginBottom: true
      }));
    });
    var excluded_category_checkboxes = [];
    category_choices.map(function (item) {
      return excluded_category_checkboxes.push(el(CheckboxControl, {
        key: item.value,
        label: item.label,
        name: 'gatherExcludedCategories[]',
        onChange: function onChange() {
          change_gather_excluded_categories(item.value + ',');
        },
        checked: !!attributes.gather_excluded_categories.split(',').includes(item.value + ""),
        __nextHasNoMarginBottom: true
      }));
    });
    var tag_checkboxes = [];
    if (tag_choices.length >= 1) {
      tag_choices.map(function (item) {
        return tag_checkboxes.push(el(CheckboxControl, {
          key: item.value,
          label: item.label,
          name: 'gatherTags[]',
          onChange: function onChange() {
            change_gather_tags(item.value + ',');
          },
          checked: !!attributes.gather_tags.split(',').includes(item.value + ""),
          __nextHasNoMarginBottom: true
        }));
      });
    } else {
      tag_checkboxes.push(el('br', {
        key: 'blocksolid_gather_block_br_' + clientId
      }), el('p', {
        key: 'blocksolid_gather_block_p_' + clientId
      }, 'You have do not have any tags set'));
    }

    //Display block preview and UI
    return el('div', {
      className: "gather-container"
    }, [
    //Preview a block with a PHP render callback
    el(ServerSideRender, {
      block: 'pwd/gather',
      attributes: attributes,
      key: 'blocksolid_gather_block_' + clientId
    }),
    //Block inspector
    el(InspectorControls, {
      key: 'blocksolid_gather_block_controls_' + clientId
    }, [el(PanelBody, {
      title: 'Post Settings',
      initialOpen: false,
      key: 'blocksolid_gather_block_post_settings_' + clientId
    }, el(SelectControl, {
      value: attributes.gather_max_posts,
      label: __('Max Posts To Return'),
      onChange: change_gather_max_posts,
      options: posts_returned_number_options,
      __nextHasNoMarginBottom: true
    }), el(SelectControl, {
      value: attributes.gather_first_post,
      label: __('First Post To Return'),
      onChange: change_gather_first_post,
      options: first_returned_number_options,
      __nextHasNoMarginBottom: true
    }), el(SelectControl, {
      value: attributes.gather_post_type,
      label: __('Post Type'),
      onChange: change_gather_post_type,
      options: post_type_options,
      __nextHasNoMarginBottom: true
    }), el(TextControl, {
      value: attributes.gather_title,
      label: __('Specific Post Title'),
      onChange: change_gather_title,
      __nextHasNoMarginBottom: true
    }), el(SelectControl, {
      value: attributes.gather_order_by,
      label: __('Order By'),
      onChange: change_gather_order_by,
      options: order_by_options,
      __nextHasNoMarginBottom: true
    }), el(ToggleControl, {
      value: attributes.gather_ascending,
      label: __('Ascending'),
      onChange: change_gather_ascending,
      checked: attributes.gather_ascending,
      __nextHasNoMarginBottom: true
    }), el(ToggleControl, {
      value: attributes.gather_ignore_sticky,
      label: __('Ignore Sticky Posts'),
      onChange: change_gather_ignore_sticky,
      checked: attributes.gather_ignore_sticky,
      __nextHasNoMarginBottom: true
    }), el(ToggleControl, {
      value: attributes.gather_get_related,
      label: __('Just Get Related Posts'),
      onChange: change_gather_get_related,
      checked: attributes.gather_get_related,
      help: '(Overrides Category & Tag filters in Posts only)',
      __nextHasNoMarginBottom: true
    })), el(PanelBody, {
      title: 'Post Meta',
      initialOpen: false,
      key: 'blocksolid_gather_block_post_meta_' + clientId
    }, el(ToggleControl, {
      value: attributes.gather_show_date_created,
      label: __('Show Date Created'),
      onChange: change_gather_show_date_created,
      checked: attributes.gather_show_date_created,
      __nextHasNoMarginBottom: true
    }), el(ToggleControl, {
      value: attributes.gather_show_author,
      label: __('Show Author'),
      onChange: change_gather_show_author,
      checked: attributes.gather_show_author,
      __nextHasNoMarginBottom: true
    }), el(ToggleControl, {
      value: attributes.gather_show_categories,
      label: __('Show Categories'),
      onChange: change_gather_show_categories,
      checked: attributes.gather_show_categories,
      __nextHasNoMarginBottom: true
    }), el(ToggleControl, {
      value: attributes.gather_show_tags,
      label: __('Show Tags'),
      onChange: change_gather_show_tags,
      checked: attributes.gather_show_tags,
      help: 'Tags show only if the post has tags!',
      __nextHasNoMarginBottom: true
    })), el(PanelBody, {
      title: 'Layout',
      initialOpen: false,
      key: 'blocksolid_gather_block_layout_' + clientId
    }, el(SelectControl, {
      value: attributes.gather_number_per_row,
      label: __('Number Per Row'),
      onChange: change_gather_number_per_row,
      options: number_per_row_options,
      __nextHasNoMarginBottom: true
    }), el(ToggleControl, {
      value: attributes.gather_hide_margins,
      label: __('Hide Margins'),
      onChange: change_gather_hide_margins,
      checked: attributes.gather_hide_margins,
      __nextHasNoMarginBottom: true
    }), el(ToggleControl, {
      value: attributes.gather_final_row_pad_empty,
      label: __('Pad Final Row If Incomplete'),
      onChange: change_gather_final_row_pad_empty,
      checked: attributes.gather_final_row_pad_empty,
      __nextHasNoMarginBottom: true
    }), el(ToggleControl, {
      value: attributes.gather_move_title_above,
      label: __('Move Title To Top'),
      onChange: change_gather_move_title_above,
      checked: attributes.gather_move_title_above,
      __nextHasNoMarginBottom: true
    }), el(ToggleControl, {
      value: attributes.gather_move_meta_above,
      label: __('Move Meta Above Content'),
      onChange: change_gather_move_meta_above,
      checked: attributes.gather_move_meta_above,
      __nextHasNoMarginBottom: true
    }), el(ToggleControl, {
      value: attributes.gather_move_meta_above_title,
      label: __('Move Meta Above Title'),
      onChange: change_gather_move_meta_above_title,
      checked: attributes.gather_move_meta_above_title,
      __nextHasNoMarginBottom: true
    }), el(ToggleControl, {
      value: attributes.gather_show_additional_full_excerpt,
      label: __('Show Additional Full Excerpt'),
      onChange: change_gather_show_additional_full_excerpt,
      checked: attributes.gather_show_additional_full_excerpt,
      help: 'If the posts have an excerpt specifed show this in full above the content as a summary.  Show nothing if an excerpt has not been specified.',
      __nextHasNoMarginBottom: true
    })), el(PanelBody, {
      title: 'Media',
      initialOpen: false,
      label: 'Order By',
      key: 'blocksolid_gather_block_media_' + clientId
    }, el(BaseControl, {
      label: 'Media Position',
      help: 'Top, Right, Bottom, Left or None',
      __nextHasNoMarginBottom: true
    }, el("br"), el(ButtonGroup, {
      title: 'Media Position'
    }, el(Button, {
      icon: 'table-row-before',
      value: 'top',
      title: 'Top',
      isPrimary: attributes.gather_media_position === 'top',
      isSecondary: attributes.gather_media_position !== 'top',
      onClick: change_gather_media_position
    }), el(Button, {
      icon: 'table-col-after',
      value: 'right',
      title: 'Right',
      isPrimary: attributes.gather_media_position === 'right',
      isSecondary: attributes.gather_media_position !== 'right',
      onClick: change_gather_media_position
    }), el(Button, {
      icon: 'table-row-after',
      value: 'bottom',
      title: 'Bottom',
      isPrimary: attributes.gather_media_position === 'bottom',
      isSecondary: attributes.gather_media_position !== 'bottom',
      onClick: change_gather_media_position
    }), el(Button, {
      icon: 'table-col-before',
      value: 'left',
      title: 'Left',
      isPrimary: attributes.gather_media_position === 'left',
      isSecondary: attributes.gather_media_position !== 'left',
      onClick: change_gather_media_position
    }), el(Button, {
      icon: 'table-col-delete',
      value: 'none',
      title: 'None',
      isPrimary: attributes.gather_media_position === 'none',
      isSecondary: attributes.gather_media_position !== 'none',
      onClick: change_gather_media_position
    }))), el(SelectControl, {
      value: attributes.gather_media_size,
      label: __('Media Size'),
      onChange: change_gather_media_size,
      options: media_size_options,
      __nextHasNoMarginBottom: true
    }), el(BaseControl, {
      label: 'Placeholder Image',
      help: 'Choose an image to show if there is no media',
      key: 'blocksolid_gather_base_media_upload_' + clientId,
      __nextHasNoMarginBottom: true
    }, el("br"), el("br"), el('div', {
      className: attributes.gather_placeholder_image_id ? 'gather_placeholder_image image-active' : 'gather_placeholder_image image-inactive'
    }, el(MediaUpload, {
      onSelect: change_gather_placeholder_image,
      type: 'image',
      value: attributes.gather_placeholder_image_id,
      render: function render(obj) {
        return el(Button, {
          className: attributes.gather_placeholder_image_id ? 'button' : 'button button-large',
          style: attributes.gather_placeholder_image_id ? gather_placeholder_image_style : '',
          onClick: obj.open
        }, !attributes.gather_placeholder_image_id ? 'Upload Image' : el('img', {
          src: attributes.gather_placeholder_image_src,
          style: attributes.gather_placeholder_image_id ? gather_placeholder_image_style : ''
        }));
      }
    }), el("br"), el("br"), el(ButtonGroup, {
      title: ''
    }, el(Button, {
      key: 'Delete',
      isPrimary: true,
      title: 'Delete',
      value: 'Delete',
      onClick: delete_gather_placeholder_image,
      style: attributes.gather_placeholder_image_id != '0' ? gather_placeholder_image_delete_button_show_style : gather_placeholder_image_delete_button_hidden_style
    }, 'Delete')))), el(ToggleControl, {
      value: attributes.gather_show_media_only,
      label: __('Only Show Media'),
      onChange: change_gather_show_media_only,
      checked: attributes.gather_show_media_only,
      __nextHasNoMarginBottom: true
    }), el(ToggleControl, {
      value: attributes.gather_media_hover,
      label: __('Media Zoom Effect'),
      onChange: change_gather_media_hover,
      checked: attributes.gather_media_hover,
      __nextHasNoMarginBottom: true
    }), el(ToggleControl, {
      value: attributes.gather_show_media_caption,
      label: __('Show Media Caption'),
      onChange: change_gather_show_media_caption,
      checked: attributes.gather_show_media_caption,
      __nextHasNoMarginBottom: true
    }), el(ToggleControl, {
      value: attributes.gather_show_media_link,
      label: __('Link Media To Post'),
      onChange: change_gather_show_media_link,
      checked: attributes.gather_show_media_link,
      __nextHasNoMarginBottom: true
    }), el(ToggleControl, {
      value: attributes.gather_show_figcaption_link,
      label: __('Link Media Caption To Post'),
      onChange: change_gather_show_figcaption_link,
      checked: attributes.gather_show_figcaption_link,
      __nextHasNoMarginBottom: true
    })), el(PanelBody, {
      title: attributes.gather_taxonomy_slug.charAt(0).toUpperCase() + attributes.gather_taxonomy_slug.slice(1) + ' Filter',
      initialOpen: false,
      key: 'blocksolid_gather_block_categories_' + clientId
    }, category_checkboxes), el(PanelBody, {
      title: 'Excluded ' + attributes.gather_taxonomy_slug.charAt(0).toUpperCase() + attributes.gather_taxonomy_slug.slice(1) + ' Filter',
      initialOpen: false,
      key: 'blocksolid_gather_block_excluded_categories_' + clientId
    }, excluded_category_checkboxes), el(PanelBody, {
      title: 'Tag Filter',
      initialOpen: false,
      key: 'blocksolid_gather_block_tags_' + clientId
    }, tag_checkboxes), el(PanelBody, {
      title: 'Excerpt',
      initialOpen: false,
      key: 'blocksolid_gather_block_excerpts_' + clientId
    }, el(TextControl, {
      value: attributes.gather_excerpt_length,
      label: __('Excerpt Length'),
      onChange: change_gather_excerpt_length,
      help: 'The excerpt length in number of words (a number e.g. 20, "full" for the full excerpt if specified, "content" to show the post content or "none" to show no excerpt)',
      __nextHasNoMarginBottom: true
    }), el(TextControl, {
      value: attributes.gather_excerpt_signoff,
      label: __('Excerpt Signoff'),
      onChange: change_gather_excerpt_signoff,
      help: 'The text that follows the excerpt as a "Read more" link (e.g. "Read more ..." - to remove the link leave blank)',
      __nextHasNoMarginBottom: true
    }))])]);
  },
  save: function save() {
    return null; //save has to exist. This all we need
  }
});
/******/ })()
;
//# sourceMappingURL=blocksolid-gather.js.map