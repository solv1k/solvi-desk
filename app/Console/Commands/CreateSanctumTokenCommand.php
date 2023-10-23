<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

final class CreateSanctumTokenCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:sanctum-token {userId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create full access sanctum token for user.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = User::query()->findOrFail($this->argument('userId'));
        $token = $user->createToken('full_access')->plainTextToken;
        $this->info($user->name . ' > Bearer ' . $token);

        return Command::SUCCESS;
    }
}
