<?php

function dijkstra($adjMatrix, $start, $end) {
    $numNodes = count($adjMatrix);
    $distances = array_fill(0, $numNodes, PHP_INT_MAX);  // Inicializace vzdáleností na nekonečno
    $distances[$start] = 0;  // Vzdálenost od startu k sobě je 0
    $previous = array_fill(0, $numNodes, -1);  // Pole pro sledování předchozích uzlů
    $visited = array_fill(0, $numNodes, false);  // Pole pro kontrolu navštívených uzlů

    for ($i = 0; $i < $numNodes; $i++) {
        // Najdi uzel s nejmenší vzdáleností (nenavštívený)
        $minDistance = PHP_INT_MAX;
        $minNode = -1;
        for ($j = 0; $j < $numNodes; $j++) {
            if (!$visited[$j] && $distances[$j] < $minDistance) {
                $minDistance = $distances[$j];
                $minNode = $j;
            }
        }

        // Pokud už neexistuje uzel s platnou vzdáleností (nepřístupný)
        if ($minNode == -1) {
            break;
        }

        // Označ uzel jako navštívený
        $visited[$minNode] = true;

        // Aktualizuj vzdálenosti sousedních uzlů
        for ($j = 0; $j < $numNodes; $j++) {
            if ($adjMatrix[$minNode][$j] > 0 && !$visited[$j]) {
                $newDistance = $distances[$minNode] + $adjMatrix[$minNode][$j];
                if ($newDistance < $distances[$j]) {
                    $distances[$j] = $newDistance;
                    $previous[$j] = $minNode;  // Zapamatuj si předchozí uzel pro zpětné sledování cesty
                }
            }
        }

        // Pokud jsme dosáhli cílového uzlu, můžeme algoritmus ukončit
        if ($minNode == $end) {
            break;
        }
    }

    // Rekonstrukce cesty od cílového uzlu k počátečnímu
    $path = [];
    $currentNode = $end;

    while ($currentNode != -1) {
        array_unshift($path, $currentNode);
        $currentNode = $previous[$currentNode];
    }

    // Pokud začínáme od startovního uzlu, cesta je validní
    if ($path[0] == $start) {
        return [$distances[$end], $path];  // Vracíme vzdálenost a cestu
    }

    return [PHP_INT_MAX, []];  // Pokud neexistuje platná cesta
}

$adjMatrix = [
    [0, 44, 22, 42, 0, 0, 0, 0, 0], // A
    [44, 0, 30, 0, 24, 0, 0, 0, 0], // B
    [22, 30, 0, 0, 0, 10, 0, 0, 0], // C
    [42, 0, 0, 0, 0, 0, 0, 52, 0], // D
    [0, 24, 0, 0, 0, 0, 0, 0, 92], // E
    [0, 0, 10, 0, 0, 0, 46, 45, 0], // F
    [0, 0, 0, 0, 0, 46, 0, 41, 37], // G
    [0, 0, 0, 52, 0, 45, 41, 0, 67], // H
    [0, 0, 0, 0, 92, 0, 37, 67, 0]  // I
];

// Příklad použití: najít nejkratší cestu z uzlu A (index 0) do uzlu H (index 7)
$startNode = 0;  // A
$endNode = 7;    // H

list($distance, $path) = dijkstra($adjMatrix, $startNode, $endNode);

// Výstup nejkratší vzdálenosti a cesty
if ($distance != PHP_INT_MAX) {
    echo "Nejkratší vzdálenost mezi uzlem " . chr($startNode + 65) . " a uzlem " . chr($endNode + 65) . " je: $distance\n";
    echo "Cesta je: ";
    foreach ($path as $node) {
        echo chr($node + 65) . " ";  // Převod indexu na písmeno uzlu
    }
    echo "\n";
} else {
    echo "Neexistuje žádná cesta mezi těmito uzly.\n";
}
?>
