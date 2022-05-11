<?php
session_start();//pada report wajib aktifkan session_start agar tidak dilempar ke menu login
require_once('../config/+koneksi.php');
require_once('../models/database.php');
include '../models/m_barang.php';
$connection = new Database($host, $user, $pass, $database);
$brg = new Barang($connection);


        if (!isset($_SESSION['adm'])) 
        {
          echo "<script>alert('You must login..!');</script>";  
          echo "<script>location='../login/login';</script>";
          exit();
          //header('location:login/login.php');
        }


$content = '
<style type="text/css">
    .table { border-collapse:collapse; }
    .table th { padding:8px 5px; background-color:#B22222; color:#fff; }
    .table td { padding:3px; }
    img { width:70px }

    
</style>';

$content .= '
<page>
    <div style="padding:1mm; border:1px solid;" align="center">
       <span style="font-size:25px;"> PRODUCT </span>
    </div>
    <div style="padding:20px 0 10px 0; font-size:15px;" align="center">
        @nnurra__
    </div>

    <table border="1px" align="center" class="table">
            <tr align="center" style="font-size:20px;">
                <th>
                    No.
                </th>
                <th>
                    Product Name
                </th>
                <th>
                    Price
                </th>
                <th>
                    Stock
                </th>
                <th>
                    Picture
                </th>
            </tr>';

            $no = 1;
            $tampil = $brg->tampil();
            while ($data = $tampil->fetch_object()){
                $content .= '
                    <tr style="font-size:15px;">
                        <td align="center">'.$no++.".".'</td>
                        <td align="">'."'".$data->nama_barang."'".'</td>
                        <td align="">'."Rp".". ".number_format($data->harga_barang).",-".'</td>
                        <td align="center">'.number_format($data->stok_barang).'</td>
                        <td align="center"><img src="../assets/img/barang/'.$data->gambar_barang.'"></td>
                    </tr>';
            }


$content .= '           
    </table>


</page>
';

/**
 * Html2Pdf Library - example
 *
 * HTML => PDF converter
 * distributed under the OSL-3.0 License
 *
 * @package   Html2pdf
 * @author    Laurent MINGUET <webmaster@html2pdf.fr>
 * @copyright 2017 Laurent MINGUET
 */

require_once '../assets/html2pdf/html2pdf.class.php';
    $html2pdf = new Html2Pdf('P', 'A4', 'fr');
    $html2pdf->writeHTML($content);
    $html2pdf->output('Laporan Barang.pdf');
?>