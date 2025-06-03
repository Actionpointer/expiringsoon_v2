<?php

namespace App\Http\Controllers\Guest;

use App\Models\Post;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    

    public function test(){
        $owner = 'dr5hn'; // replace with actual owner
        $repo = 'countries-states-cities-database';   // replace with actual repo
        $branch = 'master'; // set your branch
        $apiUrl = "https://api.github.com/repos/{$owner}/{$repo}/commits/{$branch}";
    
        try {
                $response = Curl::to($apiUrl)
                    ->withHeader('User-Agent: LaravelApp') // GitHub requires user-agent
                    ->asJson()
                    ->get();
    
                // $latestSha = $response['sha'];
                dd($response);
            } catch (\Exception $e) {
                $this->error('Error fetching GitHub data: ' . $e->getMessage());
            }

            $latestSha = $response['sha'];

            // Retrieve last stored SHA
            if (Storage::exists($this->lastShaFile)) {
                $lastSha = Storage::get($this->lastShaFile);
            } else {
                $lastSha = '';
            }

            if ($latestSha !== trim($lastSha)) {
                // Update detected
                Storage::put($this->lastShaFile, $latestSha);
                $this->info('Update detected. You can trigger your download script here.');

                // e.g., call method to download files
                $this->downloadAndReplaceFiles();

            } else {
                $this->info('No update detected.');
            }
    
        
    }

    public function index(){
        $posts = Post::where('status',true)->get();
        return response()->json($posts,200);
    }

    public function show($post_id){
        $post = Post::find($post_id);
        return response()->json($post,200);
    }

    public function like($post_id){
        $post = Post::find($post_id);
        $post->likes++;
        $post->save();
        return response()->json($post,200);
    }

    

    

}
