<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Url;

class ShortenerController extends Controller
{
    //

    public function go($short){
        $model = Url::where('short', $short)->where('expired', '>', date('Y-m-d H:i:s'))->first();

        if(!$model){
            abort(404);
        }

        //Подсчет кол-ва визитов;
        $model->commit();

        return redirect($model->url);
    }
}
