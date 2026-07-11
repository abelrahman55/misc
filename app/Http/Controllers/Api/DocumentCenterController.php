<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AddNewDocumentRequest;
use App\Models\DocumentCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentCenterController extends Controller
{
    //
    public function my_documents()
    {
        $user = Auth::guard('users')->user();

        $documents = DocumentCenter::where('user_id', $user->id)
            ->paginate(10);

        $documents->getCollection()->transform(function ($doc) {
            return [
                'id' => $doc->id,
                'file' => asset('storage/' . $doc->file),
                'descripe' => $doc->descripe,
                'created_at' => $doc->created_at->toDateTimeString(),
            ];
        });

        return response()->json($documents);
    }
    public function add_new_document(AddNewDocumentRequest $request){
        $lang=request()->header('lang','ar');
        $data = $request->validated();
        if(request()->hasFile('file')){
            $data['file']=UploadFile($data['file'],'document_centers');
        }
        $data['user_id'] = Auth::guard('users')->id();
        $new=DocumentCenter::create($data);
                $messages = [
        'ar' => [
            'success' => 'تم إنشاء ',
            'fail'    => 'فشل في إنشاء ',
        ],
        'en' => [
            'success' => ' created successfully',
            'fail'    => 'Failed to create ',
        ],
        'fr' => [
            'success' => ' créée avec succès',
            'fail'    => 'Échec de la création de la demande',
        ],
        'gr' => [
            'success' => 'Η αίτηση δημιουργήθηκε με επιτυχία',
            'fail'    => 'Αποτυχία δημιουργίας αίτησης',
        ],
    ];
        if($new){
            return res_data('',$messages[$lang]['success'],200);
        }
        return res_data('',$messages[$lang]['fail'],400);
        // return response()->json(['message' => 'Document added successfully']);
    }
    public function delete_document(){
        $lang=request()->header('lang','ar');
        $user = Auth::guard('users')->user();
        $id=request()->route('id');
        $document=DocumentCenter::where('id',$id)->where('user_id',$user->id)->first();
        $messages = [
        'ar' => [
            'success' => 'تم الحذف بنجاح',
            'fail'    => 'فشل في الحذف',
        ],
        'en' => [
            'success' => ' deleted successfully',
            'fail'    => 'Failed to delete ',
        ],
        'fr' => [
            'success' => ' supprimée avec succès',
            'fail'    => 'Échec de la suppression de la demande',
        ],
        'gr' => [
            'success' => 'Η αίτηση διαγράφηκε με επιτυχία',
            'fail'    => 'Αποτυχία διαγραφής αίτησης',
        ],
    ];
        if(!$document){
            return res_data('',$messages[$lang]['fail'],400);
        }
        $document->delete();
        return res_data('',$messages[$lang]['success'],200);
    }
public function update_document(Request $request, $id)
{
    $lang = $request->header('lang', 'ar');
    $user = Auth::guard('users')->user();

    $document = DocumentCenter::where('id', $id)
        ->where('user_id', $user->id)
        ->first();

    $messages = [
        'ar' => [
            'success' => 'تم التحديث بنجاح',
            'fail'    => 'فشل في التحديث',
        ],
        'en' => [
            'success' => 'Updated successfully',
            'fail'    => 'Failed to update',
        ],
        'fr' => [
            'success' => 'Mis à jour avec succès',
            'fail'    => 'Échec de la mise à jour',
        ],
        'gr' => [
            'success' => 'Η ενημέρωση ολοκληρώθηκε με επιτυχία',
            'fail'    => 'Αποτυχία ενημέρωσης',
        ],
    ];

    if (!$document) {
        return res_data('', $messages[$lang]['fail'], 400);
    }

    // جهز بيانات التحديث
    $updateData = [
        'descripe' => $request->input('descripe', $document->descripe),
    ];

    // لو فيه ملف مرفوع
    if ($request->hasFile('file')) {
        $file = UploadFile($request->file('file'), 'document_centers');
        if ($file) {
            $updateData['file'] = $file;
        }
    }

    // نفذ التحديث مرة واحدة
    $document->update($updateData);

    return res_data('', $messages[$lang]['success'], 200);
}

}
