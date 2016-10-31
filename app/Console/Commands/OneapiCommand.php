<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\OneApiController;
class OneapiCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'oneapi';
    protected $oneapi;
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To Sync one api offers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(OneApiController $oneapi)
    {
        parent::__construct();
        $this->oneapi = $oneapi;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
       $this->oneapi->syncAppThis();
       $this->oneapi->checkDeletedOffer();
    }
}
