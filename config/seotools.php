<?php
/**
 * @see https://github.com/artesaos/seotools
 */

return [
    'meta' => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'        => "GameRangerZ.de | Ein deutscher Clan für Gaming & Airsoft", // set false to total remove
            'titleBefore'  => false, // Put defaults.title before page title, like 'It's Over 9000! - Dashboard'
            'description'  => 'GameRangerZ ist ein deutscher Multigaming-Clan welcher 2014 gegründet wurde. Wir kennen uns nun seit über 10 Jahren und spielen fast immer täglich miteinander.', // set false to total remove
            'separator'    => ' | ',
            'keywords'     => ["gaming","clan","airsoft","teamspeak"],
            'canonical'    => false, // Set null for using Url::current(), set false to total remove
            'robots'       => false, // Set to 'all', 'none' or any combination of index/noindex and follow/nofollow
        ],
        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
        ],

        'add_notranslate_class' => false,
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'       => 'GameRangerZ.de | Der Clan für Gaming & Airsoft', // set false to total remove
            'description' => 'GameRangerZ ist ein deutscher Multigaming-Clan welcher 2014 gegründet wurde. Wir kennen uns nun seit über 10 Jahren und spielen fast immer täglich miteinander.', // set false to total remove
            'url'         => false, // Set null for using Url::current(), set false to total remove
            'type'        => "website",
            'site_name'   => "GameRangerZ.de",
            'images'      => ["https://gamerangerz.de/img/opengraph.png"],
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
            //'card'        => 'summary',
            //'site'        => '@LuizVinicius73',
        ],
    ],
    'json-ld' => [
        /*
         * The default configurations to be used by the json-ld generator.
         */
        'defaults' => [
            'title'       => 'GameRangerZ.de | Gaming, Hosting & More', // set false to total remove
            'description' => 'GameRangerZ ist ein deutscher Multigaming-Clan welcher 2014 gegründet wurde. Wir kennen uns nun seit über 10 Jahren und spielen fast immer täglich miteinander.', // set false to total remove
            'url'         => false, // Set null for using Url::current(), set false to total remove
            'type'        => 'WebPage',
            'images'      => ["https://gamerangerz.de/img/opengraph.png"],
        ],
    ],
];
