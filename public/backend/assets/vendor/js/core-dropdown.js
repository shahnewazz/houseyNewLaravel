(function ($) {
    if (!$ || !$.fn) return;
  
    const DROPDOWN_SELECTOR = '[data-bs-toggle="dropdown"][data-trigger="hover"]';
    const HOVER_DELAY = 150;
  
    function handleOpen($dropdown) {
      let hoverTimeout = $dropdown.data('hoverTimeout');
  
      if (hoverTimeout) {
        clearTimeout(hoverTimeout);
        $dropdown.removeData('hoverTimeout');
      }
  
      if (!$dropdown.attr('aria-expanded') || $dropdown.attr('aria-expanded') === 'false') {
        $dropdown.dropdown('show');
      }
    }
  
    function handleClose($dropdown) {
      const hoverTimeout = setTimeout(() => {
        let currentTimeout = $dropdown.data('hoverTimeout');
  
        if (currentTimeout) {
          clearTimeout(currentTimeout);
          $dropdown.removeData('hoverTimeout');
        }
  
        if ($dropdown.attr('aria-expanded') === 'true') {
          $dropdown.dropdown('hide');
        }
      }, HOVER_DELAY);
  
      $dropdown.data('hoverTimeout', hoverTimeout);
    }
  
    function isDropdownMenuOpen($menu) {
      return window.getComputedStyle($menu[0]).getPropertyValue('position') !== 'static';
    }
  
    function manageHoverEvents() {
      $('body')
        .on('mouseenter', `${DROPDOWN_SELECTOR}, ${DROPDOWN_SELECTOR} ~ .dropdown-menu`, function () {
          const $trigger = $(this).is(DROPDOWN_SELECTOR) ? $(this) : $(this).prev(DROPDOWN_SELECTOR);
          const $menu = $(this).is('.dropdown-menu') ? $(this) : $(this).next('.dropdown-menu');
  
          if (!isDropdownMenuOpen($menu)) return;
  
          handleOpen($trigger);
        })
        .on('mouseleave', `${DROPDOWN_SELECTOR}, ${DROPDOWN_SELECTOR} ~ .dropdown-menu`, function () {
          const $trigger = $(this).is(DROPDOWN_SELECTOR) ? $(this) : $(this).prev(DROPDOWN_SELECTOR);
          const $menu = $(this).is('.dropdown-menu') ? $(this) : $(this).next('.dropdown-menu');
  
          if (!isDropdownMenuOpen($menu)) return;
  
          handleClose($trigger);
        })
        .on('hide.bs.dropdown', function (event) {
          const $dropdown = $(this).find(DROPDOWN_SELECTOR);
          if ($dropdown.data('hoverTimeout')) {
            event.preventDefault();
          }
        });
    }
  
    $(document).ready(manageHoverEvents);
  })(jQuery);
  