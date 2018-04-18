<?php

namespace App\Http\Controllers;

use App\Url;
use Illuminate\Http\Request;

use App\Http\Requests;

class ApiController extends Controller
{
    //

    public function postUrl(Request $request){
        $this->validate($request, [
            'url' => 'required|url|max:255',
        ]);

        $url = $request->input('url');

        //TODO:: model url maker
        $model = Url::generate($url);

        return response()->json([
            'origin_url' => $model->url,
            'short_url' => $model->getShort(),
            'expired' => $model->getExpiredFormat('U')
        ]);
    }
}
