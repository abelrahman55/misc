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