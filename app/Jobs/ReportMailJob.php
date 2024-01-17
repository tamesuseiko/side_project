<?php

namespace App\Jobs;

use App\Mail\ReportMail;
use App\Models\Product;
use App\Models\RequestProduct;
use App\Models\RequestProductMonitor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ReportMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public $id;
    public $RequestProduct;
    public $mouse;
    public $keyboard;
    public $RequestProductMonitor;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        Mail::to('thitipat1030@mgil.com')->send(new ReportMail($this->id));
    }
}
