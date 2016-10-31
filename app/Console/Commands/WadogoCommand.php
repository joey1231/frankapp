<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\WadogoController;
class WadogoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wadogo';
    protected $wadogo;

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
    public function __construct(WadogoController $wadogo)
    {
        parent::__construct();
        $this->wadogo = $wadogo;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->wadogo->syncAppThis();
       $this->wadogo->checkDeletedOffer();
    }
}
