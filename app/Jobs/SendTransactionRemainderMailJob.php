<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\TransactionReminderMail;
use App\Models\Transaction;
use Carbon\Carbon;

class SendTransactionRemainderMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $transactions = Transaction::query()
            ->whereNull('reminded_at')
            ->get();

        if(count($transactions) > 0){
            foreach($transactions as $transaction){
                Mail::to($transaction->email)->send(new TransactionReminderMail($transaction));
                $transaction->reminded_at = Carbon::now()->toDateTimeString();
                $transaction->save();
            }
        }
    }
}
