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
        // Sanitize inputs
        foreach ($request->input() as $key => $value) {
            if (is_string($value)) {
                // Check for script tags
                if (stripos($value, '<script>') !== false || stripos($value, '</script>') !== false) {
                    return response()->json(['error' => 'Script tags are not allowed.'], 400);
                }
    
                // Sanitize the value
                $sanitizedValue = $this->sanitize($value);
                
                // If you expect plain values, ensure no wrapping tags like <p> are added
                $request->merge([$key => trim(strip_tags($sanitizedValue))]);
            }
        }
    
        return $next($request);
    }
    

    /**
     * Sanitize a given HTML string.
     *
     * @param  string  $html
     * @return string
     */
    protected function sanitize($html)
    {
        // Remove disallowed tags
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();
    
        // Loop through all elements and check allowed tags
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
    
        return $dom->saveHTML();
    }
    
    
}
