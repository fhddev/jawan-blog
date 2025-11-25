<?php
namespace App\Models;

class User {

    public $user_id;

    public $username;

    public $full_name;

    public $picture_path;

    public $job_title;

    public $bio;

    public $facebook_link;

    public $x_link;

    public $github_link;

    public $website_link;

    public $created_at;

    public static function from_array($data)
    {
        $u = new User();

        if( ! empty($data['user_id']) ) $u->user_id = $data['user_id'];
        if( ! empty($data['username']) ) $u->username = $data['username'];
        if( ! empty($data['full_name']) ) $u->full_name = $data['full_name'];
        if( ! empty($data['picture_path']) ) $u->picture_path = $data['picture_path'];
        if( ! empty($data['job_title']) ) $u->job_title = $data['job_title'];
        if( ! empty($data['bio']) ) $u->bio = $data['bio'];
        if( ! empty($data['facebook_link']) ) $u->facebook_link = $data['facebook_link'];
        if( ! empty($data['x_link']) ) $u->x_link = $data['x_link'];
        if( ! empty($data['github_link']) ) $u->github_link = $data['github_link'];
        if( ! empty($data['website_link']) ) $u->website_link = $data['website_link'];
        if( ! empty($data['created_at']) ) $u->created_at = $data['created_at'];

        return $u;
    }

}