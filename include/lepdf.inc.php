<?php
include "fpdf.php";
//definition a récuperer dans les fichiers inc.
class PDF extends FPDF
{
  function Footer()
  {
    //Positionnement à 1,5 cm du bas
    $this->SetY(-15);
    //Police Arial italique 8
    $this->SetFont('Arial','I',8);
    $DateJ=date('d/m/Y');
    //Numéro et nombre de pages
    //Postionne le nom
    $this->SetX(20);
    $this->cell(60,10,'Imprimé le '.$DateJ,0,0);
    $this->cell(0,10,'(c)2009 Editiel98',0,0);
    $this->SetX(170);
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0);
  }
  function AddLigne($theme1,$theme2,$Val1,$Val2)
  {
    $this->SetTextColor(0,0,0);
    $Larg=$this->GetStringWidth($theme1)+1;
    $this->Cell($Larg,5,$theme1,0,0);
    $this->SetTextColor(220,50,50);
    $this->write(5,$Val1);
    $this->SetX(123);
    $this->SetTextColor(0,0,0);
    $Larg=$this->GetStringWidth($theme2)+1;
    $this->Cell($Larg,5,$theme2,0,0);
    $this->SetTextColor(220,50,50);
    $this->write(5,$Val2);
    $this->ln(7);
    $this->SetTextColor(0,0,0);
  }
}
