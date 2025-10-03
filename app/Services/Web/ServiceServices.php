<?php
namespace App\Services\Web;

use App\Models\Service;
use App\Traits\HasImage;

class ServiceServices
{

    use HasImage;
    public function __construct(public Service $model)
    {}
    public function index()
    {
        return $this->model->get();
    }
    public function store($data)
    {
        if (isset($data['image'])) {
            $data['image'] = $this->saveImage($data['image'], 'Service');
        }
        return $this->model->create($data);
    }
    public function update($data, $id)
    {
        $blog = $this->model->findOrFail($id);
        if (isset($data['image'])) {
            $data['image'] = $this->saveImage($data['image'], 'Service');
        }
        return $blog->update($data);
    }
    public function delete($id)
    {
        $service = $this->model->findOrFail($id);
        return $service->delete();
    }
}
