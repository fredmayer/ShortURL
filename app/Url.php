<?php

namespace App;

use App\Helpers\StringHelper;
use Illuminate\Database\Eloquent\Model;
use DB;
use Ixudra\Curl\Facades\Curl;

class Url extends Model
{
    //

    protected $table = 'urls';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['url', 'short', 'expired', 'visits'];

    /**
     * Генерация и запись короткого Url
     * @param $url string
     * @return object
     */
    public static function generate($url, $short){

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
            ->allowRedirect()
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

    public function commit(){
        DB::beginTransaction();
        try{
            $sql = "UPDATE `urls` SET `visits` = `visits`+1 WHERE `short`=?";

            DB::update($sql, [$this->short]);
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }

    }
}
