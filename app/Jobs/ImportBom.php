<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use League\Csv\Reader;
use App\Bom;
use File;

class ImportBom implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $filename;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    
    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $csv = Reader::createFromPath(storage_path('app/public/import/' . $this->filename), 'r');
        $csv->setHeaderOffset(0);

        foreach ($csv as $row) {
            Bom::create([
                'part_number' => $row['part_number'],
                'part_name' => $row['part_name']
            ]);
        }
        File::delete(storage_path('app/public/import/' . $this->filename));
    }
}
