<?php
namespace App\Services\Web;

use App\Models\Brand;
use App\Traits\HasImage;

class BrandServices
{

    use HasImage;
    public function __construct(public Brand $model)
    {}
    public function index()
    {
        return $this->model->first();
    }

    public function store($data)
    {

        $brand = $this->model->first();

        if ($brand) {
            $brand->update($data);
        } else {
            $brand = $this->model->create($data);
        }
        if (isset($data['image'])) {
            $data['image'] = $this->saveImage($data['image'], 'brand');
        }
        return $brand;

    }

}
