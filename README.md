# Neorientovany-graf
Úkolem je vytvořit matici sousednosti pro neorientovaný ohodnocený graf.

## Úloha 1:
Program by měl obsahovat pouze inicializaci matice sousednosti.
```PHP
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
```

## Úloha 2:
Nalezněte libovolnou cestu mezi dvěma vybranými uzly a vypočítejte délku této cesty.
```PHP
for ($i = 0; $i < $numNodes; $i++) {
        $minDistance = PHP_INT_MAX;
        $minNode = -1;
        for ($j = 0; $j < $numNodes; $j++) {
            if (!$visited[$j] && $distances[$j] < $minDistance) {
                $minDistance = $distances[$j];
                $minNode = $j;
            }
        }
        if ($minNode == -1) {
            break; 
        }
        $visited[$minNode] = true;

        for ($j = 0; $j < $numNodes; $j++) {
            if ($graph[$minNode][$j] > 0 && !$visited[$j]) {
                $newDistance = $distances[$minNode] + $graph[$minNode][$j];
                if ($newDistance < $distances[$j]) {
                    $distances[$j] = $newDistance;
                    $previous[$j] = $minNode;
                }
            }
        }
    }
```
