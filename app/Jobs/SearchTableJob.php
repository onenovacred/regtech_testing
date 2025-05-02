<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class SearchTableJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $table;
    protected $filter;
    protected $option;

    public function __construct($table, $filter, $option)
    {
        $this->table = $table;
        $this->filter = $filter;
        $this->option = $option;
    }

    public function handle()
    {
        $query = DB::table($this->table);

        if ($this->filter && $this->option) {
            $query->where($this->option, 'like', '%' . $this->filter . '%');
        }

        return $query->paginate(100)->toArray();
    }
}
