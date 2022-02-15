<?php

namespace App\MyClasses;

class PowerMyService implements MyServiceInterface {
    private $id   = -1;
    private $msg  = "no id...";
    private $data = ["いちご", "りんご", "バナナ", "みかん", "ブドウ",];

    function __construct() {
        $this->setId(rand(0, count($this->data)));
    }

    public function setId(int $id) {
        if ($id >= 0 && $id < count($this->data)) {
            $this->id = $id;
            $this->msg = "あなたが好きな食べ物は、" . $id . "番目の" . $this->data[$id] . "ですね！";
        }
    }

    public function say() {
        return $this->msg;
    }
    public function data($id) {
        return $this->data[$id];
    }
    public function setData($data) {
        $this->data = $data;
    }
    public function allData() {
        return $this->data;
    }
}
