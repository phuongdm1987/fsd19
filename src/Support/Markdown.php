<?php
declare(strict_types=1);

namespace Henry\Support;

use HTML_To_Markdown;
use Parsedown;

/**
 * Class Markdown
 * @package Henry\Support
 */
class Markdown
{

    protected $htmlParser;
    protected $markdownParser;

    /**
     * Markdown constructor.
     * @param HTML_To_Markdown $htmlParser
     * @param Parsedown $markdownParser
     */
    public function __construct(HTML_To_Markdown $htmlParser, Parsedown $markdownParser)
    {
        $this->htmlParser = $htmlParser;
        $this->htmlParser->set_option('header_style', 'atx');
        $this->markdownParser = $markdownParser;
    }

    /**
     * Convert html to markdown
     * @param string $html
     * @return string
     */
    public function convertHtmlToMarkdown(string $html): string
    {
        return $this->htmlParser->convert($html);
    }

    /**
     * Convert markdown to html
     * @param string $markdown
     * @return string
     */
    public function convertMarkdownToHtml(string $markdown): string
    {
        return $this->markdownParser->text($markdown);
    }
}
