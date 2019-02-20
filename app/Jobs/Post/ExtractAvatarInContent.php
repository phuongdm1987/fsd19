<?php
declare(strict_types=1);

namespace App\Jobs\Post;

use Henry\Domain\Post\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class ExtractAvatarInContent
 * @package App\Jobs\Post
 */
class ExtractAvatarInContent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var string
     */
    private $content;

    /**
     * Create a new job instance.
     * @param string $content
     */
    public function __construct(string $content)
    {
        $this->content = $content;
    }

    /**
     * Execute the job.
     * @param Crawler $crawler
     * @return string
     */
    public function handle(Crawler $crawler): string
    {
        $avatar = '';
        $crawler->addContent($this->content);

        foreach ($crawler->filter('img') as $img) {
            $cc      = new Crawler($img);
            $img_src = explode('/images/', $cc->attr('src'));
            $img_src = $img_src[1] ?? null;
            if($img_src && file_exists(Post::getThumbnailUploadPath() . $img_src)) {
                $size = getimagesize(Post::getThumbnailUploadPath() . $img_src);

                if ($size[0] >= 400 && $size[1] >= 200) {
                    $avatar = $img_src;
                    break;
                }
            }
        }

        return $avatar;
    }
}
