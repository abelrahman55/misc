<?php

namespace App\Services\Web;

use App\Models\Faq;
use App\Traits\HasImage;

class FaqsServices
{

    use HasImage;
    public function __construct(public Faq $model){}
    public function index()
    {
        return $this->model->get();
    }
    public function store($data){

        return $this->model->create($data);
    }
    public function update($data, $id)
    {
        $blog = $this->model->findOrFail($id);
       
        return $blog->update($data);
    }
    public function delete($id)
    {
        $blog = $this->model->findOrFail($id);
        return $blog->delete();
    }
}
