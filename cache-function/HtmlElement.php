<?php


class HtmlElement
{
    private $styles = [
        'li' => 'list-style-type: none; background: #eaeaea; margin: 20px auto; padding: 10px 20px; border-radius: 10px; display: in-line; align-items: center; justify-content: space-between;',
        'margin-0' => 'margin: 0;',
        'padding-0' => 'padding: 0;'
    ];

    public function headerOne($text)
    {
        echo "<h1>$text</h1>";
    }

    public function headerTwo($text)
    {
        echo "<h2>$text</h2>";
    }

    public function headerThree($text)
    {
        echo "<h3>$text</h3>";
    }

    public function paragraph($text)
    {
        echo "<p>$text</p>";
    }

    public function loopPosts($posts)
    {
        $elements = "";
        if (!empty($posts) && sizeof($posts) > 0) {

            $elements .= "<ul style='" . $this->styles['margin-0'] . " " . $this->styles['padding-0'] . "'>";
            foreach ($posts as $post) {
                $elements .= "<li style='" . $this->styles['li'] . "'>";
                $elements .= "<h2>$post->title</h2>";
                $elements .= "<br />";
                $elements .= "<p>$post->body</p>";
                $elements .= "</li>";
            }
            $elements .= "</ul>";

        }

        echo $elements;
    }

    public function lineBreak()
    {
        echo "<br />";
    }
}