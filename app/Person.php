<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Person extends Model {
    protected $guarded = ["id"];
    public static $rules = [
        "name" => "required",
        "mail" => "email",
        "age" => "integer",
    ];

    public function newCollection(array $models = []) {
        return new MyCollection($models);
    }
    // アクセサの追加(作成したアクセサはviewで呼び出しが可能)
    // アクセサの設定（get◯◯Attribute(){}で設定可能）
    // 実際に追加する場合は $item->name_and_id の様に、「_」でつないで結果を返却する
    public function getNameAndIdAttribute() {
        return $this->name . "[id=" . $this->id . "]";
    }

    public function getNameAndMailAttribute() {
        return $this->name . "(" . $this->mail . ")";
    }

    public function getNameAndAgeAttribute() {
        return $this->name . "(" . $this->age . ")";
    }

    public function getAllDataAttribute() {
        return $this->name . "(" . $this->age . ")" . "[" . $this->mail . "]";
    }

    // アクセサによる既存のプロパティの変更(引数を渡し、returnで変更を加える)
    public function getNameAttribute($value) {
        return strtoupper($value);
    }

    // ミューテータの作成（set◯◯Attribute(){}で設定可能）
    public function setNameAttribute($value) {
        // dd($this->attributes);
        $this->attributes["name"] = strtoupper($value);
    }

    public function setAllDataAttribute(Array $value){
        $this->attributes["name"] = $value[0];
        $this->attributes["mail"] = $value[1];
        $this->attributes["age"]  = $value[2];
    }
}

class MyCollection extends Collection {
    public function fields() {
        $item = $this->first(); //最初のコレクション（モデルクラスのインスタンス）を取得
        // dd($item);
        // array_keys()関数を使用することで、配列のkeyのみを配列として取得可能
        return array_keys($item->toArray());
    }
}
