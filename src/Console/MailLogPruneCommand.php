<?php

namespace Mis3085\MailLog\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Mis3085\MailLog\Models\MailLog;

class MailLogPruneCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail-log:prune {--days=90}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prune mail logs';

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
     * @return mixed
     */
    public function handle()
    {
        $table = (new MailLog())->getTable();
        $days = (int) $this->option('days');
        $date = today()->subDays($days);

        $count = DB::table($table)->where('created_at', '<', $date)->delete();

        // defrag
        DB::statement(sprintf(
            'ALTER TABLE `%s` ENGINE = InnoDB;',
            $table
        ));

        $this->info("pruned {$table}: {$count}");
    }
}
