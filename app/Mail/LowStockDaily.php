<?php

namespace App\Mail;

use App\Exports\LowStockExport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class LowStockDaily extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Low Stock')->markdown('emails.lowstock')->attach(
            Excel::download(
                new LowStockExport(),
                'report.xlsx'
            )->getFile(), ['as' => 'report.xlsx']
        );;
    }
}
