<?php
header('content-type:text/html;charset=GB2312');
@$fileInfo=$_FILES['files'];
$filename=$fileInfo['name'];
$type=$fileInfo['type'];
$tmp_name=$fileInfo['tmp_name'];
$size=$fileInfo['size'];
$error=$fileInfo['error'];
$maxSize=8388608;//�ļ���С����(1024*1024*xMB)
$allowExt=array('jpeg','jpg','png','gif');//�ļ���չ������

//����Ƿ���ѡ���ļ�
if ($error==UPLOAD_ERR_OK){    
  //�ϴ�����
        if ($fileInfo['size']>$maxSize) {
            exit('�ϴ��ļ���С�����趨ֵ');
        }
        $ext=pathinfo($fileInfo['name'],PATHINFO_EXTENSION);
        if (!in_array($ext,$allowExt)) {
            exit('�ļ���������޷��޷���ȡ��');
        }
        //����Ƿ�ͨ��HTTP POS��ʽ�ϴ�
        if (!is_uploaded_file($fileInfo['tmp_name'])) {
            exit('�ϴ�������ʹ��HTTP POS��ʽ�ϴ��ļ���');
        }
        
    //�����ʾ
    if (move_uploaded_file($tmp_name, "upload_folder/".$filename)) {
        echo '�ļ�����'.$filename.'���ϴ��ɹ���';
    }else{
        echo '�ļ�����'.$filename.'�ϴ�ʧ�ܣ�';          
    } 
  
}else{    
    //���������Ϣ
    switch ($error){
        case 1:
            echo '�ļ��ϴ�ʧ�ܣ��ļ������������趨��С���������:����PHP.ini�����е�dpload_max_filesize';
            break;
            
            case 2:
                echo '�ļ��ϴ�ʧ�ܣ��ļ��������������趨���������������PHP.ini�����е�MAX_FILE_SIZE';
                break;
                
                case 3:
                    echo '�ļ������ϴ�ʧ�ܣ�������һ�Σ�';
                    break;
                    
                    case 4:
                        echo 'û��ѡ���ļ���';
                        break;
                        
                        case 6:
                            echo 'û���ҵ��ϴ�Ŀ¼��';
                            break;
                        
                            case 7:
                            case 8:
                                echo 'ϵͳ����';
                                break;
                    
    }
}
?>