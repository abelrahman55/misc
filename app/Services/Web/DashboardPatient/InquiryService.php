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
        $query = Inquiry::query();

        if (request()->filled('search')) {
            $query->where('name', 'LIKE', '%' . request('search') . '%')
                ->orWhere('contact_details', 'LIKE', '%' . request('search') . '%');
        }

        if (request()->filled('date_filter')) {
            if (request('date_filter') == 'today') {
                $query->whereDate('created_at', today());
            } elseif (request('date_filter') == 'last_7_days') {
                $query->where('created_at', '>=', now()->subDays(7));
            }
        }

        if (request()->filled('status')) {
            $query->where('status', request('status'));
        }

        return $query->paginate(10);
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