<?php

namespace App\Jobs;

use App\Models\Tag;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class TagUpdateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public $tags)
    {
        $this->tags = $tags;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $product_tags = $this->tags;
        foreach($product_tags as $targ){
            $found = Tag::where('name','LIKE',"%$targ%")->get();
            if($found->isEmpty()){
                Tag::create(['name'=> $targ]);
            }
        }
    }
}
