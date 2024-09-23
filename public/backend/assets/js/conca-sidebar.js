

( function ( $ ) {
    'use strict';

    window.addEventListener('DOMContentLoaded', function(){
        $('[data-width]').each(function(){
            $(this).css('width', $(this).data('width'));
        })
    
        function filterUrl(url) {
            let match = url.match(/^[^?#]*/);
            return match ? match[0] : url;
        }
    
    
        // add active class to sidebar menu
        var currentUrl = window.location.href;
        var urlText = currentUrl.substring(currentUrl.lastIndexOf('/') + 1);
        var currentUrlLastPart = filterUrl(urlText);
        var anchorTags = $('.app-sidebar-menu ul li a');
        
        anchorTags.each(function(){
            var $this = $(this);
            var anchorHrefLastPart = $this.attr('href').substring($this.attr('href').lastIndexOf('/') + 1);
            
            if (anchorHrefLastPart === currentUrlLastPart.replace(/#/g, '')) {
                $this.addClass('menu-current');
            }
        });
    
    
        // update sidebar menu height
        function update_sidebar_menu_height() {
            let headerHeight = 60;
            let footerHeight = 60;
            let menuHeight = $(window).height() - (headerHeight + footerHeight)
            $('#app-sidebar-menu').css('height',  menuHeight + 'px');
        }
    
        $(window).on('resize', function(){
            update_sidebar_menu_height()
        });
    
    
        // initialize
        (function() {
            update_sidebar_menu_height();
        })();
    
    
        // add scrollbar to sidebar menu
        new PerfectScrollbar(document.querySelector('.app-sidebar-menu'), {
            suppressScrollX: true
        });

        $('.app-sidebar-menu-item').each(function() {
            let $this = $(this);
            if ($this.find('.menu-current').length > 0) {
                $this.find('.menu-current').addClass('active');
                $this.parent().show()
                $this.parent().parent().children('.menu-link').addClass('active')
            }
        });
    
        // list open hidden
        $('.menu-link').on('click', function() {
            $(this).toggleClass('active');
            $(this).next('.app-sidebar-submenu').slideToggle(300);
        });
    
        $('.app-sidebar-open-btn').on('click', function(){
            if($(this).hasClass('open')) {
                $(this).removeClass('open');
                $('#app-wrapper').attr('data-sidebar-collapsed', 'false')
                $('#app-sidebar').removeClass('collapsed')
               
                $('.app-sidebar-menu-item').each(function() {
                    let $this = $(this);
                    if($this.find('.active')){
                        $this.find('.active').parent().children('.app-sidebar-submenu').show();
                    }
                });

            }else{
                $(this).addClass('open');
                $('#app-wrapper').attr('data-sidebar-collapsed', 'true')
                $('#app-sidebar').addClass('collapsed')
                $('.app-sidebar-menu-item').find('.app-sidebar-submenu').hide();
            }
        });

        $('#app-sidebar').on('mouseenter', function(){
            if($(this).hasClass('collapsed')){
                $('#app-sidebar').removeClass('collapsed')
               
                $('.app-sidebar-menu-item').each(function() {
                    let $this = $(this);
                    if($this.find('.active')){
                        $this.find('.active').parent().children('.app-sidebar-submenu').show();
                    }
                });
            }
        }).on('mouseleave', function(){
            if($('#app-wrapper').attr('data-sidebar-collapsed') === 'true'){
                $('#app-sidebar').addClass('collapsed')
                $('.app-sidebar-menu-item').find('.app-sidebar-submenu').hide();
            }
        });

    })

}(jQuery) ) 

