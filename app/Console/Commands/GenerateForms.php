<?php

namespace App\Console\Commands;

use App\Models\Organization;
use Illuminate\Console\Command;

class GenerateForms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:forms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate real forms for today';

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
        Organization::all()->each( function($org) {
            $forms = $org->forms;

            $org->users->each( function($user) {
                dd( $user );
            });
        });

        return 0;
    }
}
