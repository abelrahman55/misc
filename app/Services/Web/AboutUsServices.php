<?php
namespace App\Services\Web;

use App\Models\AboutUs;
use App\Traits\HasImage;

class AboutUsServices
{

    use HasImage;
    public function __construct(public AboutUs $model)
    {}
    public function index()
    {
        return $this->model->first();
    }

    public function store($data)
    {

        $about_us = $this->model->first();

        if ($about_us) {
            $about_us->update($data);
        } else {
            $about_us = $this->model->create($data);
        }
        if (isset($data['image'])) {
            $data['image'] = $this->saveImage($data['image'], 'about_us');
        }
        return $about_us;

    }

}
