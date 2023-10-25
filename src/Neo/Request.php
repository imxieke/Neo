<?php

/*
 * @Author: Cloudflying
 * @Date: 2022-09-16 18:51:03
 * @LastEditTime: 2022-09-16 22:40:30
 * @LastEditors: Cloudflying
 * @Description: Request
 * @FilePath: /Neo/src/Neo/Request.php
 */

namespace Neo;

class Request
{
    public function __construct()
    {
        $this->input = file_get_contents('php://input');
        $this->get      = $_GET;
        $this->post     = $_POST;
        $this->put      = $this->input;
        $this->request  = $_REQUEST;
        $this->file     = $_FILES ?? [];
        $this->server   = $_SERVER;
        $this->cookie   = $_COOKIE;
        // Cli 会报错
        $this->session  = $_SESSION ?? [];
        $this->env      = $_ENV;
    }

    public function method()
    {
        return 'method';
    }

    public function cookie(){}
    public function session(){}

    /**
     * 获取服务端信息
     */
    public function server()
    {
        return $this->server;
    }

    public function header(){}

    public function put(){}
    public function update(){}
    public function delete(){}
    public function patch(){}

    /**
     * 获取 .env 变量信息
     */
    public function env()
    {
    }
}
