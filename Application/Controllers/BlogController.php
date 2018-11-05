<?php

namespace Controllers;

use Core\Controller;
use Core\ImageHandler;
use Models\Blog;
use Models\Image;

class BlogController extends Controller
{    
    private $imageHandler;
    private $image;

    public function __construct()
    {
        parent::__construct();

        $this->model = new Blog();
        $this->image = new Image();
        $this->imageHandler = new ImageHandler();
    }

    public function index()
    {
        $item = [
            'id'          => 7,
            'title'       => 'new title',
            'description' => 'new text',
            'status'      => '1'
        ];

        $items = $this->model->destroy(7);
        dd(123);
    }

    public function get($data)
    {
        echo json_encode([
            'object' => $this->model->find($data['id']),
            'images' => $this->image->findBy('object_id', $data['id'], 0)
        ]);
    }

    public function all($data = null)
    {
        if(!isset($data['page'])) {
            $data['page'] = 0;
        }

        $blogs = $this->model->findBy('status', 1, $data['page']);

        $items = [];
        for($i = 0; $i < count($blogs); $i++) {
            $items[$i] = [
                'object' => $blogs[$i],
                'images' => $this->image->findBy('object_id', $blogs[$i]['id'], 0)
            ];
        }

        echo json_encode($items);
    }

    public function create($data)
    {
        $id = $this->model->create([
            'title'       => $data['title'],
            'description' => $data['description'],
            'status'      => 1
        ]);

        $url = $this->imageHandler->saveImg($data['img'], $id);

        $this->image->create([
            'url'       => $url,
            'status'    => 1,
            'object_id' => $id
        ]);

        echo json_encode(['id' => $id]);
    }

    public function edit($data)
    {
        $this->model->edit([
            'title'       => $data['title'],
            'description' => $data['description'],
            'status'      => $data['status'],
            'id'          => $data['id']            
        ]);

        echo json_encode(['status' => true]);
    }

    public function destroy($data)
    {
        $this->model->destroy($data['id']);

        echo json_encode(['status' => true]);
    }
}