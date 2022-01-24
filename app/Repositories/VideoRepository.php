<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\SparePartsStore;

class VideoRepository
{

    public function __construct()
    {

//
    }

    public function uploadVideo($file,$extension,$post_id,$type_id)
    {

        return $this->upload($file,$extension,$post_id,$type_id);

    }

    private function upload($file,$extension,$post_id,$type_id)
    {
        if($type_id == 0){
            
          $post = Post::where('id',$post_id)->first();    
        }
        else{
            
            $post = SparePartsStore::where('id',$post_id)->first();
        }
        
        if (!is_null($post->video_url)) {
            // Check image existing
            $deleting_name = explode('/', $post->video_url);
            if (file_exists(pathBackMakeForwardSlash('storage\app\videos\\' . $deleting_name[1])) && $deleting_name[1] != NULL) {
                // Unlink File
                unlink(pathBackMakeForwardSlash('storage\app\videos\\' . $deleting_name[1]));
            }
            if (file_exists(pathBackMakeForwardSlash(public_path('\assets\videos\\' . $deleting_name[1]))) && $deleting_name[1] != NULL) {
                // Unlink File
                unlink(pathBackMakeForwardSlash(public_path('\assets\videos\\' . $deleting_name[1])));
            }
        }
        $path = Storage::putFileAs("public/videos", $file, uniqid().".".$extension);
//        $upload_video = Post::where('id',3)->update(['title'=>'Updated title']);
        $updateDetails = [
            'video_url' => $path,
            'video_process' => false,
        ];
         
        if($type_id == 0){
         $upload_video = DB::table('posts')
            ->where('id', $post_id)
            ->update($updateDetails);
        }
        else
        {
            $upload_video = DB::table('spare_parts_stores')
            ->where('id', $post_id)
            ->update($updateDetails);
            
        }
        return $upload_video;
    }

}
