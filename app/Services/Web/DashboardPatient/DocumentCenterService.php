<?php
namespace App\Services\Web\DashboardPatient;

use App\Models\DocumentCenter;
use App\Traits\HasImage;

class DocumentCenterService
{
    use HasImage;
    public function __construct(public DocumentCenter $model)
    {}
    public function index()
    {
        return $this->model->get();
    }

    public function store($data)
    {
        $data['user_id'] = auth()->id();

        if (isset($data['file'])) {
            $data['file'] = $this->saveImage($data['file'], 'document_centers');
        }

        $document_centers = $this->model->create($data);

        return $document_centers;
    }



    public function update($id, $data)
    {
        $document_centers = $this->model->findOrFail($id);

        $data['user_id'] = auth()->id();
        if (! empty($data['file']))
        {
            $document_centers->delete();

            $data['file'] = $this->saveImage($data['file'], 'document_centers');

        }

        $document_centers->update($data);

        return $document_centers;
    }

    public function destroy($id)
    {
        $document_centers = $this->model->findOrFail($id);

        return $document_centers->delete();
    }

}
