<?php
namespace App\Models;

class EmailSubscription {

    public $subscriber_id;

    public $email;

    public $subscribed_at;

    public static function from_array($data)
    {
        $allowed_columns = ['subscriber_id', 'email', 'subscribed_at'];
        
        $e = new (static::class)();

        foreach ($allowed_columns as $key => $value) {
            if (!empty($value) && property_exists($e, $key)) {
                $e->$key = $value;
            }
        }

        return $e;
    }

}