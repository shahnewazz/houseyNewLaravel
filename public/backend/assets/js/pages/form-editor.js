( function ( $ ) {
    'use strict';
  
    $(function() {

        var editor = new Quill('#editor', {
            modules: { toolbar: '#toolbar' },
            theme: 'snow'
        });
    });
  
  }(jQuery) )