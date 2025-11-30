<?php
namespace App\Models;

class Post {

    public $post_id;

    public $url_slug;

    public $title;

    public $author_id;

    public $author;

    public $x_minutes_read;

    public $created_at;

    public $category;

    public $tags;

    public $content;

    public $cover_image;

    public static function from_array($data)
    {
        $e = new Post();

        if( ! empty($data['post_id']) ) $e->post_id = $data['post_id'];
        if( ! empty($data['url_slug']) ) $e->url_slug = $data['url_slug'];
        if( ! empty($data['title']) ) $e->title = $data['title'];
        if( ! empty($data['author_id']) ) $e->author_id = $data['author_id'];
        if( ! empty($data['user_id']) ) $e->author = User::from_array($data);
        if( ! empty($data['x_minutes_read']) ) $e->x_minutes_read = $data['x_minutes_read'];
        if( ! empty($data['created_at']) ) $e->created_at = $data['created_at'];
        if( ! empty($data['category']) ) $e->category = $data['category'];
        if( ! empty($data['tags']) ) $e->tags = $data['tags'];
        if( ! empty($data['content']) ) $e->content = $data['content'];
        if( ! empty($data['cover_image']) ) $e->cover_image = $data['cover_image'];

        return $e;
    }

    public function encodeTags()
    {
        return json_encode($this->tags);
    }

    public function decodeTags()
    {
        return json_decode(html_entity_decode($this->tags), true);
    }

    public function get_short_content(int $length = 150): string
    {
        $text = strip_tags($this->content);
        $text = html_entity_decode($text);
        $text = preg_replace('/\s+/', ' ', $text);
        $text = trim($text);

        if (strlen($text) <= $length) {
            return $text;
        }

        $short = substr($text, 0, $length);
        $short = preg_replace('/\s+?(\S+)?$/', '', $short);

        return $short . '...';
    }

}