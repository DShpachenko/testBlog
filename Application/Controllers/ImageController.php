<?php

namespace Controllers;

use Core\Controller;
use Core\ImageHandler;
use Models\Image;

class ImageController extends Controller
{
    private $imageHandler;
    private $image;

    public function __construct()
    {
        parent::__construct();

        $this->image = new Image();
        $this->imageHandler = new ImageHandler();
    }

    public function create($data)
    {
        $url = $this->imageHandler->saveImg($data['img'], $data['id']);

        $this->image->create([
            'url'       => $url,
            'status'    => 1,
            'object_id' => $data['id']
        ]);

        echo json_encode(['url' => $url]);
    }

    public function getByBlog($data)
    {
        echo json_encode([
            'images' => $this->image->findBy('object_id', $blogs[$i]['id'], 0)
        ]);
    }

    public function edit($data)
    {
        $url = $this->imageHandler->saveImg($data['img'], $data['id']);

        $this->image->edit([
            'url'       => $url,
            'status'    => 1,
            'id'        => $data['id']
        ]);

        echo json_encode(['status' => true]);
    }

    public function destroy($data)
    {
        $this->model->destroy($data['id']);

        echo json_encode(['status' => true]);
    }
}