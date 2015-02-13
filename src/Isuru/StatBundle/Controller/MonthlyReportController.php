<?php

namespace Isuru\StatBundle\Controller;

//require 'PDF.php';
//;
//use Isuru\StatBundle\Temp\PDF;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MonthlyReportController extends Controller {

    public function indexAction(Request $request) {

        /* $volid = $this->getDoctrine()->getManager()->getRepository('RidwanEntityBundle:Volunteerpersonal')->findAll();
          $list = $request->get('check_list[]');

          $pdf = new PDF("P", "mm", "A4");

          $pdf->SetMargins(25.4, 25.4, 25.4);
          $pdf->AddPage();
          $pdf->SetTopMargin(25.4);

          $pdf->SetTextColor(000, 000, 000);
          $pdf->SetFont('Times', '', 12);
          $pdf->SetXY(25.4, 25);
          $pdf->MultiCell(0, 6, 'This Report is presented by the National Volunteering Secretariat Sri Lanka.', 0, 'J');
          $pdf->SetY($pdf->GetY() + 10);

          /* if (!empty($list)) {
          // Counting number of checked checkboxes.
          $checked_count = count($list);
          echo "You have selected following " . $checked_count . " option(s): <br/>";
          // Loop to store and display values of individual checked checkbox.
          foreach ($list as $selected) {
          echo "<p>" . $selected . "</p>";
          $pdf->SetTextColor(000, 000, 000);
          $pdf->SetFont('Times', '', 16);
          $pdf->SetY($pdf->GetY() + 10);

          //print details according to the selected options
          switch ($selected) {
          case 0:
          $query = "SELECT * from `volunteer personal` where ID = '" . $volID . "'";
          $personalInfo = $this->getDoctrine()->getManager()->getRepository('RidwanEntityBundle:Volunteerpersonal')->findOneBy(array('nicORpassport'=>$volid));
          if ($row = mysqli_fetch_array($personalInfo)) {


          $pdf->Cell(0, 0, 'Personal Details', '0', '0', "C");
          $pdf->SetY($pdf->GetY() + 10);

          $pdf->SetTextColor(000, 000, 000);
          $pdf->SetFont('Times', '', 12);

          $nickname = $row['preferred name'];
          if ($nickname != NULL) {
          $pdf->Cell(0, 0, 'This person preferred to be called as "' . $nickname . '".', '0', '1', "L");
          $pdf->SetY($pdf->GetY() + 10);
          }

          $data = array('full name' => 'Name',
          'NIC-Passport' => 'NIC-Passport',
          'Gender' => 'Gender',
          'dateofbirth' => 'Date of Birth',
          'Nationality' => 'Nationality',
          'Civil Status' => 'Civil Status'
          );
          foreach (array_keys($data) as $key) {
          if ($row[$key] != NULL) {
          $pdf->Cell(30, 0, $data[$key], '0', '0', "L");
          $pdf->Cell(0, 0, ': ' . $row[$key], '0', '0', "L");
          $pdf->SetY($pdf->GetY() + 10);
          }
          }
          }

          break;
          case 1:
          $query = "SELECT * from `volunteer contact details` where user = '" . $volID . "'";
          $contactInfo = $con->getData($query);
          $query = "SELECT * from `volunteer contact numbers` where user = '" . $volID . "'";
          $contactNumbers = $con->getData($query);

          $pdf->AddPage();
          $pdf->SetY(25.4);
          $pdf->Cell(0, 0, 'Contact Details', '0', '0', "C");
          $pdf->SetY($pdf->GetY() + 10);

          $pdf->SetTextColor(000, 000, 000);
          $pdf->SetFont('Times', '', 12);
          $mobCount = 0;
          while ($row1 = mysqli_fetch_array($contactNumbers)) {
          $mobCount++;
          if ($mobCount == 1)
          $pdf->Cell(30, 0, 'Contact Number', '0', '0', "L");
          else
          $pdf->Cell(30, 0, ' ', '0', '0', "L");
          $pdf->Cell(20, 0, ': ' . $row1['number'], '0', '0', "L");
          $pdf->Cell(0, 0, $row1['type'], '0', '0', "L");
          $pdf->SetY($pdf->GetY() + 10);
          }

          if ($row = mysqli_fetch_array($contactInfo)) {

          $data = array('email' => 'Email',
          'fax' => 'Fax',
          'Address' => '',
          'District' => 'District',
          'Country' => 'Country',
          'Province' => 'Province'
          );

          foreach (array_keys($data) as $key) {
          if ($key == 'Address') {
          $pdf->Cell(30, 0, 'Address', '0', '0', "L");
          $pdf->Cell(0, 0, ': ' . $row['Street Number'] . ', ' . $row['Street'] . ', ' . $row['City'], '0', '0', "L");
          $pdf->SetY($pdf->GetY() + 10);
          } else if ($row[$key] != NULL) {
          $pdf->Cell(30, 0, $data[$key], '0', '0', "L");
          $pdf->Cell(0, 0, ': ' . $row[$key], '0', '0', "L");
          $pdf->SetY($pdf->GetY() + 10);
          }
          }
          }

          break;
          case 2:
          $query = "SELECT * from `profile` where user = '" . $volID . "'";
          $profile = $con->getData($query);

          if ($row = mysqli_fetch_array($profile)) {

          $pdf->AddPage();
          $pdf->SetY(25.4);
          $pdf->Cell(0, 0, 'User Profile', '0', '0', "C");
          $pdf->SetY($pdf->GetY() + 10);

          $pdf->SetTextColor(000, 000, 000);
          $pdf->SetFont('Times', '', 12);


          $data = array('intro' => 'Introduction',
          'reason' => 'Reason to Vol.',
          'Experience' => 'Experience',
          'Health' => 'Health',
          'driving license' => 'Driving License',
          'arrested' => 'Arrested',
          'aggregatedRating' => 'Aggregated Rating'
          );

          foreach (array_keys($data) as $key) {
          if ($row[$key] != NULL) {
          $pdf->Cell(35, 6, $data[$key], '0', '0', "L");
          $pdf->Cell(5, 6, ': ', '0', '0', "L");
          $pdf->MultiCell(0, 6, $row[$key], '0', "L");
          $pdf->SetY($pdf->GetY() + 10);
          }
          }
          }
          break;
          case 3:
          $query = "SELECT * from `education` where user = '" . $volID . "'";
          $education = $con->getData($query);

          if ($row = mysqli_fetch_array($education)) {
          $data = array('institution' => 'Institute',
          'field' => 'Field',
          'degree' => 'Degree',
          'duration' => 'Duration'
          );


          $pdf->AddPage();
          $pdf->SetY(25.4);
          $pdf->Cell(0, 0, 'Education Information', '0', '0', "C");
          $pdf->SetY($pdf->GetY() + 10);

          $pdf->SetTextColor(000, 000, 000);
          $pdf->SetFont('Times', '', 12);

          foreach (array_keys($data) as $key) {
          if ($row[$key] != NULL) {
          $pdf->Cell(30, 0, $data[$key], '0', '0', "L");
          $pdf->Cell(0, 0, ': ' . $row[$key], '0', '0', "L");
          $pdf->SetY($pdf->GetY() + 10);
          }
          }
          }
          break;
          case 4:
          $query = "SELECT * from `employment` where user = '" . $volID . "'";
          $employment = $con->getData($query);

          if ($row = mysqli_fetch_array($employment)) {
          $data = array('occupation' => 'Occupation',
          'organization type' => 'Organization Type',
          'organization' => 'Organization'
          );


          $pdf->AddPage();
          $pdf->SetY(25.4);
          $pdf->Cell(0, 0, 'Employment Information', '0', '0', "C");
          $pdf->SetY($pdf->GetY() + 10);

          $pdf->SetTextColor(000, 000, 000);
          $pdf->SetFont('Times', '', 12);

          foreach (array_keys($data) as $key) {
          if ($row[$key] != NULL) {
          $pdf->Cell(35, 0, $data[$key], '0', '0', "L");
          $pdf->Cell(0, 0, ': ' . $row[$key], '0', '0', "L");
          $pdf->SetY($pdf->GetY() + 10);
          }
          }
          }
          break;
          case 5:
          $query = "SELECT * from `skills` where user = '" . $volID . "'";
          $skills = $con->getData($query);

          if ($row = mysqli_fetch_array($skills)) {
          $data = array('skills' => 'Skills',
          'causes' => 'Causes',
          'other' => 'Other',
          'languages' => 'Languages'
          );


          $pdf->AddPage();
          $pdf->SetY(25.4);
          $pdf->Cell(0, 0, 'Skills', '0', '0', "C");
          $pdf->SetY($pdf->GetY() + 10);

          $pdf->SetTextColor(000, 000, 000);
          $pdf->SetFont('Times', '', 12);

          foreach (array_keys($data) as $key) {
          if ($row[$key] != NULL) {
          $pdf->Cell(30, 6, $data[$key], '0', '0', "L");
          $pdf->Cell(5, 6, ': ', '0', '0', "L");
          $pdf->MultiCell(0, 6, $row[$key], '0', "L");
          $pdf->SetY($pdf->GetY() + 4);
          }
          }
          }
          break;
          case 6:
          $query = "SELECT * from `availability` where user = '" . $volID . "'";
          $availability = $con->getData($query);

          if ($row = mysqli_fetch_array($availability)) {
          $data = array('days' => 'Days',
          'duration' => 'During',
          'preferred time' => 'Preferred Time',
          );


          $pdf->AddPage();
          $pdf->SetY(25.4);
          $pdf->Cell(0, 0, 'Availability', '0', '0', "C");
          $pdf->SetY($pdf->GetY() + 10);

          $pdf->SetTextColor(000, 000, 000);
          $pdf->SetFont('Times', '', 12);

          foreach (array_keys($data) as $key) {
          if ($row[$key] != NULL) {
          $pdf->Cell(30, 0, $data[$key], '0', '0', "L");
          $pdf->Cell(0, 0, ': ' . $row[$key], '0', '0', "L");
          $pdf->SetY($pdf->GetY() + 10);
          }
          }
          }
          break;
          case 7:
          $query = "SELECT * from volunteer `feedback` where ID = '" . $volID . "'";
          $feedbacks = $con->getData($query);
          break;
          case 8:
          $query = "SELECT * FROM referees left outer join `referee and user` on referees.id = `referee and user`.referee where `referee and user`.user = '" . $volID . "'";
          $referees = $con->getData($query);

          if ($row = mysqli_fetch_array($referees)) {

          $data = array('name',
          'address',
          'contact number',
          'email',
          'mobile number',
          'relationship'
          );


          $pdf->AddPage();
          $pdf->SetY(25.4);
          $pdf->Cell(0, 0, 'Referees', '0', '0', "C");
          $pdf->SetY($pdf->GetY() + 10);

          $pdf->SetTextColor(000, 000, 000);
          $pdf->SetFont('Times', '', 12);

          do {
          foreach (array_keys($data) as $key) {
          if ($row[$key] != NULL) {
          //$pdf->Cell(30, 0, $data[$key], '0', '0', "L");
          $pdf->Cell(0, 0, $row[$data[$key]], '0', '0', "L");
          $pdf->SetY($pdf->GetY() + 6);
          }
          }
          $pdf->SetY($pdf->GetY() + 10);
          } while ($row = mysqli_fetch_array($referees));
          }

          break;
          }
          }
          } */
        /*$individualModalAttribute = array('Personal Details',
            'Contact Details',
            'Profile',
            'Education',
            'Employment',
            'Availability',
            'Feedbacks'
        );
        $select = array();
        foreach ($individualModalAttribute as $attr) {
            $temp = $request->get($attr);
            if($temp==true){
                $select.array_push($select, $temp);
            }
        }*/
        
        
        
        $list = $request->get('check_list');
        $volid = $request->get('id');
        $personalInfo = $this->getDoctrine()->getManager()->getRepository('RidwanEntityBundle:Volunteerpersonal')->findOneBy(array('nicorpassport' => $volid));
        $user = $personalInfo->getUser();
        $contactInfo = $this->getDoctrine()->getManager()->getRepository('RidwanEntityBundle:Volunteercontactdetails')->findOneBy(array('user' => $user));
        $profile = $this->getDoctrine()->getManager()->getRepository('RidwanEntityBundle:Profile')->findOneBy(array('user' => $user));
        $education = $this->getDoctrine()->getManager()->getRepository('RidwanEntityBundle:Education')->findOneBy(array('user' => $user));
        $employment = $this->getDoctrine()->getManager()->getRepository('RidwanEntityBundle:Employment')->findOneBy(array('user' => $user));
        //$skills = $this->getDoctrine()->getManager()->getRepository('RidwanEntityBundle:Skills')->findOneBy(array('user' => $user));
        $availability = $this->getDoctrine()->getManager()->getRepository('RidwanEntityBundle:Availability')->findOneBy(array('user' => $user));
        $feedbacks = $this->getDoctrine()->getManager()->getRepository('RidwanEntityBundle:Volunteerfeedback')->findOneBy(array('volunteer' => $user));

        return $this->render('IsuruStatBundle:Reports:individual.html.twig', array('personal' => $personalInfo,
        'contact' => $contactInfo,
        'profile' => $profile,
            'education'  => $education,
            'employment' => $employment,
            'availability' => $availability,
            'feedbacks' => $feedbacks,
            'list' =>$list));
    }

    public function volunteerAction() {
        return $this->render('IsuruStatBundle:Default:index.html.twig');
    }

}
