<?php
namespace Admin\Model;
use Think\Model;

class FileModel extends Model{
	
    /**
     * 文件模型自动完成
     * @var array
     */
    protected $_auto = array(
    	array('create_time', NOW_TIME, self::MODEL_INSERT);
    );

    /**
     * 文件模型字段映射
     * @var array
     */
    protected $_map = array(
    	'type' => 'mime',
    );

    /**
     * 文件上传
     * @param  array  $files   要上传的文件列表（通常是$_FILES数组）
     * @param  array  $setting 文件上传配置
     * @param  string $driver  上传驱动名称
     * @param  array  $config  上传驱动配置
     * @return array           文件上传成功后的信息
     */
    public function upload($files, $setting, $driver = 'Local', $config = null){
        /* 上传文件 */
        $setting['callback'] = array($this, 'isFile');
		$setting['removeTrash'] = array($this, 'removeTrash');
        $Upload = new Upload($setting, $driver, $config);
        $info   = $Upload->upload($files);


        /* 设置文件保存位置 */
		$this->_auto[] = array('location', 'ftp' === strtolower($driver) ? 1 : 0, self::MODEL_INSERT);

        if($info){ //文件上传成功，记录文件信息
            foreach ($info as $key => &$value) {
                /* 已经存在文件记录 */
                if(isset($value['id']) && is_numeric($value['id'])){
                    $value['path'] = substr($setting['rootPath'], 1).$value['savepath'].$value['savename']; //在模板里的url路径
                    continue;
                }

                $value['path'] = substr($setting['rootPath'], 1).$value['savepath'].$value['savename']; //在模板里的url路径
                /* 记录文件信息 */
                if($this->create($value) && ($id = $this->add())){
                    $value['id'] = $id;
                } else {
                    //TODO: 文件上传成功，但是记录文件信息失败，需记录日志
                    unset($info[$key]);
                }
            }
            return $info; //文件上传成功
        } else {
            $this->error = $Upload->getError();
            return false;
        }
    }

}