<?php

return [
    'encoding' => 'UTF-8',
    'finalize' => true,
    'cachePath' => storage_path('app/purifier'),
    'cacheFileMode' => 0755,
    'settings' => [
        'default' => [
            'HTML.Doctype' => 'HTML 4.01 Transitional',
            'HTML.Allowed' => 'br,b,strong,i,em,u,code,'
                . 'ul,ol,li,'
                . 'a[href|title],'
                . 'p[style|class],'
                . 'span[style|class],'
                . 'img[src|class],'
                . 'h1,h2,h3,h4,h5,'
                . 'table[class],thead[class],tbody,tr,th[colspan],td[colspan]',
            'CSS.AllowedProperties' => 'font-size,font-weight,font-style,text-decoration,padding-left,color,text-align',
            'Attr.AllowedClasses' => implode(',', [
                'table',
                'thead-light',
                'text-center',
                'badge',
                'badge-default',
                'badge-primary',
                'badge-success',
                'badge-info',
                'badge-warning',
                'badge-danger',
            ]),
            'AutoFormat.AutoParagraph' => false,
            'AutoFormat.RemoveEmpty' => true,
        ],
    ],
];
