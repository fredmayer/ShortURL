<?php

namespace App\Http\Controllers;

use App\Url;
use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;

class ApiController extends Controller
{
    //

    public function postUrl(Request $request){

        $validator = Validator::make($request->all(), [
            'url' => 'required|url|max:255',
        ]);
        $url = $request->input('url');

        $validator->after(function($validator) use ($url) {
            if (!Url::checkOriginUrl($url)) {
                $validator->errors()->add('url', 'Can not access url');
            }
        });

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //TODO:: model url maker
        $model = Url::generate($url);

        return response()->json([
            'origin_url' => $model->url,
            'short_url' => $model->getShort(),
            'expired' => $model->getExpiredFormat('U')
        ]);
    }
}
