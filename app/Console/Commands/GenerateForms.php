<?php

namespace App\Console\Commands;

use App\Models\Organization;
use App\Models\RealForm;
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
        $num = 0;
        $organizations = Organization::all();

        foreach ($organizations as $org ) {
            $forms = $org->forms;
            $users = $org->users;

            foreach ( $forms as $form ) {
                foreach ($users as $user) {
                    $num ++;
                    RealForm::factory()->create([
                        "user_id" => $user->id,
                        "form_id" => $form->id,
                    ]);
                }
            }
        }

        $this->info("Generate " . $num . " real-form successfully");
        return 0;
    }
}
