let tinymce = require('tinymce/tinymce')
let styleFormats = require('./tinymce-style-formats').default

require('tinymce/plugins/autoresize')
require('tinymce/plugins/code')
require('tinymce/plugins/fullscreen')
require('tinymce/plugins/link')
require('tinymce/plugins/lists')
require('tinymce/plugins/table')

tinymce.init({
  selector: 'textarea',
  menubar: false,

  skin_url: '/tinymce/skins/ui/oxide/',
  content_css: $('#tinymce-content-css').val(),
  theme_url: '/tinymce/themes/silver/theme.min.js',
  icons_url: '/tinymce/icons/default/icons.min.js',

  plugins: ['autoresize', 'code', 'fullscreen', 'link', 'lists', 'table'],
  toolbar: 'undo redo | styleselect bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table | code fullscreen | removeformat',

  style_formats: styleFormats,

  table_advtab: false,
  table_appearance_options: false,
  table_cell_advtab: false,
  table_class_list: [
    {title: 'Default', value: 'table'},
  ],
  table_default_styles: {},
  table_default_attributes: {
    class: 'table'
  },
  table_resize_bars: false,
  table_row_advtab: false,
  table_style_by_css: false,

  mobile: {
    theme: 'mobile',
    theme_url: '/tinymce/themes/mobile/theme.min.js',
    plugins: ['lists'],
    toolbar: 'undo redo | bold italic | bullist nulist | styleselect | removeformat'
  }
}).then(function(editors) {
  editors.map((e) => $(e.getContainer()).show())
})
