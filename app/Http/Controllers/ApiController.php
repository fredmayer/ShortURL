<?php

namespace App\Http\Controllers;

use App\Helpers\StringHelper;
use App\Url;
use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;

class ApiController extends Controller
{
    //

    protected function checkShort($short = false){
        $generated = 0;
        if(!$short || empty($short)) {
            $short = StringHelper::getInstance()->createRandomString();
            $generated = 1;
        }

        if(Url::where('short', $short)->exists()){
            if($generated == 1) {
                return $this->checkShort();
            }else{
                return false;
            }
        }
        return $short;
    }

    public function postUrl(Request $request){

        $validator = Validator::make($request->all(), [
            'url' => 'required|url|max:255',
            'short' => 'max:12',
        ]);
        $url = $request->input('url');
        $short = $request->input('short', '');
        $short = $this->checkShort($short);

        if($short === false){
            $validator->errors()->add('short', 'Short URL is already exists');
            return response()->json($validator->errors(), 400);
        }

        if(!$validator->fails()) {
            $validator->after(function ($validator) use ($url) {
                if (!Url::checkOriginUrl($url)) {
                    $validator->errors()->add('url', 'Can not access url');
                }
            });
        }

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $model = Url::generate($url, $short);

        return response()->json([
            'origin_url' => $model->url,
            'short_url' => $model->getShort(),
            'expired' => $model->getExpiredFormat('U')
        ]);
    }
}
