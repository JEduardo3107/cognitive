<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InsertCronTime extends Command{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:customtest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Inserta la hora actual en la tabla cron_test para monitorear el cron job';

    /**
     * Execute the console command.
     */
    public function handle(){
        DB::table('cron_test')->insert([
            'execution_time' => Carbon::now()
        ]);

        $this->info('Hora actual insertada en cron_test.');
    }
}