<?php

namespace App\Mail;

use App\Models\Product;
use App\Models\RequestProduct;
use App\Models\RequestProductMonitor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $id;
    public $RequestProduct;
    public $mouse;
    public $keyboard;
    public $RequestProductMonitor;
    public $monitor_sum;
    public $total;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id)
    {

        $this->id = $id;
        $this->RequestProduct =  RequestProduct::join('users','users.id','request_products.id_user')->find($id);
        $this->mouse = Product::where('id',$this->RequestProduct->id_mouse)->first();
        $this->keyboard = Product::where('id',$this->RequestProduct->id_keyboard)->first();
        $this->RequestProductMonitor = RequestProductMonitor::join('products','products.id','request_product_monitors.id_monitor')->where('id_reques_product',$id)->get();
        $this->monitor_sum = RequestProductMonitor::join('products','products.id','request_product_monitors.id_monitor')->where('id_reques_product',$id)->sum('price');
        $this->total = @$this->mouse->price + @$this->keyboard->price + @$this->monitor_sum;


    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('mail.report');
    }
}
