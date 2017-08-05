<?php
/**
 * Express.class.php 快递查询类 v1.0
 *
 * @copyright        福星高照
 * @license          http://www.25531.com
 * @lastmodify       2014-08-22
 */
class Express
{
    /*
     * 网页内容获取方法
    */
    private function getContent($url)
    {
        if (function_exists("file_get_contents")) {
            $file_contents = file_get_contents($url);
        } else {
            $ch      = curl_init();
            $timeout = 5;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $file_contents = curl_exec($ch);
            curl_close($ch);
        }
        return $file_contents;
    }

    /*
     * 获取对应名称和对应传值的方法
    */
    private function getExpressName($order)
    {
        $name   = json_decode($this->getContent("http://www.kuaidi100.com/autonumber/auto?num={$order}"), true);
        $result = $name[0]['comCode'];
        if (empty($result)) {
            return false;
        } else {
            return $result;
        }
    }

    /*
     * 返回$data array      快递数组查询失败返回false
     * @param $order        快递的单号
     * $data['ischeck'] ==1 已经签收
     * $data['data']        快递实时查询的状态 array
    */
    public function getExpressResult($order)
    {
        $keywords = $this->getExpressName($order);
        if (!$keywords) {
            return false;
        } else {
            $result = $this->getContent("http://www.kuaidi100.com/query?type={$keywords}&postid={$order}");
            $data   = json_decode($result, true);
            return $data;
        }
    }

    /**
     * 对快递单号数组进行查询
     * @param  $orderArray      快递单号array数组
     * @return $resultArray     快递查询结果数组
     */
    public function getArrayExpressResult($orderArray){
        $resultArray = array();
        foreach ($orderArray as $order) {
            $result = $this->getExpressResult($order);
            array_push($resultArray, $result); 
        }
        return $resultArray;
    }
}
?>
