<?php

    /**
     *  Get All Function v1.0 
     *  Function To Get Categories From Database
     */


    /*get all the tables from database */
    function getAllTable($field, $allTable, $where = NULL, $and = NULL, $orderField= NULL, $ordering = 'DESC'){

        global $con;

        $getAll = $con->prepare("SELECT $field FROM $allTable $where $and ORDER BY $orderField $ordering");

        $getAll->execute();

        $all = $getAll->fetchAll();

        return $all;

    }


    
    

     /**
      *  Count Numbers Of Items Function V1.0 
      *  Function To Count Numbers Of Items Rows
      *  $itme = The Item To Count 
      *  $table = The Table To Choose From
      */

      function countRating($where){

        global $con;

        $stmt2 = $con->prepare("SELECT COUNT(rating) FROM rating $where");

        $stmt2->execute();

        return $stmt2->fetchColumn();

      }
       
    
// ________________________________________________________________________________________________________________

 



     

    
     /**
      *  Count Numbers Of Items Function V1.0 
      *  Function To Count Numbers Of Items Rows
      *  $itme = The Item To Count 
      *  $table = The Table To Choose From
      */

      function sumRating($where){

        global $con;

        $stmt2 = $con->prepare("SELECT SUM(rating) FROM rating $where");

        $stmt2->execute();

        return $stmt2->fetchColumn();

      }

      