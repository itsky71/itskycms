<?php
$fieldpath = MODULE_PATH.'Lang/'.LANG_SET.'/field_common.php';
if(file_exists($fieldpath)){
    require_once $fieldpath;
}else{
    $field_common = array();
}
$field = array(
    'FIELD_MANAGEMENT'          =>  '字段管理',
    'ADD'                       =>  '添加字段',
    'EDIT'                      =>  '编辑字段',
    'ORDER'                     =>  '排序',
    'FIELD_NAME'                =>  '字段名',
    'FIELD_ALIAS'               =>  '别名',
    'FIELD_TIPS'                =>  '提示信息',
    'FIELD_TYPE'                =>  '类型',
    'FIELD_SYSTEM'              =>  '系统字段',
    'REQUIRED'                  =>  '必填',
    'MANOPE'                    =>  '管理操作',
    'FIELDS_TYPE'               =>  '字段类型',
    'SELECT_FIELD_TYPE'         =>  '请选择字段类型',
    'FIELD_SETUP'               =>  '字段相关设置',
    'CLASS_NAME'                =>  '字段class名称',
    'PATTERN'                   =>  '验证规则',
    'SELECT_PATTERN'            =>  '请选择',
    'STR_LENGTH'                =>  '限制字符串的长度范围',
    'MIN_LENGTH'                =>  '最小',
    'MAX_LENGTH'                =>  '最大',
    'NUM_STR'                   =>  '个字符',
    'ERROR_MSG'                 =>  '验证失败错误信息',
    'CUSTOM_REGEX'              =>  '正则表达式',
    'ADD_ERROR'                 =>  '字段添加失败！',
    'ADD_OK'                    =>  '字段添加成功！',
    'DEL_ERROR'                 =>  '字段删除失败！',
    'DEL_OK'                    =>  '字段删除成功！',
    'EDIT_ERROR'                =>  '字段编辑失败！',
    'EDIT_OK'                   =>  '字段编辑成功！',
    'SQL_ERROR'                 =>  'SQL 语句错误！',

    'FIELD_CATID'               =>  '栏目',
    'FIELD_TITLE'               =>  '标题',
    'FIELD_TYPEID'              =>  '类别',
    'FIELD_TEXT'                =>  '单行文本',
    'FIELD_TEXTAREA'            =>  '多行文本',
    'FIELD_EDITOR'              =>  '编辑器',
    'FIELD_SELECT'              =>  '下拉列表',
    'FIELD_RADIO'               =>  '单选按钮',
    'FIELD_CHECKBOX'            =>  '复选框',
    'FIELD_IMAGE'               =>  '单张图片',
    'FIELD_IMAGES'              =>  '多张图片',
    'FIELD_FILE'                =>  '单文件上传',
    'FIELD_FILES'               =>  '多文件上传',
    'FIELD_NUMBER'              =>  '数字',
    'FIELD_DATETIME'            =>  '日期和时间',
    'FIELD_POSID'               =>  '推荐位',
    'FIELD_GROUPID'             =>  '会员组',
    'FIELD_LINKAGE'             =>  '联动菜单',
    'FIELD_TEMPLATE'            =>  '模板选择',
    'FIELD_VERIFY'              =>  '验证码',
    'FIELD_ATTR'                =>  '商品属性',


    'SETUP_FILTER'              =>  'PHP安全过滤函数',
    'SETUP_FILTER_TIP'          =>  '例：intval safe_replace 如值为 no 则不受理',
    'SETUP_THUMB'               =>  '是否使用标题图片',
    'SETUP_STYLE'               =>  '是否使用标题样式',
    'SETUP_SIZE'                =>  '文本框长度',
    'SETUP_DEFAULT'             =>  '默认值',
    'SETUP_IS_PASSWORD'         =>  '是否为密码框',
    'SETUP_FIELD_TYPE'          =>  '字段类型',
    'SETUP_HEIGHT'              =>  '文本框高度',
    'SETUP_WIDTH'               =>  '文本框宽度',
    'SETUP_SELECT_LIST'         =>  '选项列表',
    'SETUP_SELECT_INFO'         =>  '例：选项名 | 值',
    'SETUP_SELECT_TYPE'         =>  '选项类型',
    'SETUP_SELECT_TYPE_1'       =>  '下拉框',
    'SETUP_SELECT_TYPE_2'       =>  '多选列表框',
    'SETUP_VARCHAR'             =>  '字符字符',
    'SETUP_INT'                 =>  '整数',
    'SETUP_NO_NEGATIVE'         =>  '不包括负数',
    'SETUP_SHOW_ITEM'           =>  '可见项目的条目',
    'SETUP_EDITOR_TYPE'         =>  '编辑器类型',
    'SETUP_EDITOR_STYLE'        =>  '编辑器样式',
    'SETUP_EDITOR_STYLE_BASIC'  =>  '简单型',
    'SETUP_EDITOR_STYLE_FULL'   =>  '标准型',
    'SETUP_EDITOR_HEIGHT'       =>  '编辑器默认高度',
    'SETUP_IS_PAGE'             =>  '显示内容分页选项',
    'SETUP_SHOW_ABSTRACT'       =>  '显示截取摘要选项',
    'SETUP_SHOW_GET_TITLE_THUMB'=>  '显示获取缩略图选项',
    'SETUP_SHOW_SAVE_REMOTE_PIC'=>  '选项保持远程图选项',
    'SETUP_IS_UPLOAD_PIC'       =>  '是否允许图片上传',
    'SETUP_UPLOAD_PIC_FORMAT'   =>  '允许上传图片类型',
    'SETUP_DATE_FORMAT'         =>  '时间格式',
    'SETUP_DATE_TIP'            =>  '例：yyyy-mm-dd',
    'SETUP_SELECT_RADIO'        =>  '单选',
    'SETUP_SELECT_CHECKBOX'     =>  '复选',
    'SETUP_SELECT_SELECT'       =>  '下拉列表',
    'SETUP_SELECT_IMAGES'       =>  '图组',
    'SETUP_ATTR_TIP'            =>  '格式：名称 | 价格',
    'SETUP_SELECT_RADIO_FRAME'  =>  '单选框',
    'SETUP_SELECT_CHECKBOX_FRAME'=> '复选框',
    'SETUP_IS_NEGATIVE'         =>  '是否包括负数',
    'SETUP_DECIMAL_NUMBER'      =>  '小数位数',
    'SETUP_UPLOAD_TYPE'         =>  '允许上传的文件类型',
    'SETUP_UPLOAD_WATERMARK'    =>  '是否添加水印',
    'SETUP_UPLOAD_ALREADY'      =>  '是否从已上传中选择',
    'SETUP_UPLOAD_MAX_NUM'      =>  '允许上传上限数量',
    'SETUP_UPLOAD_MAX_SIZE'     =>  '允许上传单张大小',
    'SETUP_UPLOAD_FILE_MAX_SIZE'=>  '允许上传文件大小',


    'PATTERN_EMAIL'             =>  '电子邮件地址',
    'PATTERN_URL'               =>  '网址',
    'PATTERN_DATE'              =>  '日期',
    'PATTERN_NUMBER'            =>  '有效数值',
    'PATTERN_DIGITS'            =>  '正整数',
    'PATTERN_CREDITCARD'        =>  '信用卡号',
    'PATTERN_EQUALTO'           =>  '再次输入相同的值',
    'PATTERN_IP4'               =>  'IP地址',
    'PATTERN_MOBILE'            =>  '手机号码',
    'PATTERN_TEL'               =>  '电话号码',
    'PATTERN_ZIPCODE'           =>  '邮政编码',
    'PATTERN_QQ'                =>  'QQ号码',
    'PATTERN_IDCARD'            =>  '身份证号码',
    'PATTERN_CHINESE'           =>  '中文字符',
    'PATTERN_CN_USERNAME'       =>  '中文、英文、数字和下划线',
    'PATTERN_ENGLISH'           =>  '英文字母',
    'PATTERN_EN_NUM'            =>  '英文、数字和下划线',
    'PATTERN_REGEX'             =>  '自定义正则表达式',
    
    'TYPER'                     =>  '请选择字段类型！',
    'FIELDL'                    =>  '字段名长度必须为2-20个字符！',
    'FIELDE'                    =>  '字段名必须为英文字母！',
    'FIELDC'                    =>  '该字段名已存在！',
    'NAMEL'                     =>  '别名长度必须为2-20个字符！',
    'CLASSL'                    =>  '字段class名称必须为2-20个字符！',
    'CLASSC'                    =>  '字段class名称必须由英文字母、数字、下划线和减号组成！',
    'MINLENGTHL'                =>  '限制字符串长度范围最小值长度必须小于10个字符！',
    'MINLENGTHN'                =>  '限制字符串长度范围最小值必须为非负整数！',
    'MAXLENGTHL'                =>  '限制字符串长度范围最大值长度必须小于10个字符！',
    'MAXLENGTHN'                =>  '限制字符串长度范围最大值必须为非负整数！',
    'MAXLENGTHC'                =>  '限制字符串长度范围最大值必须大于或等于最小值！',
    'ERRORMSGL'                 =>  '验证失败错误信息必须为2-250个字符！',
    'SETUPALL'                  =>  '字段相关设置中存在输入错误！',
    'FUN_NAME'                  =>  '函数名的第一个字符必须是英文字母！'
);
return array_merge($field, $field_common);