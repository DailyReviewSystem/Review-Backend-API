<?php

namespace Database\Seeders;

use App\Models\Form;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(10)->create();
         Organization::factory(10)->create();

        $form = Form::create([
            "name" => "测试表单",
            "fields" => '[{"id":"date","label":"日期","type":"hidden","value":"@date@"},{"id":"week","label":"星期","type":"hidden","value":"@week@"},{"id":"place","label":"训练地点","type":"text","value":"123123"},{"id":"train-content","label":"训练内容","textarea":true},{"id":"train-note","label":"训练笔记","textarea":true},{"id":"train-thought","label":"训练感悟","textarea":true},{"id":"train-conclusion","label":"训练小结","textarea":true}]',
            "creator_id" => 1
        ]);

        $user = User::first();
        $org = Organization::first();

        $org->accept( $user );
        $org->register( $form );

        $user->update([ "username" => "user" ]);

        User::factory()->create([
            "username" => "admin"
        ]);

        Artisan::call("generate:forms");
    }
}
