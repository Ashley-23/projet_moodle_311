<?php
//CONNEXION AVEC MA BASE DE DONNEE
//OUVERTURE
$mysql = new mysqli("", "root", "", "moodle", 3306);

// $monnom = "audrey_satchivi";

// $skya = $mysql->query("SELECT * FROM mdl_user WHERE username='$monnom'", MYSQLI_USE_RESULT);

// TRAVAIL AVEC LE NOMBRE DE LA LIGNE 
/* Récupère un tableau d'objets */
// while ($row = $skya->fetch_row()) {
// 	echo $row[7];
// }



// TRAVAIL AVEC LE NOM DE LA LIGNE 
// while ($row = mysqli_fetch_assoc($skya)) {
// 	echo $row['username'] ;
// }



/**
 * Allows you to edit a users profile
 *
 * @copyright 1999 Martin Dougiamas http://dougiamas.com
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

		//CRE UNE NOUVELLE INSTANCE D'UTILISATEUR
		if ($id == -1) {
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
		// print_r($user);
		// var_dump($user);

		//CRE UNE NOUVELLE INSTANCE DE LA BASE DE DONNEE DE MON PLUGIN LOCAL
		$record = new stdClass;
		$record->username = $username;
		$record->firstname = $userfirstname;
		$record->lastname = $userlastname;
		$record->password = hash_internal_user_password($userpassword);
		$record->email = $useremail;
		$record->enterprise = $userentreprise;
		$record->timecreated = time();

		// REQUETES POUR RECUPERER LE CHAMP VOULU DANS LA BASE DE DONNEE S'IL COORESPOND A LA SAISIE DE L'UTILISATEUR
		$check_user_username = $mysql->query("SELECT * FROM mdl_user WHERE username='$username'", MYSQLI_USE_RESULT);
		$check_user_firstname = $mysql->query("SELECT * FROM mdl_user WHERE firstname='$userfirstname'", MYSQLI_USE_RESULT);
		$check_user_lastname = $mysql->query("SELECT * FROM mdl_user WHERE lastname='$userlastname'", MYSQLI_USE_RESULT);
		$check_user_emailname = $mysql->query("SELECT * FROM mdl_user WHERE email='$useremail'", MYSQLI_USE_RESULT);
::
		$check_user_entreprise = $mysql->query("SELECT * FROM mdl_user WHERE username='$userentreprise'", MYSQLI_USE_RESULT);


		// VERIFICATION DE L'EXISTANCE DU NOM D'UTILISATEUR

		while ($row = mysqli_fetch_assoc($check_user_username)) {
			$verify_user_username = $row['username'];
		}

		if (empty($verify_user_username)) {
			$username_result = 0;
		} else {
			if ($verify_user_username == $username) {
				$username_result = 1;
			} else {
				$username_result = 0;
			}
		}


		// VERIFICATION DE L'EXISTANCE DU PRENOM DE L'UTILISATEUR

		while ($row = mysqli_fetch_assoc($check_user_firstname)) {
			$verify_user_firstname = $row['firstname'];
		}

		if (empty($verify_user_firstname)) {
			$firstname_result = 0;
		} else {
			if ($verify_user_firstname == $userfirstname) {
				$firstname_result = 1;
			} else {
				$firstname_result = 0;
			}
		}

		// VERIFICATION DE L'EXISTANCE DU NOM DE FAMILLE DE L'UTILISATEUR

		while ($row = mysqli_fetch_assoc($check_user_lastname)) {
			$verify_user_lastname = $row['lastname'];
		}

		if (empty($verify_user_lastname)) {
			$lastname_result = 0;
		} else {
			if ($verify_user_lastname == $userlastname) {
				$lastname_result = 1;
			} else {
				$lastname_result = 0;
			}
		}

		// VERIFICATION DE L'EXISTANCE DE L'EMAIL DE L'UTILISATEUR

		while ($row = mysqli_fetch_assoc($check_user_emailname)) {
			$verify_user_lastname = $row['lastname'];
		}

		if (empty($verify_user_lastname)) {
			$lastname_result = 0;
		} else {
			if ($verify_user_lastname == $userlastname) {
				$lastname_result = 1;
			} else {
				$lastname_result = 0;
			}
		}
		
		// $userfirstname = $prenom;
		// $userlastname = $nom;
		// $username = $nomutilisateur;
		// $useremail = $email;
		// $userentreprise = $entreprise2;
		// $userpassword = $mdp2;

































		// $DB->insert_record('local_moodlepe_user', $record);

		// $k = $DB->query('SELECT name FROM mdl_cohort WHERE name=\'$userentreprise\'');
		// echo "<scrpit> alert($k) </script>";
		//
		// $kokoe = $DB->get_record('local_moodlepe_user');
		// print_r($kokoe);

		// *********************ON DOIT VERIFIER QUE L'ENREGISTREMENT SOIT UNIQUE ( au niveau de la table mdl_user)
		$monnom = "audrey_satchivi";

		$skya = $mysql->query("SELECT * FROM mdl_user WHERE username='$monnom'", MYSQLI_USE_RESULT);

		while ($row = mysqli_fetch_assoc($skya)) {
			echo $row['username'] . " echo 1";
			$verify_username = $row['username'];
		}

		if (empty($verify_username)) {
			echo "<script> alert('Je suis vide') </script>";
			$username_result = 0;
		} else {
			if ($verify_username == $nomutilisateur) {
				$username_result = 1;
				echo "<script> alert('Je ne suis pas vide et je suis égal à la valeur que tu cherches') </script>";
			} else {
				$username_result = 0;
				echo "<script> alert('Je ne suis pas vide et je ne suis pas égal à la valeur que tu cherches') </script>";
			}
		}

		// if ($verify_username == $nomutilisateur) {
		// 	$username_result = 0;
		// 	echo " le nom n'existe pas donc ma valeur est : " .  $username_result;
		// } else {
		// 	$username_result = 0;
		// 	echo " le nom n'existe pas donc ma valeur est : " .  $username_result;
		// }

		// 
	} else {
		// RETOURNE SUR LA PAGE AVEC UN MESSAGE D'ERREUR A AFFICHER
		$echec = "echec";
		header("Location: /moodle/local/moodlepe/register/index.php?erreur='$echec'&offre='$offer_id'");
	}
	// echo " mon nom est '$nom' et mon prénom est '$prenom' ";

}

mysqli_close($mysql);


// TRAVAIL AVEC LE NOMBRE DE LA LIGNE 
/* Récupère un tableau d'objets */
// while ($row = $skya->fetch_row()) {
// 	echo $row[7];
// }



// TRAVAIL AVEC LE NOM DE LA LIGNE 
// while ($row = mysqli_fetch_assoc($skya)) {
// 	echo $row['username'] ;
// }
