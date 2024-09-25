<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;
use Symfony\Component\HttpFoundation\Response;

class XSSProtectionMiddleware
{
    protected $allowedTags = [
        'a' => ['class', 'href', 'rel', 'title', 'target', 'aria-label'],
        'abbr' => ['title'],
        'b' => [],
        'blockquote' => ['cite'],
        'cite' => ['title'],
        'code' => [],
        'del' => ['datetime', 'title'],
        'dd' => [],
        'div' => ['class', 'title', 'style', 'id', 'aria-labelledby', 'aria-hidden', 'role'],
        'dl' => [],
        'dt' => [],
        'em' => [],
        'h1' => ['class', 'title', 'style'],
        'h2' => ['class', 'title', 'style'],
        'h3' => ['class', 'title', 'style'],
        'h4' => ['class', 'title', 'style'],
        'h5' => ['class', 'title', 'style'],
        'h6' => ['class', 'title', 'style'],
        'i' => ['class'],
        'img' => ['alt', 'class', 'height', 'src', 'width', 'loading'],
        'li' => ['class'],
        'ol' => ['class'],
        'p' => ['class'],
        'q' => ['cite', 'title'],
        'span' => ['class', 'title', 'style'],
        'iframe' => ['width', 'height', 'scrolling', 'frameborder', 'allow', 'src'],
        'strike' => [],
        'br' => [],
        'strong' => [],
        'ul' => ['class'],
        'svg' => ['class', 'aria-hidden', 'aria-labelledby', 'opacity', 'role', 'xmlns', 'width', 'height', 'fill', 'viewbox'],
        'g' => ['fill'],
        'title' => ['title'],
        'path' => ['d', 'fill', 'opacity', 'stroke', 'stroke-width', 'stroke-linecap', 'stroke-linejoin'],
        'nav' => ['class', 'id'],
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Ensure input values are in UTF-8
        foreach ($request->input() as $key => $value) {
            if (is_string($value)) {
                // Sanitize the value, ensuring proper UTF-8 encoding
                $sanitizedValue = $this->sanitize($value);
    
                // Merge sanitized value back into the request
                $request->merge([$key => trim(strip_tags($sanitizedValue))]);
            }
        }
    
        // dd($request->all());

        return $next($request);
    }
    
    
    protected function sanitize($html)
    {
        // Ensure the input is in UTF-8 format
        if (mb_detect_encoding($html, 'UTF-8', true) === false) {
            $html = mb_convert_encoding($html, 'UTF-8', 'auto');
        }
    
        // Add the UTF-8 declaration to prevent entity conversion
        $html = '<?xml encoding="utf-8" ?>' . $html;
    
        // Initialize DOMDocument with proper error handling
        $dom = new \DOMDocument('1.0', 'UTF-8');
        libxml_use_internal_errors(true);
        
        // Load the HTML content while preserving UTF-8 characters
        $dom->loadHTML($html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();
    
        // Sanitize by removing disallowed tags
        foreach ($dom->getElementsByTagName('*') as $element) {
            $tagName = $element->nodeName;
    
            if (!array_key_exists($tagName, $this->allowedTags)) {
                // Remove disallowed elements
                $element->parentNode->removeChild($element);
                continue;
            }
    
            // Check allowed attributes
            foreach (array_keys(iterator_to_array($element->attributes)) as $attr) {
                if (!in_array($attr, $this->allowedTags[$tagName]) && !preg_match('/^data-/', $attr)) {
                    $element->removeAttribute($attr);
                }
            }
        }
    
        // Save HTML without converting non-Latin characters to entities
        $output = $dom->saveHTML();
        
        // Convert the content back to UTF-8 to avoid entity encoding
        return mb_convert_encoding($output, 'UTF-8', 'HTML-ENTITIES');
    }
    
    
    
    
}
