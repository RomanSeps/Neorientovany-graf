<?php
$adjMatrix = [
//Varnsdorf, Děčín, Bor, Liberec, Ústí, Lípa, Mělník, Boleslava, Praha
    [0, 44, 22, 42, 0, 0, 0, 0, 0], // Varnsdorf
    [44, 0, 30, 0, 24, 0, 0, 0, 0], // Děčín
    [22, 30, 0, 0, 0, 10, 0, 0, 0], // Bor
    [42, 0, 0, 0, 0, 0, 0, 52, 0], // Liberec
    [0, 24, 0, 0, 0, 0, 0, 0, 92], // Ústí
    [0, 0, 10, 0, 0, 0, 46, 45, 0], // Lípa
    [0, 0, 0, 0, 0, 46, 0, 41, 37], // Mělník
    [0, 0, 0, 52, 0, 45, 41, 0, 67], // Boleslava
    [0, 0, 0, 0, 92, 0, 37, 67, 0] // Praha
];

function initialize($field){
	foreach($field as $node){
    	return $node;
    }
}

function findDistance($array, $start){
	$count = count($adjMatrix);
    $distance = array_fill(0, $count, PHP_INT_MAX);
    $distance[$start] = 0;
    $explored = array_fill(0, $count, false);
    
    for ($i = 0; $i < $numNodes; $i++) {
        $minDistance = PHP_INT_MAX;
        $minNode = -1;
        for ($j = 0; $j < $numNodes; $j++) {
            if (!$visited[$j] && $distances[$j] < $minDistance) {
                $minDistance = $distances[$j];
                $minNode = $j;
            }
        }
        
    $visited[$minNode] = true;
	}    
        
    if ($minNode == -1) {
            break;
        }
        
        
    for ($j = 0; $j < $numNodes; $j++) {
            if ($adjMatrix[$minNode][$j] > 0 && !$visited[$j]) {
                $newDistance = $distances[$minNode] + $adjMatrix[$minNode][$j];
                if ($newDistance < $distances[$j]) {
                    $distances[$j] = $newDistance;
                }
            }
        }
    }
   return $distances;
   
}

$startNode = 0;  // Varnsdorf
$endNode = 7; // Mělník
