<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

	 // database connection details         
        "db" => [            
             "host" => "your-host",             
             "dbname" => "your-database-name",             
             "user" => "your-db-username",            
             "pass" => "your-db-password"        
         ],
	

        // jwt settings
        "jwt" => [
            'secret' => 'supersecretkeyyoushouldnotcommittogithub'
        ]

    ],
	
];
