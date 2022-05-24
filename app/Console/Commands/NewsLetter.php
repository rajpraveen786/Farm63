<?php

namespace App\Console\Commands;

use App\Model\Newsletter as ModelNewsletter;
use Illuminate\Console\Command;

use App\Mail\LowStockDaily;
use App\Mail\Newsletter as MailNewsletter;
use App\Model\User;
use Mail;
class NewsLetter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:newsletteremail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data=Newsletter::where('status',1)->where('sent',0)->where('datetime','<=',date('d/m/Y h:i a'))->get();
        
        for($i=0;$i<$data->count();$i++){
            $datax=Newsletter::find($data[$i]->id);
            $userid=json_decode($datax->members);
            for($j=0;$j<count($userid);$j++){
                $user=User::find($userid[$j]);
                Mail::to($user->email)->send(new MailNewsletter($data[$i]));
            }
            $datax->sent=1;
            $datax->save();
        }
        return 0;
    }
}
