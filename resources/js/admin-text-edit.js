let tinymce = require('tinymce/tinymce')
let styleFormats = require('./tinymce-style-formats').default

require('tinymce/plugins/autoresize')
require('tinymce/plugins/code')
require('tinymce/plugins/fullscreen')
require('tinymce/plugins/link')
require('tinymce/plugins/lists')

tinymce.init({
  selector: 'textarea',
  menubar: false,

  skin_url: '/tinymce/skins/ui/oxide/',
  content_css: $('#tinymce-content-css').val(),
  theme_url: '/tinymce/themes/silver/theme.min.js',

  plugins: ['autoresize', 'code', 'fullscreen', 'link', 'lists'],
  toolbar: 'undo redo | styleselect bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | code fullscreen | removeformat',

  style_formats: styleFormats,

  mobile: {
    theme: 'mobile',
    theme_url: '/tinymce/themes/mobile/theme.min.js',
    plugins: ['lists'],
    toolbar: 'undo redo | bold italic | bullist nulist | styleselect | removeformat'
  }
}).then(function(editors) {
  editors.map((e) => $(e.getContainer()).show())
})
