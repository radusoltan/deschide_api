<?php

namespace App\Services;

use App\Models\Article;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Illuminate\Support\Facades\Http;

class FaceBookService {

    protected $fb;
    protected $pageId;
    protected $accessToken;
    public function __construct()
    {
        $this->fb = new Facebook([
            'app_id' => env('FACEBOOK_APP_ID'),
            'app_secret' => env('FACEBOOK_APP_SECRET'),
            'default_graph_version' => 'v11.0',
        ]);

        $this->pageId = env('FACEBOOK_PAGE_ID');
        $this->accessToken = env('FACEBOOK_PAGE_ACCESS_TOKEN');
    }

    public function postArticle(Article $article)
    {
        try {

            $response = Http::post("https://graph.facebook.com/v20.0/{$this->pageId}/feed", [
                'body' => [
                    'message' => '$article->title',
                    'access_token' => $this->accessToken,
                ]

            ]);

            dump($response->body());

        } catch (\Facebook\Exceptions\FacebookResponseException $e) {
            // Handle Graph API errors
            throw new \Exception('Graph returned an error: ' . $e->getMessage());
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            // Handle SDK errors
            throw new \Exception('Facebook SDK returned an error: ' . $e->getMessage());
        }
    }

}
