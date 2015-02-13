<?php

namespace Isuru\StatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {
        $mainRow = array(1, 2);
        $subRow = array(1, 2, 3);
        /*$districts = array("Kurunegala",
            "Puttalam",
            "Anuradhapura",
            "Polonnaruwa",
            "Jaffana",
            "Mullaitivu",
            "Kilinochchi",
            "Mannar",
            "Vavuniya",
            "Kalutara",
            "Colombo",
            "Gampaha",
            "Galle",
            "Matara",
            "Hambantota",
            "Ampara",
            "Batticaloa",
            "Trincomalee",
            "Moneragala",
            "Badulla",
            "Matale",
            "Kandy",
            "Nuwara Eliya",
            "Ratnapura",
            "Kegalle"
        );
        $professions = array("Agriculture",
            "Business development",
            "Communications",
            "Education",
            "Engineering",
            "Finance",
            "Health",
            "Human Resourses",
            "Information Technology",
            "Legal",
            "Management",
            "Millitery Specific",
            "Natural Resource Management",
            "Office & Administrative Support",
            "Plant and machine operators",
            "Surveyor's Services",
            "Special Education",
            "Social Worker",
            "Social Development",
            "Support services",
            "Technical",
            "Translator's Service",
            "Vocational Technical Trainer"
        );
        sort($professions);
        sort($districts);*/
        $em = $this->getDoctrine()->getManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare("select distinct district from VolunteerContactDetails order by district");
        $statement->execute();
        $districts = $statement->fetchAll();
        $statement = $connection->prepare("select distinct occupation from Employment order by occupation");
        $statement->execute();
        $professions = $statement->fetchAll();
        $description = array("Individual",
            "Overall",
            "Monthly",
            "By District",
            "By Profession",
            "By Gender"
        );
        $individualModalAttribute = array('Personal Details',
            'Contact Details',
            'Profile',
            'Education',
            'Employment',
            'Availability',
                //'Referees'
        );
        $overallModalAttribute = array(
            'Working Hours by District',
            'Working Hours by Profession',
            'Working Hours by Gender',
            'Volunteer Value by District',
            'Volunteer Value by Profession',
            'Volunteer Value by Gender'
        );

        $monthlyModalAttribute = array(
            'Working Hours by District',
            'Working Hours by Profession',
            'Working Hours by Gender',
            'Volunteer Value by District',
            'Volunteer Value by Profession',
            'Volunteer Value by Gender'
        );
        $districtModalAttribute = array(
            'Working Hours by Profession',
            'Working Hours by Gender',
            'Volunteer Value by Profession',
            'Volunteer Value by Gender'
        );
        $professionModalAttribute = array(
            'Working Hours by District',
            'Working Hours by Gender',
            'Volunteer Value by District',
            'Volunteer Value by Gender'
        );
        $genderModalAttribute = array(
            'Working Hours by District',
            'Working Hours by Profession',
            'Volunteer Value by District',
            'Volunteer Value by Profession'
        );
        $modal = array(
            'Individual',
            'Overall',
            'Monthly',
            'District',
            'Profession',
            'Gender'
        );

        $volid = $this->getDoctrine()->getManager()->getRepository('RidwanEntityBundle:Volunteerpersonal')->findAll();
        return $this->render('IsuruStatBundle:Default:index.html.twig', array('mainRow' => $mainRow,
                    'subRow' => $subRow,
                    'description' => $description,
                    'individualModalAttribute' => $individualModalAttribute,
                    'overallModalAttribute' => $overallModalAttribute,
                    'districtModalAttribute' => $districtModalAttribute,
                    'professionModalAttribute' => $professionModalAttribute,
                    'genderModalAttribute' => $genderModalAttribute,
                    'monthlyModalAttribute' => $monthlyModalAttribute,
                    'modal' => $modal,
                    'volid' => $volid,
                    'districts' => $districts,
                    'professions' => $professions));
    }

    public function volunteerAction() {
        return $this->render('IsuruStatBundle:Default:index.html.twig');
    }

}
