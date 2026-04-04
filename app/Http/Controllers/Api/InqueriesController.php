<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\MakeInqueriesRequest;
use App\Models\Inquiry;
use App\Models\InquiryFile;
use Illuminate\Support\Facades\Auth;

class InqueriesController{
    public function make_inquery(MakeInqueriesRequest $request){
        $lang=request()->header('lang','ar');
        $data=$request->validated();
        $messages = [
        'ar' => [
            'success' => 'تم إنشاء الاستفسار بنجاح',
            'fail'    => 'فشل في إنشاء الاستفسار',
        ],
        'en' => [
            'success' => 'Inquiry created successfully',
            'fail'    => 'Failed to create inquiry',
        ],
        'fr' => [
            'success' => 'La demande a été créée avec succès',
            'fail'    => 'Échec de la création de la demande',
        ],
        'gr' => [
            'success' => 'Η αίτηση δημιουργήθηκε με επιτυχία',
            'fail'    => 'Αποτυχία δημιουργίας αίτησης',
        ],
    ];

        $user=Auth::guard('users')->user();
        $data['user_id']=$user->id;
        $data['date']=now();
        $files=$data['files']??[];
        $new=Inquiry::create($data);
        if($new){
            foreach($files as $file){
                $new_file=UploadFile($file,'inqueries');
                $file_data=[
                    'inquiry_id'=>$new->id,
                    'file'=>$new_file
                ];
                InquiryFile::create($file_data);
            }
        }
        if($new){
            return res_data('',$messages[$lang]['success'],200);
        }
        return res_data('',$messages[$lang]['fail'],400);
    }
}
