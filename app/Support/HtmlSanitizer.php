<?php

namespace App\Support;

use DOMDocument;
use DOMNode;
use DOMXPath;

class HtmlSanitizer
{
    public static function sanitize(string $html): string
    {
        $html = trim($html);

        if ($html === '') {
            return '';
        }

        $allowedTags = [
            'p', 'br', 'strong', 'b', 'em', 'i', 'u', 'ul', 'ol', 'li',
            'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'blockquote', 'pre',
            'a', 'img', 'span', 'div', 'table', 'thead', 'tbody', 'tr', 'td', 'th',
        ];

        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="UTF-8">' . $html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);

        foreach ($xpath->query('//script') as $node) {
            $node->parentNode?->removeChild($node);
        }

        foreach ($xpath->query('//*[@*]') as $node) {
            foreach (iterator_to_array($node->attributes ?? []) as $attribute) {
                if (str_starts_with($attribute->name, 'on')) {
                    $node->removeAttribute($attribute->name);
                }
            }
        }

        foreach ($xpath->query('//*') as $node) {
            $nodeName = strtolower($node->nodeName);

            if (! in_array($nodeName, $allowedTags, true) && $node->nodeType === XML_ELEMENT_NODE) {
                $node->parentNode?->replaceChild($dom->createTextNode($node->textContent ?? ''), $node);
            }
        }

        $safeHtml = '';
        foreach ($dom->childNodes as $child) {
            $safeHtml .= $dom->saveHTML($child);
        }

        return trim($safeHtml);
    }
}
