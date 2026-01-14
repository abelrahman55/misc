<?php

if(!function_exists('res_data')){
    function res_data($data,$message='',$status=200){
        return response([
            'message'=>$message,
            'result'=>$data,
            'statusCode'=>200,
            'status'=>in_array($status,[200,201,202])?'success':'faild',
        ],$status);
    }
}

if(!function_exists('UploadFile')){
    function UploadFile($img,$location){
        $destinationPath = public_path('storage/' . $location);
        if (! file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }
        $image=$img;
        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move($destinationPath, $imageName);

        $img= $location . '/' . $imageName;
        return $img;
    }

}
