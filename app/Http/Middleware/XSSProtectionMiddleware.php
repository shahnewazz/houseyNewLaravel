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
        // Recursively sanitize all input data, including nested arrays
        $sanitizedInput = $this->sanitizeArray($request->input());

        // Merge sanitized data back into the request
        $request->merge($sanitizedInput);

        return $next($request);
    }

    protected function sanitizeArray($data)
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                // Recursively sanitize array values
                $data[$key] = $this->sanitizeArray($value);
            } elseif (is_string($value)) {
                // Sanitize string values using the sanitize method
                $data[$key] = $this->sanitize($value);
            }
        }

        return $data;
    }

    protected function sanitize($html)
    {
        // Same sanitization logic as before
        if (mb_detect_encoding($html, 'UTF-8', true) === false) {
            $html = mb_convert_encoding($html, 'UTF-8', 'auto');
        }

        $html = str_replace('&', '##AMP##', $html);

        $dom = new \DOMDocument('1.0', 'UTF-8');
        libxml_use_internal_errors(true);

        $html = "<div>{$html}</div>";
        $dom->loadHTML('<?xml encoding="utf-8" ?>' . $html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        foreach ($dom->getElementsByTagName('*') as $element) {
            $tagName = $element->nodeName;

            if (!array_key_exists($tagName, $this->allowedTags)) {
                $element->parentNode->removeChild($element);
                continue;
            }

            foreach (iterator_to_array($element->attributes) as $attribute) {
                $attrName = $attribute->nodeName;

                if (!in_array($attrName, $this->allowedTags[$tagName]) && !preg_match('/^data-/', $attrName)) {
                    $element->removeAttribute($attrName);
                } else {
                    if (in_array($attrName, ['href', 'src'])) {
                        $url = $element->getAttribute($attrName);
                        if (preg_match('/^(javascript|vbscript|data):/i', $url)) {
                            $element->removeAttribute($attrName);
                        }
                    }
                }
            }
        }

        $output = '';
        foreach ($dom->getElementsByTagName('div')->item(0)->childNodes as $child) {
            $output .= $dom->saveHTML($child);
        }

        $output = str_replace('##AMP##', '&', $output);

        return trim($output);
    }
}
