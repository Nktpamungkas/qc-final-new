<?php
    ini_set("error_reporting", 1);
    session_start();
    //include config
    include "../../koneksi.php";
    include('Response.php');

    date_default_timezone_set('Asia/Jakarta'); 
    $response = new Response();
    $response->setHTTPStatusCode(201);
    if (isset($_SESSION['usrid']) && isset($_POST['status'])) {
         $id = intval($_POST['id_dt']);
        if($_POST['status']=="update_personil" && $id != 0){
           $update = "UPDATE tbl_aftersales_now 
                 SET personil =? ,
                 personil2 = ? ,
                 personil3 = ? ,
                 personil4 = ? ,
                 personil5 = ? ,
                 personil6 = ? ,
                 shift =? ,
                 shift2 =? ,
                 pejabat =? ,
                 status_penghubung =?,
                 sts_qc =? 
                 WHERE id = ? LIMIT 1";
            $confirm=mysqli_prepare( $con, $update );
            mysqli_stmt_bind_param($confirm, "ssssssssssss", $_POST['personil'], $_POST['personil2'], $_POST['personil3'], $_POST['personil4'], $_POST['personil5'], $_POST['personil6'], $_POST['shift'], $_POST['shift2'], $_POST['pejabat'], $_POST['hitung'], $_POST['sts_qc'],$id );
            if(mysqli_stmt_execute($confirm)){ 
                $arr_all_personil=array();
                if($_POST['personil']!=""){
                    $arr_all_personil[]=$_POST['personil'];
                }
                if($_POST['personil2']!=""){
                    $arr_all_personil[]=$_POST['personil2'];
                }
                if($_POST['personil3']!=""){
                    $arr_all_personil[]=$_POST['personil3'];
                }
                if($_POST['personil4']!=""){
                    $arr_all_personil[]=$_POST['personil4'];
                }
                if($_POST['personil5']!=""){
                    $arr_all_personil[]=$_POST['personil5'];
                }
                if($_POST['personil6']!=""){
                    $arr_all_personil[]=$_POST['personil6'];
                }
                $response->setSuccess(true);
                $response->addMessage("Berhasil Update Personil & Shift");
                $response->addMessage($id);
                $response->addMessage(join(',',$arr_all_personil));
                $response->addMessage($_POST['shift'].($_POST['shift2']==""?"":",".$_POST['shift2']));
                $response->addMessage($_POST['pejabat']);
                $response->addMessage($_POST['hitung']);
                $response->addMessage($_POST['sts_qc']);
                $response->send();
            }
            else {
                $response->setSuccess(false);
                $response->addMessage("Gagal Update Personil & Shift : ".mysqli_error($con));
                $response->send();
            }
        } 
        else{
            $response->setSuccess(false);
            $response->addMessage("Error Status");
            $response->send();
        }
    }else{
        $response->setSuccess(false);
        $response->addMessage("Tidak ada Session");
        $response->send();
    }