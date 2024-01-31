<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\RegardsMail;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendRegards extends Command
{
    protected $signature = 'send:regards';
    protected $description = 'Envia felicitacions als usuaris que han fet vendes en l\'últim any.';

    public function handle()
    {
        $yearAgo = Carbon::now()->subYear()->format('Y-m-d');

        $users = User::whereHas('book', function ($query) use ($yearAgo) {
            $query->where('soldDate', '>=', $yearAgo);
        })->get();

        foreach ($users as $user) {
            $user->notify(new RegardsMail($user));
        }

        $this->info('Felicitacions enviades amb èxit als usuaris que han fet vendes en l\'últim any.');
    }
}
