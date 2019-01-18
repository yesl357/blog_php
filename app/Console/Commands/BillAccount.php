<?php
/**
 * 计算版权、制作方的计算相关数据
 * @desc php artisan bill:account
 * @author 1520683535@qq.com
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BillAccount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bill:account';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate settlement data';

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
        DB::table('recent_users')->insert([
            'code'=>1,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        $this->info('success');
    }
}
