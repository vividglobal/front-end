<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Services\AnalyticService;

class AnalysisWeeklyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'analytic:weekly-report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email analytic data within a week with excel file to OPERATOR.';

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
        $analyticService = new AnalyticService();
        $analyticService->exportDataEveryWeek();
    }
}
