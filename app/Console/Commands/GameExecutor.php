<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\RemainingTimeChanged;
use App\Events\WinnerNumberGenerated;

class GameExecutor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:execute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start executing the game';

    private $time = 15;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //define what to do with this command
        while(true) {
            broadcast(new RemainingTimeChanged($this->time . ' seconds remaining'));

            $this->time--;
            sleep(1);

            if ($this->time == 0) {
                $this->time = 'Waiting for next round';
                broadcast(new RemainingTimeChanged($this->time));
                
                broadcast(new WinnerNumberGenerated(mt_rand(1, 12)));
                sleep(5);
                $this->time = 15;
            }
        }
    }
}
