<?php

namespace App\Services\Web;

use App\Models\Blog;
use App\Traits\HasImage;

class BlogServices
{

    use HasImage;
    public function __construct(public Blog $model){}
    public function index()
    {
        return $this->model->active()->get();
    }
    public function store($data){
        if (isset($data['image'])) {
            $data['image'] = $this->saveImage($data['image'], 'blogs');
        }
        return $this->model->create($data);
    }
    public function update($data, $id)
    {
        $blog = $this->model->findOrFail($id);
        if (isset($data['image'])) {
            $data['image'] = $this->saveImage($data['image'], 'blogs');
        }
        return $blog->update($data);
    }
    public function delete($id)
    {
        $blog = $this->model->findOrFail($id);
        return $blog->delete();
    }
}
