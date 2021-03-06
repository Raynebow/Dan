<?php namespace Plugins\Commands\Command;

Use Dan\Core\Config as Cfg;
use Dan\Irc\Channel;
use Dan\Irc\User;
use Plugins\Commands\CommandInterface;

class Config implements CommandInterface {

    protected $guarded = [
        'irc.password',
        'irc.channels',
        'dan.sudo_users',
    ];

    /**
     * Runs the command.
     *
     * @param \Dan\Irc\Channel $channel
     * @param \Dan\Irc\User    $user
     * @param                  $message
     * @return void
     */
    public function run(Channel $channel, User $user, $message)
    {
        $data = explode(' ', $message);

        if(isset($data[1]))
        {
            if (in_array($data[1], $this->guarded))
            {
                $user->sendNotice('This value is guarded.');
                return;
            }
        }

        switch($data[0])
        {
            case 'reload':
                Cfg::load();
                $user->sendNotice("Config reloaded");
                break;

            case 'set':
                Cfg::set($data[1], $data[2]);
                $user->sendNotice("Config key {$data[1]} set to {$data[2]}");
                break;

            case 'get':
                $user->sendNotice($data[1] . " : " . Cfg::get($data[1]));
                break;
        }
    }

    /**
     * Command help.
     *
     * @param \Dan\Irc\User $user
     * @param               $message
     * @return mixed
     */
    public function help(User $user, $message)
    {
        $user->sendNotice("config reload - Reloads the config");
        $user->sendNotice("config set <key> <value> - Sets a config value ");
        $user->sendNotice("config get - Gets a config value");
    }
}