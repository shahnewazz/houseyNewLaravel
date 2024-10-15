(function ($) {
    'use strict';
  
    $(function() {
        const flatpickrDate = document.querySelector('#flatpickr-date')
        flatpickrDate.flatpickr({
            monthSelectorType: 'static'
          });
    });
  
}(jQuery) )