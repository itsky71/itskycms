<?php
/**
 * Description of MemberModel
 * 用户信息模型类
 * @author itsky
 */
namespace Admin\Model;
use Think\Model;
class MemberModel extends Model{
    //表单验证
    protected $_validate = array(
        array('username','3,20','{%YZUNL}',self::EXISTS_VALIDATE,'length'),
        array('username','','{%YZUNU}',self::EXISTS_VALIDATE,'unique'),
        array('email','email','{%YZEF}'),
        array('email','','{%YZEU}',self::EXISTS_VALIDATE,'unique'),
        array('realname','3,20','{%YZRNL}',self::VALUE_VALIDATE,'length'),
        array('realname','checkRname','{%YZRNI}',self::VALUE_VALIDATE,'callback'),
        array('question','3,30','{%YZQL}',self::VALUE_VALIDATE,'length'),
        array('answer','0,30','{%YZAL}',self::VALUE_VALIDATE,'length')
    );

    protected function checkRname(){
        $rname = I('post.realname');
        $patten = '/^[\w\d\x{4e00}-\x{9fa5}]+$/u';
        return preg_match($patten, $rname) === 1;
    }
    
    public function checkFiledOne($data) {
        foreach ($data as $filed => $value){
            if($filed!=$this->getPk()){
                $vfiled = $filed;
            }
        }
        $data['res'] = $this->_validationFieldItem($data, array($vfiled,'','',self::EXISTS_VALIDATE,'unique'));
        $data['vfiled'] = $vfiled;
        return $data;
    }
}
