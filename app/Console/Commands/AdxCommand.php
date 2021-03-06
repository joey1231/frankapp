<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\CpiController;
class AdxCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cpi';
    protected $ctr;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Wadogo Offers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CpiController $ctr)
    {
        parent::__construct();
        $this->ctr = $ctr;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->ctr->syncAppThis();
       $this->ctr->checkDeletedOffer();
    }
}
