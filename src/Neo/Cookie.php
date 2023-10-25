<?php

/*
 * @Author: Cloudflying
 * @Date: 2022-09-16 18:56:06
 * @LastEditTime: 2022-09-16 21:49:03
 * @LastEditors: Cloudflying
 * @Description: Cookie
 * @FilePath: /Neo/src/Neo/Cookie.php
 */


namespace Neo;

use Neo\Request;

class Cookie
{
    protected array $config = [
        // 过期时间 设为 0 则 会话结束时过期（也就是关掉浏览器时）
        'expire' => 0,
        // 保存路径
        'path' => '/',
        // 有效域名/子域名
        'domain' => '',
        // 启用安全传输
        'secure' => false,
        // 防止 XSS 攻击 仅可通过 HTTP 协议访问
        'httponly' => false,
        // 防止 CSRF 攻击和用户追踪, 支持选项 strict lax none
        'samesite' => 'lax'
    ];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * 获取参数 设置 Cookie
     */
    public function set(
        string  $name,
        string  $value,
        int     $expire   = 0,
        string  $path     = '/',
        string  $domain   = '',
        bool    $secure   = false,
        bool    $httponly = false,
        string  $samesite = 'lax'
        )
    {
        // 若值为空则删除对应 Cookie
        if ( \is_null($value) || $value == '')
        {
            return $this->del($name);
        }else{
            $this->config['expire'] = $expire;
            $this->config['path'] = $path;
            $this->config['domain'] = $domain;
            $this->config['secure'] = $secure;
            $this->config['httponly'] = $httponly;
            $this->config['samesite'] = $samesite;
            return $this->setCookie($name,$value);
        }
    }

    /**
     * 删除 Cookie
     * @param string $name
     * @return bool
     */
    public function del(string $name)
    {

    }

    public function get(){}

    /**
     * 判断 Cookie 是否存在
     * @param string $name
     * @return bool
     */
    public function has(string $name)
    {
        $this->request->cookie->has($name);
    }

    /**
     * 执行 Cookie 键值设定
     * @param string $name
     * @param string $value
     * @return bool
     */
    protected function setCookie(string $name,string $value)
    {
        return \setcookie($name,$value,$this->config);
    }
}
