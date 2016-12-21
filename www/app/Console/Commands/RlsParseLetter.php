<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Parsers\Rls;

class RlsParseLetter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rls:parse-letter {file : Path to html file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse rlsnet trade names for a letter';

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
        $this->rls->parseLetter($file);
    }
}
