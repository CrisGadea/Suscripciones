<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // database connection details         
        "db" => [            
             "host" => "ds059672.mlab.com:59672",             
             "user" => "trainee",            
             "pass" => "abc123",
             "dbname" => "academia_globalhitss",             
         ],
    ],
];
