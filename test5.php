<?php

class Node
{
    /**
     * 上一个节点
     *
     * @var Node
     */
    public $prev;

    /**
     * 下一个节点
     *
     * @var Node
     */
    public $next;

    /**
     * 数据
     *
     * @var String
     */
    public $data;

    public function __construct($data, $prev = null, $next = null)
    {
        $this->data = $data;
        $this->prev = $prev;
        $this->next = $next;
    }

}

class DoublyLinkedList
{
    /**
     * 头结点
     *
     * @var Node
     */
    private $headNode = null;

    /**
     * 尾节点
     *
     * @var Node
     */
    private $lastNode = null;

    /**
     * 添加节点
     *
     * @param $data
     */
    public function push($data)
    {
        $node = $this->getNode($data);
        if ($this->headNode == null) {
            $this->headNode = $this->lastNode = $node;
        } else {
            $this->lastNode->next = $node;
            $node->prev = $this->lastNode;
            $this->lastNode = $node;
        }
    }

    /**
     * 通过位置查找节点
     *
     * @param $location
     *
     * @return Node|null
     */
    public function findByLocation($location)
    {
        $node = $this->headNode;
        for ($i = 1; $i < $location; $i++) {
            $node = $node->next;
        }
        return $node;
    }

    /**
     * 通过data查找节点
     *
     * @param $data
     *
     * @return Node|null
     */
    public function findByData($data)
    {
        $node = $this->headNode;
        while ($node) {
            if ($node->data == $data) {
                return $node;
            }
            $node = $node->next;
        }
        return null;
    }

    /**
     * 删除节点
     *
     * @param $location
     *
     * @return bool
     */
    public function delete($location)
    {
        $node = $this->headNode;
        //定位到待删除的节点
        for ($i = 1; $i < $location; $i++) {
            if ($node == null) {
                return false;
            }
            $node = $node->next;
        }
        //更新上一个接的的next
        if ($node->prev != null) {
            $node->prev->next = $node->next;
        } else {
            $this->headNode = $node->next;
        }
        //更新下一个节点的prev
        if ($node->next != null) {
            $node->next->prev = $node->prev;
        } else {
            $this->lastNode = $node->prev;
        }
    }

    /**
     * 更新节点
     *
     * @param $location
     * @param $data
     */
    public function update($location, $data)
    {
        $node = $this->findByLocation($location);
        $node->data = $data;
    }

    /**
     * @param $data
     *
     * @return Node
     */
    protected function getNode($data)
    {
        return new Node($data);
    }

    /**
     * 所有的数据
     */
    public function allData()
    {
        $node = $this->headNode;
        while ($node) {
            echo $node->data . PHP_EOL;
            $node = $node->next;
        }
    }
}

$dll = new DoublyLinkedList();
$dll->push(1);
$dll->push(2);
$dll->push(3);
$dll->delete(3);
$dll->allData();

$node = $dll->findByData(2);
echo $node->data . PHP_EOL;
