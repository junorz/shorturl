<?php

namespace App\Http\Controllers;

use App\Url;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    /**
     * 显示首页
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('index');
    }

    /**
     * 验证数据并存入数据库
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function convert(Request $request)
    {
        $this->validate($request, [
            'url' => 'required|url'
        ]);

        $url = self::randString(6); //尝试取得短网址
        while (Url::where('url', $url)->first()) { //万一数据库里已有此短网址,则尝试再取
            $url = self::randString(6);
        }

        $store = array(
            'url' => $url,
            'original_url' => $request->get('url'),
            'user_id' => 0
        );

        Url::create($store);

        Session::flash('url', $url);
        Session::flash('original_url', $request->get('url'));
        return redirect(url('/'));
    }

    public function goto($url)
    {
        if (@$gotourl = Url::where('url', $url)->first()->original_url){
            return redirect($gotourl);
        }else{
            Session::flash('nodata','你输入的短网址不存在');
            return redirect(url('/'));
        }

    }

    /**
     * 生成随机字符串
     *
     * @access public
     * @param integer $length 字符串长度
     * @param bool $specialChars 是否有特殊字符
     * @return string
     */
    public static function randString($length, $specialChars = false)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        if ($specialChars) {
            $chars .= '!@#$%^&*()';
        }

        $result = '';
        $max = strlen($chars) - 1;
        for ($i = 0; $i < $length; $i++) {
            $result .= $chars[rand(0, $max)];
        }
        return $result;
    }
}
