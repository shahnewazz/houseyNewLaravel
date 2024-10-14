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
    
    public function handle(Request $request, Closure $next)
    {
        // Ensure input values are sanitized
        foreach ($request->input() as $key => $value) {
            if (is_string($value)) {
                // Sanitize the value using the custom sanitize method
                $sanitizedValue = $this->sanitize($value);
        
                // Merge sanitized value back into the request without using strip_tags
                $request->merge([$key => trim($sanitizedValue)]);
            }
        }

        return $next($request);
    }


    protected function sanitize($html)
    {
        // Ensure the input is in UTF-8 format
        if (mb_detect_encoding($html, 'UTF-8', true) === false) {
            $html = mb_convert_encoding($html, 'UTF-8', 'auto');
        }
    
        // Replace & with a placeholder
        $html = str_replace('&', '##AMP##', $html);
        
        // Initialize DOMDocument with UTF-8 encoding and suppress errors for cleaner output
        $dom = new \DOMDocument('1.0', 'UTF-8');
        libxml_use_internal_errors(true);
    
        // Wrap content in a div to prevent auto-wrapping by DOMDocument
        $html = "<div>{$html}</div>";
        $dom->loadHTML('<?xml encoding="utf-8" ?>' . $html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();
    
        // Sanitize by removing disallowed tags and attributes
        foreach ($dom->getElementsByTagName('*') as $element) {
            $tagName = $element->nodeName;
    
            // If the tag is not in allowedTags, remove the element
            if (!array_key_exists($tagName, $this->allowedTags)) {
                $element->parentNode->removeChild($element);
                continue;
            }
    
            // Remove dangerous attributes like onmouseover
            foreach (iterator_to_array($element->attributes) as $attribute) {
                $attrName = $attribute->nodeName;
    
                // If the attribute is not allowed or is an event handler, remove it
                if (!in_array($attrName, $this->allowedTags[$tagName]) && !preg_match('/^data-/', $attrName)) {
                    $element->removeAttribute($attrName);
                }
            }
        }
    
        // Extract content inside the div wrapper (without the div itself)
        $output = '';
        foreach ($dom->getElementsByTagName('div')->item(0)->childNodes as $child) {
            $output .= $dom->saveHTML($child);
        }
    
        // Restore the original & character
        $output = str_replace('##AMP##', '&', $output);
    
        // Return sanitized content ensuring proper UTF-8
        return trim($output);
    }
    
     
}
