<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Newsletter extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data,$user;
    public function __construct($data,$user)
    {
        $this->data=$data;
        $this->user=$user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $typedata=$this->data->type;
        return $this->subject($this->data->subject)->markdown('emails.newsletter.template1',[
            'content'=>$this->data->content,
            'emailunsub'=>encrypt($this->user->email),
            'img'=>strlen($this->data->type['loc'])>0 ? $this->data->type['loc']:'/storage/img/oilemail.jpg'
        ]);
    }
}
