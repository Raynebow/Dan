<?php

return [

    /*
     * Command starter
     * Example:
     *
     * .part #channel parting
     */
    'command_starter'   => getenv("COMMAND_STARTER"),

    /*
     * Show errors when a command doesn't exist?
     */
    'show_nonexistent_command_error'   => true,

    /*
     * Command rank requirements
     * You can give commands some permissions for use]
     * Example, lets say you want ping to only be used by voiced people and owners,
     * you would give it +~ as a rank.
     *
     * Valid Permissions:
     * S    = Sudo users. See config/dan.php
     * ~    = owner
     * &    = admin
     * @    = operator
     * %    = half-op
     * +    = voice
     * x    = no rank
     */
    'ranks' => [
        //Commands plugin
        'config'    => 'S',
        'hash'      => '+%@&~',
        'join'      => 'S',
        'memory'    => 'S',
        'part'      => 'S',
        'ping'      => 'x+%@&~',
        'plugin'    => 'S',
        'say'       => 'S',

        //Fun plugin
        'lenny'     => 'x+%@&~',
        'nbc'       => 'x+%@&~',
        'trp'       => 'x+%@&~',
    ]
];