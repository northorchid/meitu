<?php

class CateData
{
    private $_data = array();

    public function __construct($data)
    {
        $this->_data = $data;
    }
}

$data = array(
    'a' => '分类1',
    'b' => '分类2',
    'c' => '分类3',
    'd' => '分类4',
);

$cate = new CateData($data);
foreach ($cate as $key => $val) {
    echo "$key : " . $val;
}

//不能输出，因为成员属性$_data是私有变量，无法进行遍历
class CateData2 implements IteratorAggregate
{
    private $_data = array();

    public function __construct($data)
    {
        $this->_data = $data;
    }

    public function getIterator()
    {
        return new ArrayIterator($this->_data);
    }
}

$cate = new CateData2($data);
foreach ($cate as $key => $val) {
    echo "$key : " . $val;
}

