<?php
//////
$path = $_SERVER['DOCUMENT_ROOT'] . '/frameworkCars.v.1.2/';
//////
include ($path . 'model/Connect.php');
class QuerysShop {
    //////
    function selectCars() {
        //////
        $connection = Connect::enable();
        $select = 'SELECT carPlate, brand, model, image FROM allCars';
        $returnArr = array();
        //////
        $query = mysqli_query($connection, $select);
        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                $returnArr[] = $row;
            }// end_while
        }// end_if
        Connect::close($connection);
        //////
        return $returnArr;
    }// end_selectCars
    //////

    function selectAllCon() {
        //////
        $connection = Connect::enable();
        $select = 'SELECT * FROM concessionaire';
        $returnArr = array();
        //////
        $query = mysqli_query($connection, $select);
        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                $returnArr[] = $row;
            }// end_while
        }// end_if
        //////
        return $returnArr;
    }// end_selectAllCon
    //////

    function selectOne($carPlate) {
        //////
        $connection = Connect::enable();
        $select = 'SELECT * FROM allCars WHERE carPlate = "' . $carPlate . '"';
        $car = array();
        //////
        $query = mysqli_query($connection, $select);
        if (mysqli_num_rows($query) > 0) {
            $car = mysqli_fetch_assoc($query);
        }// end_if
        Connect::close($connection);
        //////
        return $car;
    }// end_selectOne
    //////

    function selectFilter() {
        //////
        $connection = Connect::enable();
        $colsArr = array('brand', 'seats', 'doors', 'typeEngine', 'gearShift');
        $returnArrBrands = array();
        foreach ($colsArr as $row) {
            $select = 'SELECT DISTINCT ' . $row . ' FROM allCars ORDER BY ' . $row;
            $query = mysqli_query($connection, $select);
            if (mysqli_num_rows($query) > 0) {
                while ($row_inner[] = mysqli_fetch_assoc($query)) {
                    $returnArrBrands[$row] = $row_inner;
                }// end_while
                unset($row_inner);
            }// end_if
        }//end_foreach
        Connect::close($connection);
        //////
        return $returnArrBrands;
        //////
    }// end_selectFilter
    //////

    function filterCars($filters) {
        //////
        $connection = Connect::enable();
        $returnArr = array();
        $select = 'SELECT carPlate, brand, model, image FROM allCars WHERE ';
        $i = 0;
        $cont2 = 0;
        $continue = "";
        foreach ($filters as $key => $row) {
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
        $query = mysqli_query($connection, $select);
        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                $returnArr[] = $row;
            }// end_while
        }// end_if
        //////
        Connect::close($connection);
        //////
        return $returnArr;
    }// end_filterCars
}// end_QuerysShop