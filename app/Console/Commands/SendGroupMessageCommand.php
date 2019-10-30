<?php declare(strict_types=1);

namespace App\Console\Commands;

use RocketChat\User;
use RuntimeException;
use RocketChat\Group;
use RocketChat\Client;
use Illuminate\Console\Command;

class SendGroupMessageCommand extends Command
{
    /** @var string */
    protected $signature = 'rc:send-message 
                            {groupname : The name of the group}
                            {--message= : The message to post}
                            {--random : send random message instead}';

    /** @var string */
    protected $description = 'Send a message to a specified Rocket Chat group.';

    public function handle(User $user, Client $client): void
    {
        $groupName = $this->argument('groupname');
        $message = $this->option('message');

        if ($this->hasOption('random')) {
            $message = collect(config('greetings'))->random();
        }

        throw_unless(
            $message, new RuntimeException('A message is required.')
        );

        throw_unless(
            collect($client->list_groups())->firstWhere('name', $groupName),
            new RuntimeException("Group: '$groupName' does not exist.")
        );

        (new Group($groupName))->postMessage($message);

        $this->logInfo("Group: {$groupName}");
        $this->logInfo("Message: {$message}");
    }

    private function logInfo(string $message): void
    {
        $this->info($message);
        \Log::info($message);
    }
}
