<?php

class AdmingController extends AdminSet
{
    /**
     * 幻灯片管理
     */
    public function actionIndex()
    {
        //print_r(Yii::app()->user->getState('username'));
        //先获取当前是否有页码信息
        $pages['pageNum'] = Yii::app()->getRequest()->getParam("pageNum", 1); //当前页
        $pages['countPage'] = Yii::app()->getRequest()->getParam("countPage", 0); //总共多少记录
        $pages['numPerPage'] = Yii::app()->getRequest()->getParam("numPerPage", 50); //每页多少条数据

        $pages['scate'] = Yii::app()->getRequest()->getParam("scate", 0); //每页多少条数据

        $pages['sno'] = Yii::app()->getRequest()->getParam("sno", ""); //每页多少条数据


        $criteria = new CDbCriteria;
        $pages['scate']&&$criteria->addCondition("scate={$pages['scate']}");
        $pages['sno']&&$criteria->addCondition("sno='{$pages['sno']}'");


        $pages['countPage'] = Arena::model()->count($criteria);
        $criteria->limit = $pages['numPerPage'];
        $criteria->offset = $pages['numPerPage'] * ($pages['pageNum'] - 1);
        $criteria->order = 'id DESC';
        $allList = Arena::model()->findAll($criteria);
        $this->renderPartial('index', array(
            'models' => $allList,
            'pages' => $pages),false,true);
    }

    public function actionExp()
    {
        $allList = Arena::model()->findAll();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="擂台赛名单汇总.csv"');
        header('Cache-Control: max-age=0');
        $fp = fopen('php://output', 'a');
        // 输出Excel列名信息
        $arr = explode(",","编号,餐厅编号,参赛人姓名,工作站,图片地址,描述,餐厅名,时间,是否分享");

        $head = $arr;
        foreach ($head as $i => $v) {
            // CSV的Excel支持GBK编码，一定要转换，否则乱码
            $head[$i] = iconv('utf-8', 'gbk//IGNORE', $v);
        }
        // 将数据通过fputcsv写到文件句柄
        fputcsv($fp, $head);
        // 计数器
        $cnt = 0;
        // 每隔$limit行，刷新一下输出buffer，不要太大，也不要太小
        $limit = 100000;
        foreach($allList as $value)
        {
            $cnt ++;
            if ($limit == $cnt) { //刷新一下输出buffer，防止由于数据过多造成问题
                ob_flush();
                flush();
                $cnt = 0;
            }

            $row = [
                $value['id'],
                $value['sno'],
                $value['sname'],
                TempList::$arena[$value['scate']],
                empty($value['simg'])?'':'http://yumzhaopin.cn/bscy/project/public/'.$value['simg'],
                $value['sdesc'],
                date('Y-m-d H:i:s',$value['addtime']),
                $value['publish']==1?'已分享':'未分享'
            ];

            foreach ($row as $i => $v) {
                // CSV的Excel支持GBK编码，一定要转换，否则乱码
                $row[$i] = iconv('utf-8', 'gbk//IGNORE', $v);
            }
            fputcsv($fp, $row);
        }
    }

}