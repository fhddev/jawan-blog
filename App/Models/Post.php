<?php
namespace App\Models;

class Post {

    public $post_id;

    public $url_slug;

    public $title;

    public $author_id;

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

}