<?php

/**
 * 冒泡排序大概的意思是依次比较相邻的两个数，然后根据大小做出排序，
 * 直至最后两位数。由于在排序过程中总是小数往前放，大数往后放，相当于气泡往上升，所以称作冒泡排序
 * 冒泡是从前往后冒，所以，每轮比较的次数也是逐渐减少的，最后一个数不用比较，其时间复杂度为O(n²)，算法如下：
 * @param array $arr
 * @return array
 */
function sortM(array $arr): array
{
    // 判断参数是否为数组，且不为空
    if (!is_array($arr) || empty($arr)) {
        return $arr;
    }
    $len = count($arr) -1;
    // 循环需要冒泡的轮数
    for ($i = 0; $i < $len; $i++) {
        // 循环每轮需要比较的次数
        for ($j = 0; $j < $len - $i; $j++) {
            // 大的数，交换位置，往后挪
            if ($arr[$j] > $arr[$j + 1]) {
                list($arr[$j],$arr[$j + 1]) = [$arr[$j + 1],$arr[$j]];
            }
        }
    }
    return $arr;
}
var_dump(implode("<",sortM([1,-3,4,5,2,6,0])));
