<?php
/**
 * Created by PhpStorm.
 * User: xiongfanglei
 * Date: 14-11-25
 * Time: 下午9:33
 */
class RemoteCurl
{
    /**
     * 超时时间30秒
     */
    const TIME_OUT_SECOND = 30;
    /**
     * cURL资源句柄
     * @var resource
     */
    private $res_curl;

    private static $instance;

    /**
     * 单例方法
     * @return RemoteCurl
     */
    public static function getInstance()
    {
        if (null == RemoteCurl::$instance)
            RemoteCurl::$instance = new RemoteCurl();
        return RemoteCurl::$instance;
    }

    private function __construct()
    {
        $this->res_curl = curl_init();
        // 默认以原生数据形式（raw）返回
        curl_setopt($this->res_curl, CURLOPT_BINARYTRANSFER, 1);
        curl_setopt($this->res_curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->res_curl, CURLOPT_HEADER, 0);
        curl_setopt($this->res_curl, CURLOPT_TIMEOUT, self::TIME_OUT_SECOND);
    }

    public function __destruct()
    {
        if (is_resource($this->res_curl))
            curl_close($this->res_curl);
    }

    /**
     * 设置cURL传输选项
     * @see cURL (http://cn2.php.net/curl/)
     *
     * @param int $option
     * @param mixed $value
     * @return boolean
     */
    public function curl_setopt($option, $value)
    {
        return curl_setopt($this->res_curl, $option, $value);
    }

    /**
     * 发出cURL请求
     * @param string $curl 远程访问地址
     */
    public function exec($url = NULL)
    {
        if (!empty($url))
            curl_setopt ($this->res_curl, CURLOPT_URL, $url);
        return curl_exec($this->res_curl);
    }

    /**
     * 向指定url post数据
     * @param $url
     * @param $data
     */
    public function post($url, $data)
    {
        curl_setopt($this->res_curl, CURLOPT_POST, true);
        if (is_array($data))
            curl_setopt($this->res_curl, CURLOPT_POSTFIELDS, http_build_query($data));
        elseif (is_string($data))
            curl_setopt($this->res_curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($this->res_curl, CURLOPT_URL, $url);
        $rt = json_decode(curl_exec($this->res_curl),TRUE);
        if(curl_getinfo($this->res_curl,CURLINFO_HTTP_CODE)!=200||empty($rt))
        {
            return array("code"=>1,"msg"=>"接口url访问无法正常返回","info"=>NULL);
        }
        elseif(empty($rt["errcode"]))
        {
            return array("code"=>0,"msg"=>"成功","info"=>$rt);
        }
        else {
            return array("code"=>$rt["errcode"],"msg"=>$rt["errmsg"],"info"=>NULL);
        }
    }

    /**
     * 向指定url post数据
     * @param $url
     * @param $data
     */
    public function postZone($url, $data)
    {
        curl_setopt($this->res_curl, CURLOPT_POST, true);
        if (is_array($data))
            curl_setopt($this->res_curl, CURLOPT_POSTFIELDS, http_build_query($data));
        elseif (is_string($data))
            curl_setopt($this->res_curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($this->res_curl, CURLOPT_URL, $url);
        $rt = json_decode(urldecode(curl_exec($this->res_curl)),TRUE);
        if(curl_getinfo($this->res_curl,CURLINFO_HTTP_CODE)!=200||empty($rt))
        {
            return array("code"=>1,"msg"=>"接口url访问无法正常返回","info"=>NULL);
        }
        elseif(!empty($rt["status"]))
        {
            if($rt["status"]=="success")
                return array("code"=>0,"msg"=>"成功","info"=>$rt);
            else
                return array("code"=>2,"msg"=>$rt["msg"],"info"=>NULL);
        }
        else {
            return array("code"=>1,"msg"=>"接口url访问无法正常返回","info"=>$rt);
        }
    }

    /**
     * 获取指定url的数据
     * @param $url
     */
    public function get($url)
    {
        curl_setopt($this->res_curl, CURLOPT_POST, FALSE);
        curl_setopt($this->res_curl, CURLOPT_URL, $url);
        return curl_exec($this->res_curl);
    }

    /**
     * 获取RESTFUL风格接口的数据返回
     * @param type $url  链接地址
     * @param type $data    数据，字符串格式
     * @param type $method  方法，默认是POST，全部大写
     * @return json
     */
    public function restful_request($url,$data,$method='POST') {
        curl_setopt($this->res_curl, CURLOPT_CUSTOMREQUEST, $method); //设置请求方式
        curl_setopt($this->res_curl, CURLOPT_URL, $url); //设置请求的URL
        curl_setopt($this->res_curl,CURLOPT_HTTPHEADER,array("X-HTTP-Method-Override: $method"));//设置HTTP头信息
        curl_setopt($this->res_curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($this->res_curl, CURLOPT_POSTFIELDS, $data);//设置提交的字符串

        $date['data'] = json_decode(curl_exec($this->res_curl));
        $date['code'] = curl_getinfo($this->res_curl,CURLINFO_HTTP_CODE);
        //兼容接口，先转换为json格式
        return json_encode($date);
    }
}