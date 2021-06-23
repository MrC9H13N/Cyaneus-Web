@include('master')
<title>Notes</title>
</head>
<body>
@include('navbar')
<br>
@php
    function getMatColor($mat){
        if($mat == 'MATH'){
            $r = '#f49842';
        }else if($mat == 'PHYS'){
            $r = '#41f459';
        }else if($mat == 'INFO'){
            $r = '#41bbf4';
        }else{
            $r = '#e841f4';
        }
        return $r;
    }

    function getBgColor($note){
        $n = round(ceil($note));
        $gradient = array("FF0000","F70B00","F01700","E92200","E22E00","DB3A00","CE4505","C1500A","B55C0F","A86714","9C731A","957B18","8E8316","878B14","809312","799C11","61930F","4A8B0E","33820C","1C7A0B","1C7A0B");
        $r = $gradient[$n];
        if($r == ''){
            $r = '108A00';
        }
        return '#'.$r;
    }

    function redirectMode($mode){
        $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
        $r = 'https://' . $_SERVER['HTTP_HOST'] . $uri_parts[0].'?mode='.$mode;
        return $r;
    }

    $period = 'S1';
    $addp = '';
    $detail = '';
    $debug = '';

    $data_endpoint = json_decode(DB::table('users')->where('uuid', session('userID'))->value('notes'), true);
    $conf = json_decode(file_get_contents('https://cir64.fr/conf/CIR3.json'), true);

    if(empty($data_endpoint)){

        echo '<center>Désolé, mais vous n\'avez aucune note pour le moment. Installez l\'extension Chrome et envoyez vos notes pour les consulter!</center>';

    }else{
        foreach($conf as $a){
            $matiere = $a['QueryName'];
            $debug .= 'Loop -> Sélection Unité d\'Enseignement '.$matiere.', recherche dans toutes les notes disponibles<br>';

            foreach($data_endpoint as $b){
                if($b['Matière'] == $matiere && ($period == $b['Semestre'] || 1==1)){
                    $debug .= 'Loop -> Loop -> '.$matiere.' correspondante avec '.$b['Matière'].'<br>';
                    foreach($a['Module'] as $c){
                        if($b['Module'] == $c['ModuleName']){
                            foreach($c['DénoType'] as $d) {
                                if($b['Note'] !== 'Non noté' && $b['Note'] !== '-') {
                                    //premier cas: pas un wildcard, le nom existe direct dans le conf
                                    if ($b['Dénomination'] == $d['Type'] && !$d['Wildcard']) {
                                        $debug .= 'Loop -> Loop -> Loop -> ' . $d['Type'] . ' | Pas un wildcard !<br>';
                                        $result[$matiere][$b['Module']][$d['Type']] = $b['Note'];
                                        $sanity[] = $b['fullID'];
                                    } else if (1 === preg_match('~[0-9]~', $b['Dénomination']) && strpos($b['Dénomination'], $d['Type']) !== false && $d['Wildcard']) {
                                        $res = preg_replace("/[^0-9]/", "", $b['Dénomination']);

                                        if ((int)$res > 0) {
                                            $result[$matiere][$b['Module']][$d['Type']][] = $b['Note'];
                                            $debug .= 'Loop -> Loop -> Loop -> ' . $d['Type'] . ' | Wildcard !<br>';
                                        }
                                        $sanity[] = $b['fullID'];
                                    }
                                }
                            }

                            //Vérification des rattrapages
                            $rattrapage = array();

                            if(substr($b['fullID'], -3) == 'DS2' || substr($b['fullID'], -3) == 'BIS' || substr($b['fullID'], -3) == 'bis' || substr($b['fullID'], -3) == '_P2' || substr($b['fullID'], -3) == 'EL2' || substr($b['fullID'], -3) == 'ON2'){

                                if(substr($b['fullID'], -3) == 'DS2'){
                                    $rattrapage[] = $b['fullID'];

                                    if($b['Note'] > $result[$matiere][$b['Module']]['DS1']){
                                        $result[$matiere][$b['Module']]['DS1'] = $b['Note'];
                                    }else{
                                        $result[$matiere][$b['Module']]['DS1'] = ($result[$matiere][$b['Module']]['DS1'] + $b['Note']) / 2;
                                    }
                                }else if(substr($b['fullID'], -3) == '_P2'){
                                    $rattrapage[] = $b['fullID'];

                                    if($b['Note'] > $result[$matiere][$b['Module']]['P1']){
                                        $result[$matiere][$b['Module']]['P1'] = $b['Note'];
                                    }else{
                                        $result[$matiere][$b['Module']]['P1'] = ($result[$matiere][$b['Module']]['P1'] + $b['Note']) / 2;
                                    }
                                }else if(substr($b['fullID'], -3) == 'EL2'){
                                    $rattrapage[] = $b['fullID'];

                                    $result[$matiere][$b['Module']]['PARTIEL'] = ($result[$matiere][$b['Module']]['PARTIEL'] + $b['Note']) / 2;
                                }else if(substr($b['fullID'], -3) == 'ON2'){
                                    $rattrapage[] = $b['fullID'];

                                    if($b['Note'] > $result[$matiere][$b['Module']]['P1'] && 1 == 2){
                                        $result[$matiere][$b['Module']]['P1'] = $b['Note'];
                                    }else{
                                        $result[$matiere][$b['Module']]['PARTIEL'] = ($result[$matiere][$b['Module']]['PARTIEL'] + $b['Note']) / 2;
                                    }
                                }else if(substr($b['fullID'], -3) == 'bis'){
                                    $rattrapage[] = $b['fullID'];

                                    if(isset($result[$matiere][$b['Module']]['EXAM'])) {
                                        if ($b['Note'] > $result[$matiere][$b['Module']]['EXAM']) {
                                            $result[$matiere][$b['Module']]['EXAM'] = $b['Note'];
                                        } else {
                                            $result[$matiere][$b['Module']]['EXAM'] = ($result[$matiere][$b['Module']]['EXAM'] + $b['Note']) / 2;
                                        }
                                    }else{
                                        if ($b['Note'] > $result[$matiere][$b['Module']]['EX']) {
                                            $result[$matiere][$b['Module']]['EX'] = $b['Note'];
                                        } else {
                                            $result[$matiere][$b['Module']]['EX'] = ($result[$matiere][$b['Module']]['EX'] + $b['Note']) / 2;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }else{
                    $debug .= 'Loop -> Loop -> '.$matiere.' MISMATCH '.$b['Matière'].'<br>';
                }
            }
        }

        $debug .= '<br><br>';

        $detail = $detail.'<b>>>> Calcul des sous-modules</b><br/>';

        //On calcule maintenant les moyennes pour chaque sous-module
        foreach($result as $z => $a){
            foreach($a as $y => $b){
                foreach($b as $x => $c) {
                    if(is_array($c)){
                        $tmp_count = count($c);
                        $tmp_somme = 0;
                        foreach($c as $d){
                            $tmp_somme += $d;
                        }
                        if(is_numeric($tmp_somme)) {
                            $result[$z][$y][$x] = $tmp_somme / $tmp_count;
                            $detail = $detail . '<br/>[Sous-module variable] ' . $z . ' - ' . $y . ' - ' . $x . ' => ' . $tmp_somme / $tmp_count . ' (Coeff identique)';
                        }
                    }else{
                        if(is_numeric($c)) {
                            $result[$z][$y][$x] = $c;
                            $detail = $detail . '<br/>[Sous-module fixe] ' . $z . ' - ' . $y . ' - ' . $x . ' => ' . $c;
                        }
                    }
                }
            }
        }

        $detail = $detail.'<br><br><br><br><b>>>> Calcul des modules</b><br/>';

        //On calcule maintenant les moyennes pour chaque module
        foreach($result as $z => $a){
            foreach($a as $y => $b){
                $tmp_count = 0;
                $tmp_somme = 0;
                $tmp_detail = '';
                foreach($b as $x => $c) {
                    foreach($conf[$z]['Module'] as $s){
                        foreach($s['DénoType'] as $r) {
                            if ($r['Type'] == $x && $s['ModuleName'] == $y) {
                                $tmp_somme += $c * $r['Coeff'];
                                $tmp_count += $r['Coeff'];
                                $tmp_detail = $tmp_detail.'<br>&nbsp;&nbsp;&nbsp;&nbsp;↪ '.$x.' - '.$c.' (Coeff '.$r['Coeff'].')';
                            }
                        }
                    }
                }
                $result[$z][$y] = $tmp_somme / $tmp_count;
                $detail = $detail.'<br/><br/>[Module fixe] '.$z.' - '.$y.' => '.$tmp_somme/$tmp_count;
                $detail = $detail.$tmp_detail;
            }
        }

        $detail = $detail.'<br><br><br><br>>>>><b> Calcul des UE</b><br/>';

        //Enfin, on calcule la moyenne de chaque UE
        foreach($result as $z => $a){
            $tmp_count = 0;
            $tmp_somme = 0;
            $tmp_detail = '';
            foreach($a as $y => $b){
                foreach($conf[$z]['Module'] as $s){
                    if ($s['ModuleName'] == $y) {
                        $tmp_somme += $b * $s['Coeff'];
                        $tmp_count += $s['Coeff'];
                        $tmp_detail = $tmp_detail.'<br>&nbsp;&nbsp;&nbsp;&nbsp;↪ '.$y.' - '.$b.' (Coeff '.$s['Coeff'].')';
                    }
                }
            }
            $result[$z] = $tmp_somme / $tmp_count;
            $detail = $detail.'<br /><br/>[UE fixe] '.$z.' => '.$tmp_somme/$tmp_count;
            $detail = $detail.$tmp_detail;
        }

        //Moyenne GENERALE
        $tmp_count = 0;
        $tmp_somme = 0;
        $tmp_detail = '';
        foreach($result as $a => $b){
            foreach($conf as $s) {
                if($s['QueryName'] == $a){
                    if(isset($s['Coeff'])){
                        $tmp_count += $s['Coeff'];
                        $tmp_somme += $b*$s['Coeff'];
                        $tmp_detail = $tmp_detail.'<br>&nbsp;&nbsp;&nbsp;&nbsp;↪ '.$s['QueryName'].' (Coeff '.$s['Coeff'].')';
                    }else{
                        $tmp_count++;
                        $tmp_somme += $b;
                        $tmp_detail = $tmp_detail.'<br>&nbsp;&nbsp;&nbsp;&nbsp;↪ '.$s['QueryName'].' (Coeff 1)';
                    }
                }
            }
        }

        $result['GENERAL'] = $tmp_somme / $tmp_count;
        $detail = $detail.'<br/><br>[UE fixe] GENERAL => '.$tmp_somme/$tmp_count;
        $detail = $detail.$tmp_detail;

        echo '<div class="container-fluid" style="color: white; margin-left: 10%; width:80%;">';
        echo '<div class="row">';
        $ccc = 0;
        foreach($result as $a => $b){
            if($ccc == 1){
                $border = 'border-left: white 1px solid;';
            }else{
                $border = '';
            }

            echo '<div class="col-sm" style="'.$border.' padding: 15px; background-color: '.getBgColor($b).';">
                <center><h2>'.$a.'</h2><h4>'.round(($b), 2).'</h4>';

            echo '</center>
            </div>';
            $ccc = 1;
        }
        echo '</div>
        <table class="table" style="margin-top: 50px; color: white;">
        <thead>
        <tr>
            <th scope="col">Date <a href="'.redirectMode(1).'" style="color: white; text-decoration: none;">▲</a><a href="'.redirectMode(2).'" style="color: white; text-decoration: none;">▼</a></th>
            <th scope="col">Matière <a href="'.redirectMode(11).'" style="color: white; text-decoration: none;">▲</a><a href="'.redirectMode(12).'" style="color: white; text-decoration: none;">▼</a></th>
            <th scope="col">Libellé <a href="'.redirectMode(31).'" style="color: white; text-decoration: none;">▲</a><a href="'.redirectMode(32).'" style="color: white; text-decoration: none;">▼</a></th>
            <th scope="col">Note <a href="'.redirectMode(21).'" style="color: white; text-decoration: none;">▲</a><a href="'.redirectMode(22).'" style="color: white; text-decoration: none;">▼</a></th>
        </tr>
        </thead>
        <tbody>
        ';

        if(!isset($_GET['mode'])){
            $m = 1;
        }else{
            $m = $_GET['mode'];
        }

        if($m == 1) {
            usort($data_endpoint, function ($a1, $a2) {
                $v1 = strtotime(str_replace('/', '-', $a1['Date']));
                $v2 = strtotime(str_replace('/', '-', $a2['Date']));
                return $v2 - $v1;
            });
        }else if($m == 2){
            usort($data_endpoint, function ($a1, $a2) {
                $v1 = strtotime(str_replace('/', '-', $a1['Date']));
                $v2 = strtotime(str_replace('/', '-', $a2['Date']));
                return $v1 - $v2;
            });
        }else if($m == 11){
            function compareByName($a, $b) {
                return strcmp($a["Matière"], $b["Matière"]);
            }
            usort($data_endpoint, 'compareByName');
        }else if($m == 12){
            function compareByName($a, $b) {
                return strcmp($b["Matière"], $a["Matière"]);
            }
            usort($data_endpoint, 'compareByName');
        }else if($m == 21){
            function compare_note($a,$b)
            {
                if($a['Note'] == $b['Note']) return 0;
                return ($a['Note'] > $b['Note']) ? 1 : -1;
            }
            usort($data_endpoint, 'compare_note');
        }else if($m == 22){
            function compare_note($a,$b)
            {
                if($a['Note'] == $b['Note']) return 0;
                return ($a['Note'] < $b['Note']) ? 1 : -1;
            }
            usort($data_endpoint, 'compare_note');
        }else if($m == 31){
            function compareByName($a, $b) {
                return strcmp($a["Nom"], $b["Nom"]);
            }
            usort($data_endpoint, 'compareByName');
        }else if($m == 32){
            function compareByName($a, $b) {
                return strcmp($b["Nom"], $a["Nom"]);
            }
            usort($data_endpoint, 'compareByName');
        }

        foreach($data_endpoint as $key){
            if(strlen($key['Date']) > 6 && ($key['Semestre'] == $period || 1==1)) {
                if ($key['Note'] == '') {
                    $note = 'ABS ';
                } else {
                    $note = $key['Note'];
                }

                if(in_array($key['fullID'], $rattrapage)){
                    $inwarn = '<span style="color: lightgreen;"><br>(<b>ATTENTION: </b>2nd session, la note de la 1ère session a été modifiée sur CIR64)</span>';
                }else if(!in_array($key['fullID'], $sanity)){
                    $inwarn = '<span style="color: lightcoral;"><br>(<b>ATTENTION: </b>Pas de config, pas pris en compte dans le calcul)</span>';
                }else{
                    $inwarn = '';
                }

                echo '<tr><th scope="row">' . $key['Date'] . '</th><td style="color: ' . getMatColor($key['Matière']) . ';">' . $key['Matière'] . '</td><td>' . $key['Nom'] . $inwarn .'</td><td style="color: ' . getBgColor($note) . ';">' . $note . '</td>';
            }
        }
        echo '</tbody></table><br><div style="font-size: 12px;">'.$detail.'</div>';
    }

@endphp

</body>

