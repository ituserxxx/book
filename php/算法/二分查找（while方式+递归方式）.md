# 二分查找（while方式+递归方式）

## 特点

- 半搜索、对数搜索，是一种在**有序数组**中查找某一特定元素的搜索算法。



## 逻辑

从数组的中间元素开始，如果中间元素正好是要查找的元素，则搜索过程结束；如果某一特定元素大于或者小于中间元素，
则在数组大于或小于中间元素的那一半中查找，而且跟开始一样从中间元素开始比较。如果在某一步骤数组为空，则代表找不到。
这种搜索算法每一次比较都使搜索范围缩小一半。

- 确定要查找的区间

- 确定要二分时的参照点

- 区间内选取二分点

- 根据二分点的值，综合左右区间情况以及求解的目的，舍去一半无用的区间

- 继续在有效区间重复上面的步骤

## 时间复杂度

O(logn)



```php

/**
 * 二分查找法-while方式
 * @param $arr
 * @param $search
 * @return string
 */
function BinSearchByWhile($arr,$search): string
{
    $height=count($arr)-1;
    $low=0;
    while($low<=$height){
        $mid=intval(($low+$height)/2);//获取中间数
        if($arr[$mid]==$search){
            return $mid.":succ";//返回
        }elseif($arr[$mid]<$search){
            // 去右边查
            $low=$mid+1;
        }elseif($arr[$mid]>$search){
            // 去右边查
            $height=$mid-1;
        }
    }
    return 'fail';
}

/**
 * 二分查找法-递归方式
 * @param $arr
 * @param $number
 * @param $lower
 * @param $high
 * @return int
 */
function BinarySearchByRecursion($arr, $number, $lower, $high): int
{
    // 中间点
    $middle = intval(($lower + $high) / 2);
    // 最低点比最高点大就退出
    if ($lower > $high) {
        return -1;
    }
    if ($number > $arr[$middle]) {
        // 去左边查
        return BinarySearchByRecursion($arr, $number, $middle + 1, $high);
    } elseif ($number < $arr[$middle]) {
        // 去右边查
        return BinarySearchByRecursion($arr, $number, $lower, $middle - 1);
    } else {
        return $middle;
    }
}
$a = [  2, 3, 4,4, 5, 8,9];
var_dump( BinarySearchByRecursion($a,5,0, count($a)));

```

