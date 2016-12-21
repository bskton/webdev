<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Parsers\Rls;

class RlsParseTradeName extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rls:parse-trade-name {file : Path to html file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse rlsnet trade name page';

    /**
     * Rls service instance
     * 
     * @var App\Parsers\Rls
     */
    protected $rls;

    /**
     * Create a new command instance.
     *
     * @param  App\Parsers\Rls  $rls
     *
     * @return void
     */
    public function __construct(Rls $rls)
    {
        parent::__construct();

        $this->rls = $rls;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $file = $this->argument('file');
        $this->rls->parseTradeName($file);
    }
}
