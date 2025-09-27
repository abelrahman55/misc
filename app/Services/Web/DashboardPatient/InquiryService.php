<?php
namespace App\Services\Web\DashboardPatient;

use App\Models\Inquiry;
use App\Traits\HasImage;
use Illuminate\Support\Facades\Auth;

class InquiryService
{
    use HasImage;
    public function __construct(public Inquiry $model)
    {}
    public function index()
    {
        return $this->model->paginate();
    }

    public function store($data)
    {
        // $data['user_id'] = 1;
        $user=Auth::guard('web')->user();

        // return $data;
        $data['user_id']=$user->id;
        $inquiry = $this->model->create($data);

        foreach ($data['files'] as $file) {


            $inquiry->files()->create([
                'file' => $this->saveImage($file, 'inquiries')
        ]);
        }
        return $inquiry;
    }

    public function show($id)
    {
        // return $id;
        // $inquery=Inquiry::with('files','patient')->where('id',$id)->first();
        return $this->model->with('patient')->findOrFail($id);
    }

    public function update($id, $data)
    {
        $inquiry = $this->model->findOrFail($id);

        $data['user_id'] = auth()->id();

        $inquiry->update($data);

        if (! empty($data['files'])) {
            $inquiry->files()->delete();

            $inquiry->files()->createMany(
                collect($data['files'])->map(fn($file) => ['file' => $file])->toArray()
            );
        }

        return $inquiry;
    }

    public function destroy($id)
    {
        $inquiry = $this->model->findOrFail($id);

        return $inquiry->delete();
    }

}