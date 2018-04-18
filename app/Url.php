<?php

namespace App;

use App\Helpers\StringHelper;
use Illuminate\Database\Eloquent\Model;
use Ixudra\Curl\Facades\Curl;

class Url extends Model
{
    //

    protected $table = 'urls';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['url', 'short', 'expired'];

    /**
     * Генерация и запись короткого Url
     * @param $url string
     * @return object
     */
    public static function generate($url){
        $short = StringHelper::getInstance()->createRandomString();

        if(self::where('short', $short)->exists()){
            return self::generate($url);
        }

        $expired = new \DateTime();
        $days = config('site.short_url_expired');
        $expired->modify("+{$days} day");

        return self::create([
            'url' => $url,
            'short' => $short,
            'expired' => $expired->format('Y-m-d H:i:s'),
        ]);
    }

    public static function checkOriginUrl($url){
        $res = Curl::to($url)
            ->returnResponseObject()
            ->get();

        if($res->status == 200){
            return true;
        }
        return false;
    }

    public function getShort(){
        $host = config('app.url');

        return $host . '/' . $this->short;
    }

    public function getExpiredFormat($format){
        $datTime = new \DateTime($this->expired);
        return $datTime->format($format);
    }
}
