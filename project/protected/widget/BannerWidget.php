<?php
/**
 * Created by PhpStorm.
 * User: xfl
 * Date: 2015/5/15
 * Time: 0:05
 */

class BannerWidget extends CWidget {

    public $type="";
    public $score = 0;
    public function run() {
        $this->render('banner',array(
            "type"=>$this->type,
            "score"=>$this->score
        ));
    }
}