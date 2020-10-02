<?php

namespace App\Jobs;

use App\Mailbox;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateUserMailbox implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var User
     */
    private $user;
    /**
     * @var array
     */
    private $data;

    /**
     * Create a new job instance.
     *
     * @param User $user
     * @param array $data
     */
    public function __construct(User $user, array $data)
    {
        $this->user = $user;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mailbox::create([
            'domain_id' => 1,
            'email' => $this->data['username'] . "@gamerangerz.de",
            'password' => crypt($this->data['password'], sprintf('$6$%s$', substr(bin2hex(openssl_random_pseudo_bytes(16)), 0, 16))),
            'user_id' => $this->user->id
        ]);
    }
}
