require('./bootstrap');

$(function () {
  // lazy load images containing 'data-src'
  $('img[data-src]').each(function(i, el) {
    var $el = $(el)
    $el.attr('src', $el.data('src')).removeAttr('data-src')
  })
})
