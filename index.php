<?php

// functions
function allSameValue($minMaxNums) {
    foreach ($minMaxNums as $num) {
        for ($i=0; $i < count($minMaxNums); $i++) { 
            if ($num === $minMaxNums[$i]) {
                continue;
            }
            else {
                return false;
            }
        }
    }
    return true;
}

function minNumGreatest($minNums) {    
    foreach ($minNums as $num) {
        for ($i = 0; $i < count($minNums); $i++) {
            if ($num < $minNums[$i]) {
                // if less than any num in it's array, go to next num
                continue;
            }
            else {
                // if not less than, hold onto
                $minNumGreatest = $num; 
            }
        }   
    }
    return $minNumGreatest;
}

function maxNumLowest($maxNums) {
    if (allSameValue($maxNums)) {
        $maxNumLowest = $maxNums[0];
        return $maxNumLowest;
    }

    foreach ($maxNums as $num) {
        for ($i = 0; $i < count($maxNums); $i++) {
            if ($num < $maxNums[$i]) {
                // if less than any num in it's array, hold onto
                $maxNumLowest = $num; 
            }
            else {
                // if greater than any num in it's array, go to next num
                continue;
            }
        }   
    }
    return $maxNumLowest;
}

function minNums($inArrs) {
    foreach ($inArrs as $inArr) {
        $minNumsArr[] = $inArr[0];
    }
    return $minNumsArr; 
}

function maxNums($inArrs) {
    foreach ($inArrs as $inArr) {
        $lastIndex = count($inArr) - 1; 
        $maxNumsArr[] = $inArr[$lastIndex];
    }
    return $maxNumsArr; 
}

function candidates($inArrs, $minNumGreatest) {
    foreach ($inArrs as $inArr) {
        for ($i = 0; $i < count($inArr); $i++) {
            if ($inArr[$i] < $minNumGreatest) {
                // can't be a candidate if less than minNumGreatest
                continue;
            }
            else {
                $candidates[] = $inArr[$i]; 
            }
        }
    }
    return $candidates;
}


function candidatesInArrsCheck($inArrs, $candidates) {
    $count = count($inArrs);
    for ($i = 0; $i < count($candidates); $i++) {
        $c = 0;
        foreach ($inArrs as $inArr) {
            $found = array_search($candidates[$i], $inArr, true);
            if ($found || $found === 0) {
                $c++;
            }
            if ($c == $count) {
                return $candidates[$i];
            }
        }
    }
    return false;
}


function smallest_common_number(...$inArrs) {    
    // get lowest number in each input array
    $minNums = minNums($inArrs);

    // get greatest number in each input array
    $maxNums = maxNums($inArrs);

    // if all minNums are the same = problem solved
    if (allSameValue($minNums)) {
        $found = $minNums[0];
        return $found;
    }

    // get greatest minNum
    $minNumGreatest = minNumGreatest($minNums);

    // get lowest maxNum 
    $maxNumLowest = maxNumLowest($maxNums);

    // if greatest minNum > lowest maxNum = no smallest common number
    if ($minNumGreatest > $maxNumLowest) {
        $found = false;
        return false;
    }

    // if $minNumGreatest equal to $maxNumLowest, problem solved 
    if ($minNumGreatest == $maxNumLowest) {
        $found = $minNumGreatest;
        return $found;
    }

    // get candidates of inArrs by only keeping numbers equal or higher to minNumGreatest
    $candidates = candidates($inArrs, $minNumGreatest);

    // check if candidates are in all inArrs
    $found = candidatesInArrsCheck($inArrs, $candidates);

    return $found;
}

// Inputs

// Default Test
$arr1 = array(1,2,3,5,6);
$arr2 = array(2,3,4,5,6);
$arr3 = array(4,5,6,7,8);

// scn as first index
// $arr1 = array(3,6,8);
// $arr2 = array(3,5,8);
// $arr3 = array(3,100);

// scn as last index
// $arr1 = array(6,8,55,100);
// $arr2 = array(5,8,55,100);
// $arr3 = array(59,100);

// scn as middle index
// $arr1 = array(6,8,9,10,55);
// $arr2 = array(5,8,10,55);
// $arr3 = array(6,10,100);

// scn as first and middle
// $arr1 = array(8,11,55);
// $arr2 = array(8,11,55);
// $arr3 = array(8,11,100);

// scn despite greater matches
// $arr1 = array(5,9,11,55,100);
// $arr2 = array(9,55,60,100);
// $arr3 = array(9,55,100);

// zero scn
// $arr1 = array(0,5,9,11,55,100);
// $arr2 = array(0,9,55,60,100);
// $arr3 = array(0,9,55,100);

// min greater than max thus false
// $arr1 = array(5,9,11,55);
// $arr2 = array(60,100);
// $arr3 = array(9,55);


// many false
// $arr1 = array(6,8,55,100);
// $arr2 = array(5,8,55,100);
// $arr3 = array(59,133,100);
// $arr4 = array(6,8,9,10,55);
// $arr5 = array(5,8,10,55);
// $arr6 = array(6,10,133,100);
// $arr7 = array(6,8,9,11,55);
// $arr8 = array(5,8,11,55);
// $arr9 = array(11,133,100);
// $arr10 = array(5,9,11,55,100);
// $arr11 = array(9,55,60,100);
// $arr12 = array(9,55,133,100);


// many true
// $arr1 = array(6,8,55,100);
// $arr2 = array(5,8,55,100);
// $arr3 = array(55,59,133,100);
// $arr4 = array(6,8,9,10,55);
// $arr5 = array(5,8,10,55);
// $arr6 = array(6,10,55,100);
// $arr7 = array(6,8,9,11,55);
// $arr8 = array(5,8,11,55);
// $arr9 = array(11,55,100);
// $arr10 = array(5,9,11,55,100);
// $arr11 = array(9,55,60,100);
// $arr12 = array(9,55,133,100);

// Long array
// $arr1 = array(1,4,7,10,13,16,19,22,25,28,31,34,37,40,43,46,49,52,55,58,61,64,67,70,73,76,79,82,85,88,91,94,97); 
// $arr2 = array(10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99);
// $arr3 = array(0,3,6,9,12,15,18,21,24,27,30,33,36,39,42,43,45,48,51,54,57,60,63,66,69,72,75,78,81,84,87,90,93,96,99);
// $arr4 = array(10,14,18,22,26,30,34,38,42,43,46,50,54,58,62,66,70,74,78,82,86,90,94,98,102,106,110,114,118,122,126,130,134,138,142,146,150,154,158,162,166,170,174,178,182,186,190,194,198,202,206,210,214,218,222,226,230,234,238,242,246,250,254,258,262,266,270,274,278,282,286,290,294,298,302,306,310,314,318,322,326,330,334,338,342,346,350,354,358,362,366,370,374,378,382,386,390,394,398,402,406,410,414,418,422,426,430,434,438,442,446,450,454,458,462,466,470,474,478,482,486,490,494,498);

// script
$scn = smallest_common_number($arr1, $arr2, $arr3);
var_dump($scn);

?>