<?php

namespace Isuru\StatBundle\Controller;

//require 'PDF.php';
//;
//use Isuru\StatBundle\Temp\PDF;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IndividualReportController extends Controller {

    public function indexAction(Request $request) {

        $list = $request->get('check_list1');
        $volid = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare("select * from VolunteerPersonal where nicorpassport = '$volid'");
        $statement->execute();
        $personalInfo = $statement->fetchAll();
        $user = $personalInfo[0]['user'];
        $statement = $connection->prepare("select * from VolunteerContactDetails where user = '$user'");
        $statement->execute();
        $contactInfo = $statement->fetchAll();
        $statement = $connection->prepare("select * from Profile where user = '$user'");
        $statement->execute();
        $profile = $statement->fetchAll();
        $statement = $connection->prepare("select * from Education where user = '$user'");
        $statement->execute();
        $education = $statement->fetchAll();
        $statement = $connection->prepare("select * from Employment where user = '$user'");
        $statement->execute();
        $employment = $statement->fetchAll();
        $statement = $connection->prepare("select * from Availability where user = '$user'");
        $statement->execute();
        $availability = $statement->fetchAll();
        /* $statement = $connection->prepare("select * from referees left outer join refereeAnduser on referees.id = refereeAnduser.referee where refereeAnduser.user = '$user'");
          $statement->execute();
          $referee = $statement->fetchAll(); */

        // $personalInfo = $this->getDoctrine()->getManager()->getRepository('RidwanEntityBundle:Volunteerpersonal')->findOneBy(array('nicorpassport' => $volid));
        //$user = $personalInfo[0]['user'];
        //$contactInfo = $this->getDoctrine()->getManager()->getRepository('RidwanEntityBundle:Volunteercontactdetails')->findOneBy(array('user' => $user));
        //$profile = $this->getDoctrine()->getManager()->getRepository('RidwanEntityBundle:Profile')->findOneBy(array('user' => $user));
        //$education = $this->getDoctrine()->getManager()->getRepository('RidwanEntityBundle:Education')->findOneBy(array('user' => $user));
        //$employment = $this->getDoctrine()->getManager()->getRepository('RidwanEntityBundle:Employment')->findOneBy(array('user' => $user));
        //$skills = $this->getDoctrine()->getManager()->getRepository('RidwanEntityBundle:Skills')->findOneBy(array('user' => $user));
        //$availability = $this->getDoctrine()->getManager()->getRepository('RidwanEntityBundle:Availability')->findOneBy(array('user' => $user));
        //$feedbacks = $this->getDoctrine()->getManager()->getRepository('RidwanEntityBundle:Volunteerfeedback')->findOneBy(array('volunteer' => $user));

        require_once 'PDF.php';

        $pdf = new \PDF("P", "mm", "A4");

        $pdf->SetMargins(25.4, 25.4, 25.4);
        $pdf->AddPage();
        $pdf->SetTopMargin(25.4);

        $pdf->SetTextColor(000, 000, 000);
        $pdf->SetFont('Times', '', 24);
        $pdf->SetXY(25.4, 100);
        $pdf->MultiCell(0, 6, 'INDIVIDUAL VOLUNTEER REPORT', 0, 'L');
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
                    if ($personalInfo != null) {
                        $pdf->AddPage();
                        $pdf->SetY(25.4);
                        $pdf->SetFont('Times', '', 16);
                        $pdf->MultiCell(0, 6, 'Personal Details', 0, 'C');
                        $pdf->SetY($pdf->GetY() + 20);
                        $pdf->SetFont('Times', '', 12);
                        $data = array('firstname' => 'Name',
                            'nicORpassport' => 'NIC-Passport',
                            'Gender' => 'Gender',
                            'dateofbirth' => 'Date of Birth',
                            'Nationality' => 'Nationality',
                            'CivilStatus' => 'Civil Status'
                        );
                        foreach (array_keys($data) as $key) {
                            if ($personalInfo[0][$key] != NULL) {
                                if ($key == 'firstname') {
                                    $pdf->Cell(30, 0, $data[$key], '0', '0', "L");
                                    $pdf->Cell(0, 0, ': ' . $personalInfo[0]['firstname'] . ' ' . $personalInfo[0]['lastname'], '0', '0', "L");
                                    $pdf->SetY($pdf->GetY() + 15);
                                } else if ($key == 'CivilStatus') {
                                    $pdf->Cell(30, 0, $data[$key], '0', '0', "L");
                                    $status;
                                    if ($personalInfo[0][$key] == 0) {
                                        $status = 'Single';
                                    }
                                    else
                                        $status = 'Married';
                                    $pdf->Cell(0, 0, ': ' . $status, '0', '0', "L");
                                    $pdf->SetY($pdf->GetY() + 15);
                                }else {
                                    $pdf->Cell(30, 0, $data[$key], '0', '0', "L");
                                    $pdf->Cell(0, 0, ': ' . $personalInfo[0][$key], '0', '0', "L");
                                    $pdf->SetY($pdf->GetY() + 15);
                                }
                            }
                        }
                    }
                    break;
                case 2:
                    if ($contactInfo != null) {
                        $pdf->AddPage();
                        $pdf->SetY(25.4);
                        $pdf->SetFont('Times', '', 16);
                        $pdf->MultiCell(0, 6, 'Contact Details', 0, 'C');
                        $pdf->SetY($pdf->GetY() + 20);
                        $pdf->SetFont('Times', '', 12);
                        $data = array('mobile' => 'Mobile',
                            //'email' => 'Email',
                            'fax' => 'Fax',
                            'Address' => '',
                            'District' => 'District',
                            'Country' => 'Country',
                            'Province' => 'Province'
                        );
                        foreach (array_keys($data) as $key) {
                            if ($key == 'Address') {
                                $pdf->Cell(30, 0, 'Address', '0', '0', "L");
                                $pdf->Cell(0, 0, ': ' . $contactInfo[0]['StreetNumber'] . ', ' . $contactInfo[0]['Street'] . ', ' . $contactInfo[0]['City'], '0', '0', "L");
                                $pdf->SetY($pdf->GetY() + 15);
                            } else if ($contactInfo[0][$key] != NULL) {
                                $pdf->Cell(30, 0, $data[$key], '0', '0', "L");
                                $pdf->Cell(0, 0, ': ' . $contactInfo[0][$key], '0', '0', "L");
                                $pdf->SetY($pdf->GetY() + 15);
                            }
                        }
                    }
                    break;
                case 3:
                    if ($profile != null) {
                        $pdf->AddPage();
                        $pdf->SetY(25.4);
                        $pdf->SetFont('Times', '', 16);
                        $pdf->MultiCell(0, 6, 'User Profile Details', 0, 'C');
                        $pdf->SetY($pdf->GetY() + 20);
                        $pdf->SetFont('Times', '', 12);
                        $data = array('intro' => 'Introduction',
                            'reason' => 'Reason to Vol.',
                            'Experience' => 'Experience',
                            'Health' => 'Health',
                            'drivinglicense' => 'Driving License',
                            'arrested' => 'Arrested',
                            'aggregatedRating' => 'Aggregated Rating'
                        );
                        foreach (array_keys($data) as $key) {
                            if ($profile[0][$key] != NULL) {
                                $pdf->Cell(40, 6, $data[$key], '0', '0', "L");
                                $pdf->Cell(5, 6, ': ', '0', '0', "L");
                                $spaceleft = $pdf->h - $pdf->GetY() - $pdf->bMargin;
                                if ($pdf->GetMultiCellHeight(0, 6, $profile[0][$key], '', 'L') > $spaceleft) {
                                    $pdf->AddPage();
                                    $pdf->setY(25.4);
                                }
                                $pdf->MultiCell(0, 6, $profile[0][$key], '0', "L");
                                $pdf->SetY($pdf->GetY() + 10);
                            }
                        }
                    }
                    break;
                case 4:
                    if ($education != null) {
                        $pdf->AddPage();
                        $pdf->SetY(25.4);
                        $pdf->SetFont('Times', '', 16);
                        $pdf->MultiCell(0, 6, 'Education Details', 0, 'C');
                        $pdf->SetY($pdf->GetY() + 20);
                        $pdf->SetFont('Times', '', 12);
                        $data = array('institution' => 'Institute',
                            'field' => 'Field',
                            'degree' => 'Degree',
                            'duration' => 'Duration'
                        );
                        $pdf->SetFont('Arial', 'B', 12); //Set the Font type to Arial,Bold with size 12 Pt
                        $pdf->SetTextColor(0); //Set the Text Color
                        $pdf->SetFillColor(000, 188, 225); //Fill the text with RGB Color
                        $pdf->SetLineWidth(0.2); //Set the Line Width to 1pt

                        $pdf->Cell(70, 7, 'Institution', 'LTR', 0, 'C', true);
                        $pdf->Cell(40, 7, 'Field', 'LTR', 0, 'C', true);
                        $pdf->Cell(30, 7, 'Degree', 'LTR', 0, 'C', true);
                        $pdf->Cell(30, 7, 'Duration', 'LTR', 1, 'C', true);

                        $pdf->SetFont('Arial', '');
                        $pdf->SetFillColor(238);
                        $pdf->SetLineWidth(0.2); //0.2 pts
                        $fill = false;
                        for ($i = 0; $i < count($education); $i++) {
                            $pdf->Cell(70, 7, $education[$i]['institution'], 1, 0, 'C', $fill);
                            $pdf->Cell(40, 7, $education[$i]['field'], 1, 0, 'C', $fill);
                            $pdf->Cell(30, 7, $education[$i]['degree'], 1, 0, 'C', $fill);
                            $pdf->Cell(30, 7, $education[$i]['duration'], 1, 1, 'C', $fill);
                            $fill = !$fill;
                        }
                    }
                    break;
                case 5:
                    if ($employment != null) {
                        $pdf->AddPage();
                        $pdf->SetY(25.4);
                        $pdf->SetFont('Times', '', 16);
                        $pdf->MultiCell(0, 6, 'Employment Details', 0, 'C');
                        $pdf->SetY($pdf->GetY() + 20);
                        $pdf->SetFont('Times', '', 12);
                        $data = array('occupation' => 'Occupation',
                            'organizationtype' => 'Organization Type',
                            'organization' => 'Organization'
                        );
                        foreach (array_keys($data) as $key) {
                            if ($employment[0][$key] != NULL) {
                                $pdf->Cell(35, 0, $data[$key], '0', '0', "L");
                                $pdf->Cell(0, 0, ': ' . $employment[0][$key], '0', '0', "L");
                                $pdf->SetY($pdf->GetY() + 10);
                            }
                        }
                    }
                    break;
                case 6:
                    if ($availability != null) {
                        $pdf->AddPage();
                        $pdf->SetY(25.4);
                        $pdf->SetFont('Times', '', 16);
                        $pdf->MultiCell(0, 6, 'Availability Details', 0, 'C');
                        $pdf->SetY($pdf->GetY() + 20);
                        $pdf->SetFont('Times', '', 12);
                        $data = array('days' => 'Days',
                            'time' => 'Time'
                        );
                        foreach (array_keys($data) as $key) {
                           // if ($availability[0][$key] != NULL) {
                                $pdf->Cell(30, 0, $data[$key], '0', '0', "L");
                                $pdf->Cell(0, 0, ': ' . $availability[0][$key], '0', '0', "L");
                                $pdf->SetY($pdf->GetY() + 10);
                          //  }
                        }
                    }
                    break;
                /* case 7:
                  if ($availability != Null) {
                  $pdf->AddPage();
                  $pdf->SetY(25.4);
                  $pdf->SetFont('Times', '', 16);
                  $pdf->MultiCell(0, 6, 'Availability Details', 0, 'C');
                  $pdf->SetY($pdf->GetY() + 20);
                  $pdf->SetFont('Times', '', 12);
                  $data = array('name',
                  'address',
                  'contact number',
                  'email',
                  'mobile number',
                  'relationship'
                  );
                  for ($i = 0; $i < count($referee); $i++) {
                  foreach (array_keys($data) as $key) {
                  if ($referee[0][$key] != NULL) {
                  $pdf->Cell(0, 0, $$referee[0][$data[$key]], '0', '0', "L");
                  $pdf->SetY($pdf->GetY() + 10);
                  }
                  }
                  $pdf->SetY($pdf->GetY() + 15);
                  }
                  }
                  break; */
            }
        }


        return new Response($pdf->Output(), 200, array(
                    'Content-Type' => 'application/pdf'));

        /* return $this->render('IsuruStatBundle:Reports:individual.html.twig', array('personal' => $personalInfo,
          'contact' => $contactInfo,
          'profile' => $profile,
          'education'  => $education,
          'employment' => $employment,
          'availability' => $availability,
          'feedbacks' => $feedbacks,
          'list' =>$list)); */
    }

    public function volunteerAction() {
        return $this->render('IsuruStatBundle:Default:index.html.twig');
    }

}
