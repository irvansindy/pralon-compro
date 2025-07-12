<?php

return [
    'encoding'           => 'UTF-8',
    'finalize'           => true,
    'ignoreNonStrings'   => false,
    'cachePath'          => storage_path('app/purifier'),
    'cacheFileMode'      => 0755,
      'settings' => [
        // ❌ Untuk form publik (hubungi kami, subscription)
        'default' => [
            'HTML.Doctype'             => 'HTML 4.01 Transitional',
            'HTML.Allowed'             => '', // Tidak boleh ada tag HTML
            'CSS.AllowedProperties'    => '',
            'AutoFormat.AutoParagraph' => false,
            'AutoFormat.RemoveEmpty'   => true,
        ],

        // ✅ Untuk admin (CMS dengan Summernote)
        'admin' => [
            'HTML.Doctype'             => 'HTML 4.01 Transitional',
            'HTML.Allowed'             => 'p,b,strong,i,em,u,a[href|title],ul,ol,li,br,span[style],img[src|alt|width|height],h1,h2,h3,h4,h5,h6,blockquote',
            'CSS.AllowedProperties'    => 'font,font-size,font-weight,font-style,font-family,text-decoration,color,background-color,text-align',
            'AutoFormat.AutoParagraph' => true,
            'AutoFormat.RemoveEmpty'   => true,
        ],
    ],
];
