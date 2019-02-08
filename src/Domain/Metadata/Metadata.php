<?php
declare(strict_types=1);

namespace Henry\Domain\Metadata;

/**
 * Created by PhpStorm.
 * User: henry
 * Date: 02/02/2019
 * Time: 22:56
 */
class Metadata
{
    /**
     * @var string
     */
    private $owner;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var array
     */
    private $keywords = [];

    /**
     * @var string
     */
    private $facebook;

    /**
     * @var string
     */
    private $twitter;

    public function __construct()
    {
        $this->setDefaultInfo();
    }

    /**
     *
     */
    private function setDefaultInfo(): void
    {
        $owner = (string)config('fsd19.owner', '');
        $title = (string)config('fsd19.title', '');
        $description = (string)config('fsd19.description', '');
        $keywords = (array)config('fsd19.keywords', []);
        $facebook = (string)config('fsd19.facebook', '');
        $twitter = (string)config('fsd19.twitter', '');

        $this->setOwner($owner);
        $this->setTitle($title);
        $this->setDescription($description);
        $this->appendKeywords($keywords);
        $this->setFacebook($facebook);
        $this->setTwitter($twitter);
    }

    /**
     * @return string
     */
    public function getOwner(): string
    {
        return $this->owner;
    }

    /**
     * @param string $owner
     */
    public function setOwner(string $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $symbol
     * @return string
     */
    public function getFullTitle(string $symbol = '::'): string
    {
        return implode(' ', [$this->getTitle(), $symbol, $this->getOwner()]);
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @param array $keywords
     * @param bool $force
     */
    public function appendKeywords(array $keywords, bool $force = true): void
    {
        if ($force) {
            $this->keywords = $keywords;
            return;
        }

        $this->keywords = array_merge($this->keywords, $keywords);
    }

    /**
     * @param string $glue
     * @return string
     */
    public function getKeyWords(string $glue = ', '): string
    {
        return implode($glue, $this->keywords);
    }

    /**
     * @return string
     */
    public function getFacebook(): string
    {
        return $this->facebook;
    }

    /**
     * @param string $facebook
     */
    public function setFacebook(string $facebook): void
    {
        $this->facebook = $facebook;
    }

    /**
     * @return string
     */
    public function getTwitter(): string
    {
        return $this->twitter;
    }

    /**
     * @param string $twitter
     */
    public function setTwitter(string $twitter): void
    {
        $this->twitter = $twitter;
    }
}
