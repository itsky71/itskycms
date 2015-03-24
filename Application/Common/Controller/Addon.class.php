<?php
// +----------------------------------------------------------------------
// | ITskyCMS
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.itsky71.net All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: itsky <itsky71@foxmail.com>
// +----------------------------------------------------------------------
namespace Common\Controller;
/**
 * Description of Addon
 * 插件类
 * @author itsky
 */
abstract class Addon {
    /**
     * 视图实例对象
     * @var view
     * @access protected
     */
    protected $view = null;
    /**
     * $info = array(
     *      'name' => 'editor',
     *      'title' => '编辑器',
     *      'description' => '用于增强整站长文本的输入和显示',
     *      'status' => 1,
     *      'author' => 'itsky',
     *      'version' => '1.0'
     * );
     */
    public $info = array();
    /**
     * @var string 插件路径
     */
    public $addon_path = '';
    /**
     * @var string 配置文件
     */
    public $config_file = '';
    /**
     * @var string 自定义配置
     */
    public $custom_config = '';
    /**
     * @var array Description
     */
    public $admin_list = array();
    /**
     * @var array Description
     */
    public $custom_adminlist = '';
    /**
     * @var array 访问url
     */
    public $access_url = array();
    /**
     * 构造函数
     */
    public function __construct() {
        $this->view         =   \Think\Think::instance('Think\View');
        $this->addon_path   =   ADDON_PATH.$this->getName.'/';
        $TMPL_PARSE_STRING  =   C('TMPL_PARSE_STRING');
        $TMPL_PARSE_STRING['__ADDONROOT__'] = __APP__.'/Addons/'.$this->getName();
        C('TMPL_PARSE_STRING',$TMPL_PARSE_STRING);
        if(is_file($this->addon_path.'config.php')){
            $this->config_file = $this->addon_path.'config.php';
        }
    }
    /**
     * 模板主题设置
     * @access protected
     * @param string $theme 模板主题
     * @return \Common\Controller\Addon
     */
    final protected function theme($theme){
        $this->view->theme($theme);
        return $this;
    }
    /**
     * 显示方法
     * @access protected
     * @param string $template 模板主题
     */
    final protected function display($template = ''){
        if($template == ''){
            $template = CONTROLLER_NAME;
        }
        echo ($this->fetch($template));
    }
    /**
     * 模板变量赋值
     * @param mixed $name 要显示的模板变量
     * @param mixed $value 变量的值
     * @return \Common\Controller\Addon
     */
    final protected function assign($name,$value=''){
        $this->view->assign($name,$value);
        return $this;
    }
    /**
     * 用于显示模板的方法
     * @param string $templateFile 模板文件
     * @return string
     * @throws \Exception
     */
    final protected function fetch($templateFile = CONTROLLER_NAME){
        if(!is_file($templateFile)){
            $templateFile = $this->addon_path.$templateFile.C('TMPL_TEMPLATE_SUFFIX');
            if(!is_file($templateFile)){
                throw new \Exception("模板不存在：$templateFile");
            }
        }
        return $this->view->fetch($templateFile);
    }
    /**
     * 获得类文件名中的类名部分
     * @return string
     */
    final public function getName(){
        $class = get_class($this);
        return substr($class, strrpos($class, '\\')+1, -5);
    }
    /**
     * 检查插件基本信息
     * @return boolean
     */
    final public function checkInfo(){
        $info_check_keys = array('name','title','description','status','author','version');
        foreach ($info_check_keys as $value){
            if(!array_key_exists($value, $this->info))
                return FALSE;
        }
        return TRUE;
    }
    final public function getConfig($name=''){
        static $_config = array();
        if(empty($name)){
            $name = $this->getName();
        }
        if(isset($_config[$name])){
            return $_config[$name];
        }
        $config = array();
        $map['name'] = $name;
        $map['status'] = 1;
        $config = M('Addons')->where($map)->getField('config');
        if($config){
            $config = json_decode($config,TRUE);
        }else{
            $temp_arr = include $this->config_file;
            foreach ($temp_arr as $key => $value){
                if($value['type'] == 'group'){
                    foreach ($value['options'] as $gkey => $gvalue){
                        foreach ($gvalue['options'] as $ikey => $ivalue){
                            $config[$ikey] = $ivalue['value'];
                        }
                    }
                }else{
                    $config[$key] = $temp_arr[$key]['value'];
                }
            }
        }
        $_config[$name] = $config;
        return $config;
    }
    //必须实现安装
    abstract public function install();
    //必须卸载插件方法
    abstract public function uninstall();
}
