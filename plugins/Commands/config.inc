<?php

return [
    'files'  => [
        'CommandInterface.php', //this needs to load BEFORE commands

        'Command/Join.php',
        'Command/Ping.php',

        'Commands.php', //this loads __LAST___
    ]
];