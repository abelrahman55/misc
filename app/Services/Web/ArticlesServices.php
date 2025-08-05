<?php

namespace App\Services\Web;

use App\Models\Articles;
use App\Traits\HasImage;

class ArticlesServices
{

    use HasImage;
    public function __construct(public Articles $model){}
    public function index()
    {
        return $this->model->active()->get();
    }
    public function store($data){
        if (isset($data['image'])) {
            $data['image'] = $this->saveImage($data['image'], 'Articless');
        }
        return $this->model->create($data);
    }
    public function update($data, $id)
    {
        $Articles = $this->model->findOrFail($id);
        if (isset($data['image'])) {
            $data['image'] = $this->saveImage($data['image'], 'Articless');
        }
        return $Articles->update($data);
    }
    public function delete($id)
    {
        $Articles = $this->model->findOrFail($id);
        return $Articles->delete();
    }
}
