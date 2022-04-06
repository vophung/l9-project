<?php

namespace App\Jobs;

use App\Http\Controllers\User\MailController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;

    public $tries = 5;

    public $timeout = 30;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
        $this->queue = 'sendmail';
        $this->delay = now()->addMinute();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        MailController::sendRegisterMail($this->data['username'], $this->data['email'], $this->data['verification_code']);
    }
}
