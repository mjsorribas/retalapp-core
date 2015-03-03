<?php

Class Report{

	public static function getTable($titleArray, $items)
	{

        /*
        $titleArray = array("Articulo" => "Articulo",
            "Cantidad" => "Cantidad",
            "Tamaño" => "Tamaño",
            "Precio" => "Precio",
            "Total" => "Total",
            "Total(Con adicionales)" => "Totales"            
            );*/
                //Títulos para exportar
        $defTitle;
        foreach ($titleArray as $colNum => $colTitle) {
            if (substr($colNum, 0, 5) == 'comb_') {
                $defTitle[] = substr($colNum, 5);
            }elseif(substr($colNum, 0, 5) == 'post_'){
                $defTitle[] = substr($colNum, 5);
            }elseif(substr($colNum, 0, 5) == 'epdf_'){
                $defTitle[] = substr($colNum, 5);
            }else {
                $defTitle[] = $colNum;
            }
        }
            //Contenido a exportar
            //return $defTitle;
        $tableContent = array();
            foreach ($items as $key => $item) {
                foreach ($titleArray as $colNum => $colTitle) {
                    if (is_array($colTitle)) {
                        if (is_array($colTitle[0])) {
                            $tmpObj = '';
                            foreach ($colTitle as $colKey => $part) {
                                //dd($item->$part[0]);
                                if ($item->$part[0] != NULL) {
                                    $tmpObj .= " " . $item->$part[0]->$part[1];
                                }
                            }
                            $tableContent[$key][] = $tmpObj;
                        }elseif(substr($colNum, 0, 5) == 'post_'){ 
                            $dataToSend = array();
                            $dataToSend = explode( ".", $colTitle[2]);
                            //$urlToSend = explode( ".", $colTitle[1]);
                            //dd($dataToSend);
                            $tableContent[$key][] = '<input type="button" class="btn btn-info confirmService" value="'.$colTitle[0].'" onclick="postToServer(\''.$colTitle[1].'\',{'.$dataToSend[0].':'.$item->$dataToSend[1].'})">';
                        }elseif (substr($colNum, 0, 5) == 'epdf_') {
                            //postGetFile
                            $dataToSend = array();
                            $dataToSend = explode( ".", $colTitle[2]);
                            //$urlToSend = explode( ".", $colTitle[1]);
                            //dd($dataToSend);
                            $tableContent[$key][] = '<input type="button" class="btn btn-info confirmService" value="'.$colTitle[0].'" onclick="postGetFile(\''.$colTitle[1].'\',{'.$dataToSend[0].':'.$item->$dataToSend[1].'})">';
                        }else {
                            $tmpObj = ($item->$colTitle[0] != NULL) ? $item->$colTitle[0]->$colTitle[1] : '';
                            $tableContent[$key][] = $tmpObj;
                        }
                    } else {
                        if (substr($colNum, 0, 5) == 'comb_') {
                            $dataToComb = explode(".", $colTitle);
                            //dd($dataToComb);
                            $combResult = '';
                            foreach ($dataToComb as $keyComb => $valueComb) {
                                if ($item->$valueComb == NULL) {
                                    $combResult .= " ";
                                } else {
                                    $combResult .= " " . $item->$valueComb;
                                }
                            }
                            //dd($combResult);
                            $tableContent[$key][] = $combResult;
                        }else {
                            if ($item->$colTitle == NULL) {
                                $tableContent[$key][] = '';
                            } else {
                                if ($colTitle == "created_at" || $colTitle == "updated_at" || $colTitle == "canceled_at") {
                                    $dateData = $item->$colTitle;
                                        //return $dateData;
                                    $tableContent[$key][] = (string)$dateData;

                                }else{
                                    $tableContent[$key][] = $item->$colTitle;
                                }

                            }
                        }
                    }
                }
            }
            $reportToExport = array_merge(array($defTitle), $tableContent);
                //return $tableContent;
                //return $reportToExport;
                // Excel::fromArray( array(
                //  array('Hello', 'World', '!!!'),
                //  array('X', 'Y', 'Z')
                //  ) )->save('./sample.xlsx' );
            $reportPath = "./reports/report".Input::get("since")."-".Input::get("until").".xlsx";
            $reportViewPath = "reports/report".Input::get("since")."-".Input::get("until").".xlsx";
            //Excel::fromArray($reportToExport)->save($reportPath);
            $defTable = "<table id = 'datatable' class='table table-striped table-bordered'>
                                <thead>
                                <tr>";//table table-striped table-bordered dynamicTable'>
                    
                        foreach ($defTitle as $colNum => $colName) {
                            $defTable .= "<th>$colName</th>";
                        }   

                        $defTable .= "</tr></thead><tbody>";

                        foreach ($tableContent as $rowNum => $rowContent) {
                            $defTable .= "<tr>";
                            foreach ($rowContent as $colContent) {
                                $defTable .= "<td>".$colContent."</td>";
                            }
                            $defTable .= "</tr>";
                        }

                        $defTable .= "</tbody></table>";
                        return  $defTable;
	}

}

?>