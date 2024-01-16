<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\CarbonInterval;
use DateTime;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BirthdaysUpcoming extends Command
{

    const SECONDS_IN_DAY = 86400;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'birthdays:upcoming {duration}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display upcoming birthdays';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $interval = new CarbonInterval($this->argument('duration'));
        $duration = (new DateTime())->setTimeStamp(0)->add($interval)->getTimeStamp() / self::SECONDS_IN_DAY;

        $raw = "MAKE_DATE(
            EXTRACT(year FROM CURRENT_DATE)::INT,
            EXTRACT(month FROM birth)::INT,
            EXTRACT(day FROM birth)::INT
        )";

        $upcomingBirthdays = User::query()
            ->whereRaw("{$raw} BETWEEN CURRENT_DATE AND CURRENT_DATE+?::INT", [$duration])
            ->orderBy('birthday')
            ->get([
                'id',
                'name',
                'birth',
                DB::raw("{$raw} AS birthday")
            ]);
            

        dd($upcomingBirthdays->toArray());
    }
}
