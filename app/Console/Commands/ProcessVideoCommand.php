<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Post;

class ProcessVideoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'video:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Video Process Upload';

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
        try {

            $videos = Post::where('video_process', 0)->get();

            if (count($videos) < 1) {
                $this->info('No files found');
                return;
            }

            $videos->map(function($video){
//                dd($video);
                $file = fopen("storage/app/".$video->video_url,'r');
//                Storage::disk('public')->put("storage/videos/{$image_name}",  $decoded_string);

                $video->video_process = true;
                $video->save();
//                dd($video);
            });

        } catch (\Exception $exception) {

            $this->error($exception->getMessage());
            return $exception->getMessage();
        }
    }
}
