<?php
/**
 * Description of KefuException
 * 自定义Exception类型定义
 * Create time : 2012-12-11 13:48:19
 * UTF-8
 * @author xiongfanglei
 */
class KefuExceptionType
{
    // Error Code
    const NO_ERROR = 0;
    const ERR_PARAM_ERROR = 1;
    const ERR_LOGIN_FIRST = 2;
    const ERR_PAGE_RANGE = 3;
    const ERR_LACK_AUTHORITY = 4;
    const ERR_AUTH_FAILURE = 100;
    const ERR_FILE_NOTEXISTS = 101;
    
    // 登陆错误
    const ERR_LOGIN = 1001;
    const ERR_USER_NO_EXISTS = 1002;
    const ERR_USER_HAS_EXISTS = 1003;
    
    // 数据库操作错误
    const ERR_DUPLICATE_RECORD = 2001;
    const ERR_RECORD_NOT_EXIST = 2002;
    const ERR_DELETE_RECORD_FAILURE = 2003;
    const GEN_ERROR_CREATE_RECORD = 2004;
    const ERROR_UPDATE_RECORD_FAILURE = 2005;
    
    // Error reason
    static public $ERROR_INFO = array(
        self::NO_ERROR => 'no error',
        self::ERR_PARAM_ERROR => '接口请求参数违例',
        self::ERR_LOGIN_FIRST => '请先登录系统',
        self::ERR_PAGE_RANGE => '分页参数超出范围',
        self::ERR_LACK_AUTHORITY => '不具备足够的访问权限，请联系管理员',
        self::ERR_AUTH_FAILURE => '账号认证失败',
        self::ERR_FILE_NOTEXISTS => '文件或目录不存在',
        
        self::ERR_LOGIN => '用户密码或域错误',
        self::ERR_USER_NO_EXISTS => '用户不存在，请联系管理员',
        self::ERR_USER_HAS_EXISTS => '该邮箱已经被注册，请确认用户信息',
        
        self::ERR_DUPLICATE_RECORD => '重复的数据记录',
        self::ERR_RECORD_NOT_EXIST => '数据记录不存在',
        self::ERR_DELETE_RECORD_FAILURE => '删除数据记录失败',
        self::GEN_ERROR_CREATE_RECORD => '创建记录失败',
        self::ERROR_UPDATE_RECORD_FAILURE => '更新记录失败',
    );
    
    
    /**
     * 从错误码翻译到错误原因
     * 
     * @param int $code
     * @return string
     */
    static public function translateError($code)
    {
        $err_msg = 'unkown error';
        if (array_key_exists($code, self::$ERROR_INFO))
        {
            $err_msg = self::$ERROR_INFO[$code];
        }
        return $err_msg;
    }
    
}
