<?php

namespace Isuru\StatBundle\Controller;

//require 'PDF.php';
//;
//use Isuru\StatBundle\Temp\PDF;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfessionReportController extends Controller {

    public function indexAction(Request $request) {

        $profession = $request->get('profession');

        $em = $this->getDoctrine()->getManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare("select occupation, district, gender, (case 
                                      when datediff(current_date, str_to_date(dateofbirth,'%m/%d/%Y'))/365 < 30 then '1'
                                      when datediff(current_date, str_to_date(dateofbirth,'%m/%d/%Y'))/365 between 30 and 50 then '2'
                                      else '3'
                                      end
                                     ) as t, sum(hours) from VolunteerContactDetails join VolunteerPersonal join Profile join Employment
                                     on VolunteerPersonal.user=VolunteerContactDetails.user and VolunteerContactDetails.user=Profile.user and Profile.user=Employment.user
                                     group by district, gender, t having occupation = '$profession' order by district, gender, t");

        $statement->execute();
        $hoursByDistrict = $statement->fetchAll();

        

        $statement = $connection->prepare("select occupation, gender, (case 
                                      when datediff(current_date, str_to_date(dateofbirth,'%m/%d/%Y'))/365 < 20 then '00-20'
                                      when datediff(current_date, str_to_date(dateofbirth,'%m/%d/%Y'))/365 between 20 and 30 then '20-30'
                          when datediff(current_date, str_to_date(dateofbirth,'%m/%d/%Y'))/365 between 30 and 40 then '30-40'
                          when datediff(current_date, str_to_date(dateofbirth,'%m/%d/%Y'))/365 between 40 and 50 then '40-50'
                          when datediff(current_date, str_to_date(dateofbirth,'%m/%d/%Y'))/365 between 50 and 60 then '50-60'
                                      else 'over 60'
                                      end
                                     ) as t, sum(hours) from VolunteerPersonal join Profile join Employment 
                                     on VolunteerPersonal.user=Profile.user and Profile.user=Employment.user group by  gender, t order by  t,gender");

        $statement->execute();
        $hoursByAgeGroup = $statement->fetchAll();

        $statement = $connection->prepare("select occupation, district, gender, (case 
                                      when datediff(current_date, str_to_date(dateofbirth,'%m/%d/%Y'))/365 < 30 then '1'
                                      when datediff(current_date, str_to_date(dateofbirth,'%m/%d/%Y'))/365 between 30 and 50 then '2'
                                      else '3'
                                      end
                                     ) as t, sum(hours*value) from VolunteerContactDetails join VolunteerPersonal join Profile join Employment
                                     on VolunteerPersonal.user=VolunteerContactDetails.user and VolunteerContactDetails.user=Profile.user and Profile.user=Employment.user
                                     group by district, gender, t having occupation = '$profession' order by district, gender, t");

        $statement->execute();
        $valueByDistrict = $statement->fetchAll();

        

        $statement = $connection->prepare("select occupation, gender, (case 
                                      when datediff(current_date, str_to_date(dateofbirth,'%m/%d/%Y'))/365 < 20 then '00-20'
                                      when datediff(current_date, str_to_date(dateofbirth,'%m/%d/%Y'))/365 between 20 and 30 then '20-30'
                          when datediff(current_date, str_to_date(dateofbirth,'%m/%d/%Y'))/365 between 30 and 40 then '30-40'
                          when datediff(current_date, str_to_date(dateofbirth,'%m/%d/%Y'))/365 between 40 and 50 then '40-50'
                          when datediff(current_date, str_to_date(dateofbirth,'%m/%d/%Y'))/365 between 50 and 60 then '50-60'
                                      else 'over 60'
                                      end
                                     ) as t, sum(hours*value) from VolunteerPersonal join Profile join Employment 
                                     on VolunteerPersonal.user=Profile.user and Profile.user=Employment.user group by  gender, t order by  t,gender");

        $statement->execute();
        $valueByAgeGroup = $statement->fetchAll();



        $list = $request->get('check_list5');


        require_once 'PDF.php';

        //catch volunteer ID
        //create a pdf
        $pdf = new \PDF("P", "mm", "A4");

        $pdf->SetMargins(25.4, 25.4, 25.4);
        $pdf->AddPage();
        $pdf->SetTopMargin(25.4);

        $pdf->SetTextColor(000, 000, 000);
        $pdf->SetFont('Times', '', 24);
        $pdf->SetXY(25.4, 100);
        $pdf->MultiCell(0, 10, 'PROFESSION VOLUNTEER REPORT ('.$profession.')', 0, 'L');
        $pdf->SetY($pdf->GetY() + 10);
        $pdf->SetFont('Times', '', 20);
        $pdf->MultiCell(0, 6, 'PRELIMINARY REPORT', 0, 'L');
        $pdf->SetY($pdf->GetY() + 10);
        $pdf->SetFont('Times', '', 18);
        $pdf->MultiCell(0, 6, 'NATIONAL VOLUNTEERING SECRETARIAT', 0, 'L');
        $pdf->SetY($pdf->GetY() + 10);

        foreach ($list as $value) {
            switch ($value) {
                case 1:
                    if ($hoursByDistrict != null) {
                        $pdf->AddPage();
                        $pdf->SetY(25.4);
                        $pdf->SetFont('Times', '', 16);
                        $pdf->MultiCell(0, 6, 'Volunteer hours by Age group, Gender and District', 0, 'C');
                        $pdf->SetY($pdf->GetY() + 10);
                        $pdf->SetFont('Times', '', 12);

                        $pdf->SetFont('Arial', 'B', 12); //Set the Font type to Arial,Bold with size 12 Pt
                        $pdf->SetTextColor(0); //Set the Text Color
                        $pdf->SetFillColor(000, 188, 225); //Fill the text with RGB Color
                        $pdf->SetLineWidth(0.2); //Set the Line Width to 1pt

                        $pdf->Cell(25, 10, 'District', 'LTR', 0, 'C', !true);
                        $pdf->Cell(45, 5, 'Male', 'LTR', 0, 'C', !true);
                        $pdf->Cell(45, 5, 'Female', 'LTR', 0, 'C', !true);
                        $pdf->Cell(45, 5, 'Total', 'LTR', 1, 'C', !true);
                        $pdf->SetX(50.4);
                        $pdf->SetFont('Times', '', 10);
                        $pdf->Cell(15, 5, 'Below 30', 'LTR', 0, 'C', !true);
                        $pdf->Cell(15, 5, '30-50', 'LTR', 0, 'C', !true);
                        $pdf->Cell(15, 5, 'Over 50', 'LTR', 0, 'C', !true);
                        $pdf->Cell(15, 5, 'Below 30', 'LTR', 0, 'C', !true);
                        $pdf->Cell(15, 5, '30-50', 'LTR', 0, 'C', !true);
                        $pdf->Cell(15, 5, 'Over 50', 'LTR', 0, 'C', !true);
                        $pdf->Cell(15, 5, 'Below 30', 'LTR', 0, 'C', !true);
                        $pdf->Cell(15, 5, '30-50', 'LTR', 0, 'C', !true);
                        $pdf->Cell(15, 5, 'Over 50', 'LTR', 1, 'C', !true);
                        $predis = 'null';
                        $b30M = 0;
                        $mM = 0;
                        $o30M = 0;
                        $b30F = 0;
                        $mF = 0;
                        $o30F = 0;
                        $pdf->SetFillColor(238);
                        $fill = false;
                        for ($i = 0; $i < count($hoursByDistrict); $i++) {
                            if ($predis != $hoursByDistrict[$i]['district']) {
                                if ($predis != 'null') {
                                    $pdf->Cell(25, 5, $predis, 1, 0, 'C', $fill);
                                    $pdf->Cell(15, 5, $b30M, 1, 0, 'C', $fill);
                                    $pdf->Cell(15, 5, $mM, 1, 0, 'C', $fill);
                                    $pdf->Cell(15, 5, $o30M, 1, 0, 'C', $fill);
                                    $pdf->Cell(15, 5, $b30F, 1, 0, 'C', $fill);
                                    $pdf->Cell(15, 5, $mF, 1, 0, 'C', $fill);
                                    $pdf->Cell(15, 5, $o30F, 1, 0, 'C', $fill);
                                    $pdf->Cell(15, 5, $b30F + $b30M, 1, 0, 'C', $fill);
                                    $pdf->Cell(15, 5, $mF + $mM, 1, 0, 'C', $fill);
                                    $pdf->Cell(15, 5, $o30F + $o30M, 1, 1, 'C', $fill);
                                    $fill = !$fill;
                                }
                                $b30M = 0;
                                $mM = 0;
                                $o30M = 0;
                                $b30F = 0;
                                $mF = 0;
                                $o30F = 0;
                            }

                            $predis = $hoursByDistrict[$i]['district'];
                            if ($hoursByDistrict[$i]['gender'] == "F") {
                                switch ($hoursByDistrict[$i]['t']) {
                                    case 1:
                                        $b30F = $hoursByDistrict[$i]['sum(hours)'];
                                        break;
                                    case 2:
                                        $mF = $hoursByDistrict[$i]['sum(hours)'];
                                        break;
                                    case 3:
                                        $o30F = $hoursByDistrict[$i]['sum(hours)'];
                                        break;
                                }
                            } else {
                                switch ($hoursByDistrict[$i]['t']) {
                                    case 1:
                                        $b30M = $hoursByDistrict[$i]['sum(hours)'];
                                        break;
                                    case 2:
                                        $mM = $hoursByDistrict[$i]['sum(hours)'];
                                        break;
                                    case 3:
                                        $o30M = $hoursByDistrict[$i]['sum(hours)'];
                                        break;
                                }
                            }
                            if ($i == count($hoursByDistrict) - 1) {
                                $pdf->Cell(25, 5, $predis, 1, 0, 'C', $fill);
                                $pdf->Cell(15, 5, $b30M, 1, 0, 'C', $fill);
                                $pdf->Cell(15, 5, $mM, 1, 0, 'C', $fill);
                                $pdf->Cell(15, 5, $o30M, 1, 0, 'C', $fill);
                                $pdf->Cell(15, 5, $b30F, 1, 0, 'C', $fill);
                                $pdf->Cell(15, 5, $mF, 1, 0, 'C', $fill);
                                $pdf->Cell(15, 5, $o30F, 1, 0, 'C', $fill);
                                $pdf->Cell(15, 5, $b30F + $b30M, 1, 0, 'C', $fill);
                                $pdf->Cell(15, 5, $mF + $mM, 1, 0, 'C', $fill);
                                $pdf->Cell(15, 5, $o30F + $o30M, 1, 1, 'C', $fill);
                                $fill = !$fill;
                            }
                        }
                    }

                    break;
                
                case 2:
                    if ($hoursByAgeGroup != null) {
                        $pdf->AddPage();
                        $pdf->SetY(25.4);
                        $pdf->SetFont('Times', '', 16);
                        $pdf->MultiCell(0, 6, 'Volunteer hours by Gender and Age group', 0, 'C');
                        $pdf->SetY($pdf->GetY() + 10);
                        $pdf->SetFont('Times', '', 12);

                        $pdf->SetFont('Arial', 'B', 12); //Set the Font type to Arial,Bold with size 12 Pt
                        $pdf->SetTextColor(0); //Set the Text Color
                        $pdf->SetFillColor(000, 188, 225); //Fill the text with RGB Color
                        $pdf->SetLineWidth(0.2); //Set the Line Width to 1pt

                        $pdf->Cell(40, 7, 'Age Group', 'LTR', 0, 'C', !true);
                        $pdf->Cell(40, 7, 'Male', 'LTR', 0, 'C', !true);
                        $pdf->Cell(40, 7, 'Female', 'LTR', 0, 'C', !true);
                        $pdf->Cell(40, 7, 'Total', 'LTR', 1, 'C', !true);
                        $preGroup = 'null';
                        $M = 0;
                        $F = 0;
                        $pdf->SetFont('Times', '', 12);
                        $pdf->SetFillColor(238);
                        $fill = false;
                        for ($i = 0; $i < count($hoursByAgeGroup); $i++) {
                            if ($preGroup != $hoursByAgeGroup[$i]['t']) {
                                if ($preGroup != 'null') {
                                    $pdf->Cell(40, 5, $preGroup, 1, 0, 'C', $fill);
                                    $pdf->Cell(40, 5, $M, 1, 0, 'C', $fill);
                                    $pdf->Cell(40, 5, $F, 1, 0, 'C', $fill);
                                    $pdf->Cell(40, 5, $M + $F, 1, 1, 'C', $fill);
                                    $fill = !$fill;
                                }
                                $M = 0;
                                $F = 0;
                            }

                            $preGroup = $hoursByAgeGroup[$i]['t'];
                            if ($hoursByAgeGroup[$i]['gender'] == "F") {
                                $F = $hoursByAgeGroup[$i]['sum(hours)'];
                            } else {
                                $M = $hoursByAgeGroup[$i]['sum(hours)'];
                            }
                            if ($i == count($hoursByAgeGroup) - 1) {
                                $pdf->Cell(40, 5, $preGroup, 1, 0, 'C', $fill);
                                $pdf->Cell(40, 5, $M, 1, 0, 'C', $fill);
                                $pdf->Cell(40, 5, $F, 1, 0, 'C', $fill);
                                $pdf->Cell(40, 5, $M + $F, 1, 1, 'C', $fill);
                                $fill = !$fill;
                            }
                        }
                    }
                    break;
                case 3:
                    if ($valueByDistrict != null) {
                        $pdf->AddPage();
                        $pdf->SetY(25.4);
                        $pdf->SetFont('Times', '', 16);
                        $pdf->MultiCell(0, 6, 'Volunteer value by Age group, Gender and District', 0, 'C');
                        $pdf->SetY($pdf->GetY() + 10);
                        $pdf->SetFont('Times', '', 12);

                        $pdf->SetFont('Arial', 'B', 12); //Set the Font type to Arial,Bold with size 12 Pt
                        $pdf->SetTextColor(0); //Set the Text Color
                        $pdf->SetFillColor(000, 188, 225); //Fill the text with RGB Color
                        $pdf->SetLineWidth(0.2); //Set the Line Width to 1pt

                        $pdf->Cell(25, 10, 'District', 'LTR', 0, 'C', !true);
                        $pdf->Cell(45, 5, 'Male', 'LTR', 0, 'C', !true);
                        $pdf->Cell(45, 5, 'Female', 'LTR', 0, 'C', !true);
                        $pdf->Cell(45, 5, 'Total', 'LTR', 1, 'C', !true);
                        $pdf->SetX(50.4);
                        $pdf->SetFont('Times', '', 10);
                        $pdf->Cell(15, 5, 'Below 30', 'LTR', 0, 'C', !true);
                        $pdf->Cell(15, 5, '30-50', 'LTR', 0, 'C', !true);
                        $pdf->Cell(15, 5, 'Over 50', 'LTR', 0, 'C', !true);
                        $pdf->Cell(15, 5, 'Below 30', 'LTR', 0, 'C', !true);
                        $pdf->Cell(15, 5, '30-50', 'LTR', 0, 'C', !true);
                        $pdf->Cell(15, 5, 'Over 50', 'LTR', 0, 'C', !true);
                        $pdf->Cell(15, 5, 'Below 30', 'LTR', 0, 'C', !true);
                        $pdf->Cell(15, 5, '30-50', 'LTR', 0, 'C', !true);
                        $pdf->Cell(15, 5, 'Over 50', 'LTR', 1, 'C', !true);
                        $predis = 'null';
                        $b30M = 0;
                        $mM = 0;
                        $o30M = 0;
                        $b30F = 0;
                        $mF = 0;
                        $o30F = 0;
                        $pdf->SetFillColor(238);
                        $fill = false;
                        for ($i = 0; $i < count($valueByDistrict); $i++) {
                            if ($predis != $valueByDistrict[$i]['district']) {
                                if ($predis != 'null') {
                                    $pdf->Cell(25, 5, $predis, 1, 0, 'C', $fill);
                                    $pdf->Cell(15, 5, $b30M, 1, 0, 'C', $fill);
                                    $pdf->Cell(15, 5, $mM, 1, 0, 'C', $fill);
                                    $pdf->Cell(15, 5, $o30M, 1, 0, 'C', $fill);
                                    $pdf->Cell(15, 5, $b30F, 1, 0, 'C', $fill);
                                    $pdf->Cell(15, 5, $mF, 1, 0, 'C', $fill);
                                    $pdf->Cell(15, 5, $o30F, 1, 0, 'C', $fill);
                                    $pdf->Cell(15, 5, $b30F + $b30M, 1, 0, 'C', $fill);
                                    $pdf->Cell(15, 5, $mF + $mM, 1, 0, 'C', $fill);
                                    $pdf->Cell(15, 5, $o30F + $o30M, 1, 1, 'C', $fill);
                                    $fill = !$fill;
                                }
                                $b30M = 0;
                                $mM = 0;
                                $o30M = 0;
                                $b30F = 0;
                                $mF = 0;
                                $o30F = 0;
                            }

                            $predis = $valueByDistrict[$i]['district'];
                            if ($valueByDistrict[$i]['gender'] == "F") {
                                switch ($valueByDistrict[$i]['t']) {
                                    case 1:
                                        $b30F = $valueByDistrict[$i]['sum(hours*value)'];
                                        break;
                                    case 2:
                                        $mF = $valueByDistrict[$i]['sum(hours*value)'];
                                        break;
                                    case 3:
                                        $o30F = $valueByDistrict[$i]['sum(hours*value)'];
                                        break;
                                }
                            } else {
                                switch ($valueByDistrict[$i]['t']) {
                                    case 1:
                                        $b30M = $valueByDistrict[$i]['sum(hours*value)'];
                                        break;
                                    case 2:
                                        $mM = $valueByDistrict[$i]['sum(hours*value)'];
                                        break;
                                    case 3:
                                        $o30M = $valueByDistrict[$i]['sum(hours*value)'];
                                        break;
                                }
                            }
                            if ($i == count($valueByDistrict) - 1) {
                                $pdf->Cell(25, 5, $predis, 1, 0, 'C', $fill);
                                $pdf->Cell(15, 5, $b30M, 1, 0, 'C', $fill);
                                $pdf->Cell(15, 5, $mM, 1, 0, 'C', $fill);
                                $pdf->Cell(15, 5, $o30M, 1, 0, 'C', $fill);
                                $pdf->Cell(15, 5, $b30F, 1, 0, 'C', $fill);
                                $pdf->Cell(15, 5, $mF, 1, 0, 'C', $fill);
                                $pdf->Cell(15, 5, $o30F, 1, 0, 'C', $fill);
                                $pdf->Cell(15, 5, $b30F + $b30M, 1, 0, 'C', $fill);
                                $pdf->Cell(15, 5, $mF + $mM, 1, 0, 'C', $fill);
                                $pdf->Cell(15, 5, $o30F + $o30M, 1, 1, 'C', $fill);
                                $fill = !$fill;
                            }
                        }
                    }
                    break;
                
                case 4:
                    if ($valueByAgeGroup != null) {
                        $pdf->AddPage();
                        $pdf->SetY(25.4);
                        $pdf->SetFont('Times', '', 16);
                        $pdf->MultiCell(0, 6, 'Volunteer value by Gender and Age group', 0, 'C');
                        $pdf->SetY($pdf->GetY() + 10);
                        $pdf->SetFont('Times', '', 12);

                        $pdf->SetFont('Arial', 'B', 12); //Set the Font type to Arial,Bold with size 12 Pt
                        $pdf->SetTextColor(0); //Set the Text Color
                        $pdf->SetFillColor(000, 188, 225); //Fill the text with RGB Color
                        $pdf->SetLineWidth(0.2); //Set the Line Width to 1pt

                        $pdf->Cell(40, 7, 'Age Group', 'LTR', 0, 'C', !true);
                        $pdf->Cell(40, 7, 'Male', 'LTR', 0, 'C', !true);
                        $pdf->Cell(40, 7, 'Female', 'LTR', 0, 'C', !true);
                        $pdf->Cell(40, 7, 'Total', 'LTR', 1, 'C', !true);
                        $preGroup = 'null';
                        $M = 0;
                        $F = 0;
                        $pdf->SetFont('Times', '', 12);
                        $pdf->SetFillColor(238);
                        $fill = false;
                        for ($i = 0; $i < count($valueByAgeGroup); $i++) {
                            if ($preGroup != $valueByAgeGroup[$i]['t']) {
                                if ($preGroup != 'null') {
                                    $pdf->Cell(40, 5, $preGroup, 1, 0, 'C', $fill);
                                    $pdf->Cell(40, 5, $M, 1, 0, 'C', $fill);
                                    $pdf->Cell(40, 5, $F, 1, 0, 'C', $fill);
                                    $pdf->Cell(40, 5, $M + $F, 1, 1, 'C', $fill);
                                    $fill = !$fill;
                                }
                                $M = 0;
                                $F = 0;
                            }

                            $preGroup = $valueByAgeGroup[$i]['t'];
                            if ($valueByAgeGroup[$i]['gender'] == "F") {
                                $F = $valueByAgeGroup[$i]['sum(hours*value)'];
                            } else {
                                $M = $valueByAgeGroup[$i]['sum(hours*value)'];
                            }
                            if ($i == count($valueByAgeGroup) - 1) {
                                $pdf->Cell(40, 5, $preGroup, 1, 0, 'C', $fill);
                                $pdf->Cell(40, 5, $M, 1, 0, 'C', $fill);
                                $pdf->Cell(40, 5, $F, 1, 0, 'C', $fill);
                                $pdf->Cell(40, 5, $M + $F, 1, 1, 'C', $fill);
                                $fill = !$fill;
                            }
                        }
                    }
                    break;
            }
        }

        return new Response($pdf->Output(), 200, array(
                    'Content-Type' => 'application/pdf'));
    }

    public function volunteerAction() {
        return $this->render('IsuruStatBundle:Default:index.html.twig');
    }

}
