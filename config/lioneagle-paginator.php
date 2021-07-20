<?php

return [
    
    /**
     * The configuration values for the paginator page size
     */
    'page_size' => [

        /**
         * The URL parameter to be used for the page size
         */
        'url_parameter' => 'size',

        /**
         * The default page size
         */
        'default' => 25,
    ],

    /**
     * The configuration values for the paginator page number
     */
    'page_number' => [

        /**
         * The URL parameter to be used for the page number
         */
        'url_parameter' => 'number',

        /**
         * The default page number
         */
        'default' => 1,
    ],
    
    'paginator_method_name' => 'paginator'
];
