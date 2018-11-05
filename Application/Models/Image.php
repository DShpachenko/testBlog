<?php

namespace Models;

use Core\Model;

class Image extends Model {

    protected $table = 'images';

    protected $allowed = [
        'url',
        'status',
        'object_id'
    ];

    const STATUS_ACTIVE = 1;
    const STATUS_DEACTIVE = 0;

    protected $timestamp = false;

    public function __construct()
    {
        parent::__construct();
    }
}