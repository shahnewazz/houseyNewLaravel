(function($) {
    // Create the jQuery plugin
    $.fn.sanitizeHtml = function(options) {

        // Default allowed tags and attributes if not provided in options
        var allowedTags = $.extend({
            'a': {
                'class': [],
                'href': [],
                'rel': [],
                'title': [],
                'target': []
            },
            'abbr': {
                'title': []
            },
            'b': {
                'class': []
            },
            'blockquote': {
                'cite': []
            },
            'cite': {
                'title': []
            },
            'code': {},
            'del': {
                'datetime': [],
                'title': []
            },
            'dd': {},
            'div': {
                'class': [],
                'title': [],
                'style': [],
                'data-background': []
            }
        }, options.allowedTags);

        // Function to sanitize HTML input based on allowed tags and attributes
        function sanitizeHtml(inputHtml) {
            var $tempDiv = $('<div>').html(inputHtml);

            // Iterate through each tag in the input HTML
            $tempDiv.find('*').each(function() {
                var tag = this.tagName.toLowerCase();

                // Remove tags not allowed
                if (!(tag in allowedTags)) {
                    $(this).remove();
                    return;
                }

                // Remove attributes not allowed for the current tag
                $.each(this.attributes, function() {
                    var attrName = this.name;
                    if (!(attrName in allowedTags[tag])) {
                        $(this.ownerElement).removeAttr(attrName);
                    }
                });
            });

            return $tempDiv.html();
        }

        // Iterate over each element and sanitize its HTML content
        return this.each(function() {
            var $this = $(this);
            var sanitizedHtml = sanitizeHtml($this.html());

            // Replace the element's HTML with sanitized HTML
            $this.html(sanitizedHtml);
        });
    };
})(jQuery);
