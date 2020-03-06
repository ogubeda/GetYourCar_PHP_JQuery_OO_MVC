<?php
//////
$path = $_SERVER['DOCUMENT_ROOT'] . '/frameworkCars.v.1.2/';
//////
include ($path . 'model/DAOGeneral.php');
class QuerysShop {
    //////
    function selectBoolean($select) {
        //////
        $query = DAOGeneral::query($select);
        //////
        if ($query) {
            return true;
        }else {
            return false;
        }// end_else
    }// end_selectBoolean
    //////

    function selectSingle($select) {
        //////
        $query = DAOGeneral::query($select);
        $returnValue = "";
        //////
        if (mysqli_num_rows($query) > 0) {
            $returnValue = mysqli_fetch_assoc($query);
        }// end_if
        //////
        return $returnValue;
    }// end_selectOne
    //////

    function selectMultiple($select) {
        //////
        $query = DAOGeneral::query($select);
        $returnArr = array();
        //////
        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                $returnArr[] = $row;
            }// end_while
        }// end_if
        //////
        return $returnArr;
    }// end_selectMultiple
    //////

    function selectFilter() {
        //////
        $colsArr = array('brand', 'seats', 'doors', 'typeEngine', 'gearShift');
        $returnArrBrands = array();
        foreach ($colsArr as $row) {
            $select = 'SELECT DISTINCT ' . $row . ' FROM allCars ORDER BY ' . $row;
            $query = DAOGeneral::query($select);;
            if (mysqli_num_rows($query) > 0) {
                while ($row_inner[] = mysqli_fetch_assoc($query)) {
                    $returnArrBrands[$row] = $row_inner;
                }// end_while
                unset($row_inner);
            }// end_if
        }//end_foreach
        //////
        return $returnArrBrands;
    }// end_selectFilter
    //////
    
    function mountQuery($unmounted) {
        //////
        $i = 0;
        $cont2 = 0;
        $continue = "";
        $select = 'SELECT carPlate, brand, model, image FROM allCars WHERE ';
        foreach ($unmounted as $key => $row) {
            if ($i == 0) {
                foreach ($row as $row_inner) {
                    if ($cont2 == 0) {
                        $continue = $key . ' IN ("'. $row_inner . '"';
                    }else {
                        $continue = $continue  . ', "' . $row_inner . '"';
                    }// end_else
                    $cont2++;
                }// end_foreach
                $continue = $continue . ')';
            }else {
                foreach ($row as $row_inner) {
                    if ($cont2 == 0) {
                        $continue = ' AND ' . $key . ' IN ("' . $row_inner . '"';
                    }else {
                        $continue = $continue . ', "' . $row_inner . '"';
                    }// end_else
                    $cont2++;
                }// end_forearch
                $continue = $continue . ')';
            }// end_else
            $i++;
            $cont2 = 0;
            $select = $select . $continue;
        }// end_foreach
        //////
        return $select;
    }// end_mountQuery
}// end_QuerysShop