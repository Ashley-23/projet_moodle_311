<?php
// $mysqli = new mysqli("localhost", "my_user", "my_password", "world");

// $con = mysqli_connect("localhost:8080", "", "");

//CONNEXION A LA BASE DE DONNEES
$mysqli = new mysqli("localhost:8080", "", "", "mdl_user", 3306);

$yelhsa = "Select * FROM mdl_user";
$rs = mysqli_query($con, $yelhsa);

// Name of the person
// $strName = $rs['FirstName'] . " " . $rs['LastName'];


// Create a link to person.php with the id-value in the URL
// $strLink = "<a href = 'person.php?id = " . $row['id'] . "'>" . $strNavn . "</a>";

// List link
// echo "<li>" . $strLink . "</li>";


mysql_close();

?>



<?php

/**
 * Allows you to edit a users profile
 *
 * @copyright 1999 Martin Dougiamas  http://dougiamas.com
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @package core_user
 */
require_once('../../../config.php');
require_once($CFG->libdir . '/gdlib.php');
require_once($CFG->libdir . '/adminlib.php');
require_once($CFG->dirroot . '/user/editadvanced_form.php');
require_once($CFG->dirroot . '/user/editlib.php');
require_once($CFG->dirroot . '/user/profile/lib.php');
require_once($CFG->dirroot . '/user/lib.php');
require_once($CFG->dirroot . '/webservice/lib.php');

global $DB;

$systemcontext = context_system::instance();



// ELEMENTS DE LA CREATION DE L'UTILISATEUR
$id = -1;
$mnethostid = 1;
$lang = "fr";

// ELEMENTS DE LA CREATION DU RÔLE
$rolecontextid = 1;
// $name = insertion;
// $idnumber = insertion;
$roledescriptionformat = 1;
$rolevisible = 1;
$timecreated = time();
$timemodified = time();


$usercontext = null;
$editoroptions = array(
	'maxfiles' => 0,
	'maxbytes' => 0,
	'trusttext' => false,
	'forcehttps' => false,
	'context' => $coursecontext
);


// Verification : si les valeurs sont vides... retour à la page des coordonnées
if (isset($_POST['userfirstname']) || isset($_POST['userlastname']) || isset($_POST['username']) || isset($_POST['useremail']) || isset($_POST['userentreprise1']) || isset($_POST['userentreprise2']) || isset($_POST['userpassword1']) || isset($_POST['userpassword2']) || isset($_POST['offre'])) {
	$prenom = $_POST['userfirstname'];
	$nom = $_POST['userlastname'];
	$nomutilisateur = $_POST['username'];
	$email = $_POST['useremail'];
	$entreprise1 = $_POST['userentreprise1'];
	$entreprise2 = $_POST['userentreprise2'];
	$mdp1 = $_POST['userpassword1'];
	$mdp2 = $_POST['userpassword2'];
	$offer_id = $_POST['offre'];

	if ($entreprise1 == $entreprise2 && $mdp1 == $mdp2) {
		$userfirstname = $prenom;
		$userlastname = $nom;
		$username = $nomutilisateur;
		$useremail = $email;
		$userentreprise = $entreprise2;
		$userpassword = $mdp2;



		echo "<script> alert('j\'existe juste') </script>";
		//CRE UNE NOUVELLE INSTANCE D'UTILISATEUR
		if ($id == -1) {
			echo "<script> alert('Je suis rentré') </script>";
			// Creating new user.
			$user = new stdClass();

			$user->id = -1;
			$user->auth = 'manual';
			$user->confirmed = 1;
			$user->deleted = 0;
			$user->timezone = '99';
			$user->username = $username;
			$user->firstname = $userfirstname;
			$user->lastname = $userlastname;
			$user->mnethostid = $mnethostid;
			$user->lang = $lang;
			$user->password = hash_internal_user_password($userpassword);
			$user->email = $useremail;
			$user->timecreated = time();
			$user->timemodified = time();

			// *********************ON DOIT VERIFIER QUE L'ENREGISTREMENT SOIT UNIQUE ( au niveau de la table mdl_user)
			// $DB->insert_record('user', $user);
			echo "<script> alert('Je suis sortie') </script>";
		}
		print_r($user);
		var_dump($user);


		$record = new stdClass;
		$record->username = $username;
		$record->firstname = $userfirstname;
		$record->lastname = $userlastname;
		$record->password = hash_internal_user_password($userpassword);
		$record->email = $useremail;
		$record->enterprise = $userentreprise;
		$record->timecreated = time();
		// $DB->insert_record('local_moodlepe_user', $record);

		// $k = $DB->query('SELECT name FROM mdl_cohort WHERE name=\'$userentreprise\'');
		// echo "<scrpit> alert($k) </script>";
		// 
		// $kokoe = $DB->get_record('local_moodlepe_user');
		// print_r($kokoe);

		// *********************ON DOIT VERIFIER QUE L'ENREGISTREMENT SOIT UNIQUE ( au niveau de la table mdl_user)

		echo "<script> alert('$userentreprise, $userpassword') </script>";
	} else {
		// RETOURNE SUR LA PAGE AVEC UN MESSAGE D'ERREUR A AFFICHER 
		$echec = "echec";
		header("Location: /moodle/local/moodlepe/register/index.php?erreur='$echec'&offre='$offer_id'");
	}
	// echo " mon nom est '$nom' et mon prénom est '$prenom' ";

}
