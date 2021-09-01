<?php
//============================================================+
// File name   : example_011.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 011 for TCPDF class
//               Colored Table (very simple table)
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Colored Table
 * @author Nicola Asuni
 * @since 2008-03-04
 */

  // Include the main TCPDF library (search for installation path).
  //require_once('tcpdf_include.php');
  require_once( dirname( __DIR__ ) .'/lib/tcpdf.php' );
  require_once( dirname( __DIR__ ) . '/srv/server-lib.php' );
  require_once( dirname( __DIR__ ) . '/srv/dbConnect.php' );


  // extend TCPF with custom functions
  class MYPDF extends TCPDF {

      // Load table data from file

      public function LoadData($file) {
          // Read file lines

          $lines = file($file);
          $data = array();
          foreach($lines as $line) {
              $data[] = explode(';', chop($line));
          }
          return $data;
      }

      // Colored table
      public function ColoredTable($header,$data) {
  //      public function ColoredTable($data) {
          // Colors, line width and bold font
          $this->SetFillColor(255, 0, 0);
          $this->SetTextColor(255);
          $this->SetDrawColor(128, 0, 0);
          $this->SetLineWidth(0.3);
          $this->SetFont('', 'B');
            // Header
          $w = array(40, 100);

          $this->Cell(20, 5, 'Date', 1, 0, 'L', 1);
          $this->Cell(25, 5, 'Name', 1, 0, 'L', 1);
          $this->Cell(25, 5, 'Driver', 1, 0, 'L', 1);
          $this->Cell(15, 5, 'GRN', 1, 0, 'L', 1);;
          $this->Cell(15, 5, 'TicketNo', 1, 0, 'L', 1);
          $this->Cell(15, 5, 'Quantity', 1, 0, 'R', 1);
          $this->Cell(15, 5, 'BagWt', 1, 0, 'R', 1);
          $this->Cell(15, 5, 'Total', 1, 0, 'R', 1);
          $this->Cell(15, 5, 'Rate', 1, 0, 'R', 1);
          $this->Cell(20, 5, 'Amount', 1, 0, 'R', 1);

          $this->Ln();
          // Color and font restoration
          $this->SetFillColor(224, 235, 255);
          $this->SetTextColor(0);
          $this->SetFont('');
          // Data
          $fill = 0;


          $this->Cell(array_sum($w), 0, '', 'T');
      }
  }

  // create new PDF document
  $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

  // set document information
  $pdf->SetCreator(PDF_CREATOR);
  $pdf->SetAuthor('Apurba Sengupta');
  $pdf->SetTitle('TCPDF Example 01');
  $pdf->SetSubject('TCPDF Tutorial');
  $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

  // set default header data
  $MyHeader = 'List of GRN as from '.$_POST['FromDt'].' to '.$_POST['ToDt'];
  $pdf->SetHeaderData('ep.jpg', 20, $MyHeader, 'Creatred by Saheli Deb');

  // set header and footer fonts
  $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
  $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

  // set default monospaced font
  $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

  // set margins
  $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
  $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
  $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

  // set auto page breaks
  $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

  // set image scale factor
  $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

  // set some language-dependent strings (optional)
  if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
      require_once(dirname(__FILE__).'/lang/eng.php');
      $pdf->setLanguageArray($l);
  }


  // set font
  $pdf->SetFont('helvetica', '', 8);

  // add a page
  $pdf->AddPage();

  // print colored table
  $pdf->ColoredTable($header, $data);


    if(isset($_POST['submitReport'])) {
      try {
        $db = OpenCon();
        if ($db->connect_errno) {

          throw new Exception("Cannot connect to database: ".$db->connect_error);
        }

        $FromDt = $_POST['FromDt'];
        $ToDt = $_POST['ToDt'];
        $SCode = $_POST['SupplierName'];
        $GTot=0;


  //      if(empty("$ItemName")) {$_SESSION['error'] = "enter Item Name ..."; $error_cnt = 1;}

        if($error_cnt == 0) {

  //      $sql=$db->prepare("DELETE FROM item WHERE i_code = ?");
        if( $SCode == '0000') {
          $sql=$db->prepare("SELECT GRN,GRDate,Driver,TicketNo,Qty,UOM,BagWt,Rate,i_name,s_name, Qty*BagWt as TotWt, Qty*BagWt*Rate as Amount FROM GRNDETAILS WHERE GRDate >= ? AND GRDate <= ? order by GRN");
          $sql->bind_param("ss", $FromDt,$ToDt);

        }else {
          $sql=$db->prepare("SELECT GRN,GRDate,Driver,TicketNo,Qty,UOM,BagWt,Rate,i_name,s_name, Qty*BagWt as TotWt, Qty*BagWt*Rate as Amount FROM GRNDETAILS WHERE GRDate >= ? AND GRDate <= ? AND s_code = ? order by GRN");
          $sql->bind_param("sss", $FromDt,$ToDt,$SCode);
        }

          if (!$sql->execute()) {
            throw new Exception($db -> error);
            echo "Error in Last Serial";
          }
          else {
            $sql->store_result();
            $sql->bind_result($Bind_GRN,$Bind_GRDate,$Bind_Driver,$Bind_TicketNo,$Bind_Qty,$Bind_UOM,$Bind_BagWt,$Bind_Rate,$Bind_iname,$Bind_sname,$Bind_TotWt,$Bind_Amount);
            $num_of_rows = $sql->num_rows;
            if($num_of_rows > 0)
            {

            while ($sql->fetch()) {

              $GRN=$Bind_GRN;
              $GRDate=$Bind_GRDate;
              $Driver=$Bind_Driver;
              $TicketNo = $Bind_TicketNo;
              $Qty = $Bind_Qty;
              $UOM = $Bind_UOM;
              $BagWt =$Bind_BagWt;
              $Rate = $Bind_Rate;
              $i_name = $Bind_iname;
              $s_name = $Bind_sname;
              $TotalWt = $Bind_TotWt;
              $Amount = $Bind_Amount;
              $GTot=$GTot + $Amount;

              $pdf->Ln(0);
              $pdf->cell(20,5,$GRDate,1,0,'L',0);
              $pdf->cell(25,5,$i_name,1,0,'L',0);
              $pdf->cell(25,5,$Driver,1,0,'L',0);
              $pdf->cell(15,5,$GRN,1,0,'L',0);
              $pdf->cell(15,5,$TicketNo,1,0,'R',0);
              $pdf->cell(15,5,$Qty,1,0,'R',0);
              $pdf->cell(15,5,$BagWt,1,0,'R',0);
              $pdf->cell(15,5,$TotalWt,1,0,'R',0);
              $pdf->cell(15,5,$Rate,1,0,'R',0);
              $pdf->cell(20,5,$Amount,1,0,'R',0);
              $pdf->Ln(5.5);
              }
            $pdf->cell(180,5,$GTot,1,0,'R',0);
            }
        $db->close();
        }

      }

    }
    catch (Exception $e) {
      error_log($e -> getMessage());
    }
  }

  // column titles
  $header = array('Country', 'Capital', 'Area (sq km)', 'Pop. (thousands)');

  // data loading
  $data = $pdf->LoadData('data/table_data_demo.txt');



  // ---------------------------------------------------------

  // close and output PDF document
  $pdf->Output('ReportGRN.pdf', 'I');

  //============================================================+
  // END OF FILE
  //============================================================+
  ?>
