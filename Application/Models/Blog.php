<?php

namespace Models;

use Core\Model;

class Blog extends Model {

    protected $table = 'blogs';

    protected $allowed = [
        'title',
        'description',
        'status'
    ];

    const STATUS_ACTIVE = 1;
    const STATUS_DEACTIVE = 0;

    protected $timestamp = true;

    public function __construct()
    {
        parent::__construct();
    }
}