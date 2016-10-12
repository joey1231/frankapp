<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\AppController;
class SyncOffer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'syncoffer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'to sysnc offers ';
    protected $app_controler;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(AppController $app_controler)
    {
        parent::__construct();
        $this->app_controler = $app_controler;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       $this->app_controler->syncAppThis();
       $this->app_controler->checkDeletedOffer();
    }
}
