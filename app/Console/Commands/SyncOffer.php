<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\AppController;
use App\Http\Controllers\OneApiController;
use App\Http\Controllers\WadogoController;
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
    protected $oneapi;
    protected $wadogo;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(AppController $app_controler,OneApiController $oneapi,  WadogoController $wadogo)
    {
        parent::__construct();
        $this->app_controler = $app_controler;
        $this->oneapi = $oneapi;
        $this->wadogo = $wadogo;
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

       $this->oneapi->syncAppThis();
       $this->oneapi->checkDeletedOffer();

        $this->wadogo->syncAppThis();
       $this->wadogo->checkDeletedOffer();
    }
}
