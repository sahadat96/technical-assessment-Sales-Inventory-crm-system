<?php

namespace App\Jobs;


use App\Models\CustomerCampaign;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\PromotionMail;
use Exception;

class SendPromotionJob implements ShouldQueue
{
     use Queueable, InteractsWithQueue, SerializesModels;

    public function __construct(
        public CustomerCampaign $campaign
    ) {
    }

   public function handle(): void
    {
        try {

            $customer = $this->campaign->customer;

            if ($this->campaign->channel === 'email') {

                Mail::to($customer->email)
                    ->send(new PromotionMail($this->campaign));

            }

            $this->campaign->update([

                'status' => 'sent',

                'sent_at' => now()

            ]);

        } catch (\Throwable $e) {

            $this->campaign->update([

                'status' => 'failed'

            ]);

            throw $e;
        }
    }
}
