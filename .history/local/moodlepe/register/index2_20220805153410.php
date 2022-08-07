<?php
//CONNEXION AVEC MA BASE DE DONNEE
//OUVERTURE

// $dbhostname = database_hostname();

// $dbname =  database_name();

// $dbusername = database_username();

// $dbpassword = database_password();

// $dbport = database_port();

// $mysql = new mysqli($dbhostname, $dbusername, $dbpassword, $dbname, $dbport);

$mysql = new mysqli("", "root", "", "moodlepe", 3306);

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
$role_contextid = 1;
$role_descriptionformat = 1;
$role_visible = 1;
$timecreated = time();
$timemodified = time();


// ELEMENTS DE LA COHORTE

$insertion_cohorte_contextid = 1;
$insertion_cohorte_descriptionformat = 1;
$insertion_cohorte_visible = 1;




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

		//CREE UNE NOUVELLE INSTANCE DE COHORT 

		$cohort = new stdClass();

		$cohort->contextid = $insertion_cohorte_contextid;
		$cohort->name = $userentreprise;
		$cohort->idnumber = $userentreprise;
		$cohort->descriptionformat = $insertion_cohorte_descriptionformat;
		$cohort->visible = $insertion_cohorte_visible;
		$cohort->timecreated = time();
		$cohort->timemodified = time();





		// REQUETES POUR RECUPERER LE CHAMP VOULU DANS LA BASE DE DONNEE S'IL COORESPOND A LA SAISIE DE L'UTILISATEUR
		$check_user_username = $mysql->query("SELECT * FROM mdl_user WHERE username='$username'", MYSQLI_USE_RESULT);
		$check_user_firstname = $mysql->query("SELECT * FROM mdl_user WHERE firstname='$userfirstname'", MYSQLI_USE_RESULT);
		$check_user_lastname = $mysql->query("SELECT * FROM mdl_user WHERE lastname='$userlastname'", MYSQLI_USE_RESULT);
		$check_user_email = $mysql->query("SELECT * FROM mdl_user WHERE email='$useremail'", MYSQLI_USE_RESULT);
		//**************VERIFIE LE NOM DE LA COHORT
		$check_user_cohort_name = $mysql->query("SELECT * FROM mdl_cohort WHERE name='$userentreprise'", MYSQLI_USE_RESULT);
		//**************VERIFIE L'ID' DE LA COHORT
		$check_user_cohort_idnumber = $mysql->query("SELECT * FROM mdl_cohort WHERE idnumber='$userentreprise'", MYSQLI_USE_RESULT);
		//**************VERIFIE LE NOM LONG DU ROLE
		$check_user_role_name = $mysql->query("SELECT * FROM mdl_role WHERE name='$userentreprise'", MYSQLI_USE_RESULT);
		//**************VERIFIE LE NOM COURT DU ROLE
		$check_user_role_shortname = $mysql->query("SELECT * FROM mdl_role WHERE shortname='$userentreprise'", MYSQLI_USE_RESULT);

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

		while ($row = mysqli_fetch_assoc($check_user_email)) {
			$verify_user_email = $row['email'];
		}

		if (empty($verify_user_email)) {
			$email_result = 0;
		} else {
			if ($verify_user_email == $useremail) {
				$email_result = 1;
			} else {
				$email_result = 0;
			}
		}

		// VERIFICATION DU NOM DE LA COHORT

		while ($row = mysqli_fetch_assoc($check_user_cohort_name)) {
			$verify_cohort_name = $row['name'];
		}

		if (empty($verify_cohort_name)) {
			$cohort_name_result = 0;
		} else {
			if ($verify_cohort_name == $userentreprise) {
				$cohort_name_result = 1;
			} else {
				$cohort_name_result = 0;
			}
		}

		// VERIFICATION DE L'IDNUMBER DE LA COHORT

		while ($row = mysqli_fetch_assoc($check_user_cohort_idnumber)) {
			$verify_cohort_idnumber = $row['idnumber'];
		}

		if (empty($verify_cohort_idnumber)) {
			$cohort_idnumber_result = 0;
		} else {
			if ($verify_cohort_idnumber == $userentreprise) {
				$cohort_idnumber_result = 1;
			} else {
				$cohort_idnumber_result = 0;
			}
		}


		// VERIFICATION DU NOM DU ROLE 

		while ($row = mysqli_fetch_assoc($check_user_role_name)) {
			$verify_role_name = $row['name'];
		}

		if (empty($verify_role_name)) {
			$role_name_result = 0;
		} else {
			if ($verify_role_name == $userentreprise) {
				$role_name_result = 1;
			} else {
				$role_name_result = 0;
			}
		}

		// VERIFICATION DU NOM COURT DU ROLE 

		while ($row = mysqli_fetch_assoc($check_user_role_shortname)) {
			$verify_role_shortname = $row['shortname'];
		}

		if (empty($verify_role_shortname)) {
			$role_shortname_result = 0;
		} else {
			if ($verify_role_shortname == $userentreprise) {
				$role_shortname_result = 1;
			} else {
				$role_shortname_result = 0;
			}
		}



		// LES REDIRECTIONS AU CAS OU UN CHAMP EXISTE 

		// *******************USERNAME EXISTE
		if ($username_result == 1) {
			// 
			$usernameerror = "usernameerror";
			header("Location: /moodle/local/moodlepe/register/index.php?erreur='$usernameerror'&offre='$offer_id'");
		}

		// *******************EMAIL EXISTE
		if ($email_result == 1) {
			// 
			$emailerror = "emailerror";
			header("Location: /moodle/local/moodlepe/register/index.php?erreur='$emailerror'&offre='$offer_id'");
		}

		// *******************PRENOM ET NOM DE FAMILLE EXISTE
		if ($firstname_result == 1 && $lastname_result == 1) {
			// 
			$lastorfirstnameerror = "lastorfirstnameerror";
			header("Location: /moodle/local/moodlepe/register/index.php?erreur='$lastorfirstnameerror'&offre='$offer_id'");
		}

		// *******************NOM DE LA COHORTE, EXISTE
		if ($cohort_idnumber_result == 1 || $cohort_name_result == 1 || $role_name_result  == 1 || $role_shortname_result  == 1) {
			// 
			$entrepriseerror = "entrepriseerror";
			header("Location: /moodle/local/moodlepe/register/index.php?erreur='$entrepriseerror'&offre='$offer_id'");
		}


		// FAIS LES INSERTIONS DANS LA BASE DE DONNEE

		$DB->insert_record('local_moodlepe_user', $record);

		$context_level1  = "INSERT INTO mdl_role_context_levels (roleid, contextlevel) VALUES ('$verify_role_id', '$contextlevel1')";

		$mysql->query($context_level1);
		$DB->insert_record('user', $user);
		$DB->insert_record('cohort', $cohort);

		//RECUPERE L'ID DE L'UTILISATEUR QU'IL VIENT DE CREER 
		$check_user_id = $mysql->query("SELECT * FROM mdl_user WHERE email='$useremail'", MYSQLI_USE_RESULT);

		while ($row = mysqli_fetch_assoc($check_user_id)) {
			$verify_user_id = $row['id'];
		}

		//RECUPERE L'ID DE LA COHORTE QU'IL VIENT DE CREER 
		$check_cohorte_id = $mysql->query("SELECT * FROM mdl_cohort WHERE name='$userentreprise' AND idnumber='$userentreprise'", MYSQLI_USE_RESULT);

		while ($row = mysqli_fetch_assoc($check_cohorte_id)) {
			$verify_cohort_id = $row['id'];
		}


		//CREE UNE NOUVELLE INSTANCE DE COHORT_MEMBERS 
		$cohort_members = new stdClass();

		$cohort_members->cohortid = $verify_user_id;
		$cohort_members->userid = $verify_user_id;
		$cohort_members->timeadded = time();

		// INSCRIPTION DE L'UTILISATEUR DANS LA NOUVELLE COHORTE
		$DB->insert_record('cohort_members', $cohort_members);

		// ATTRIBUTION DE "NOTRE" ROLE SYSTEM L'UTILISATEUR CREE

		$role_name = "Administrateur pour les entreprises";
		$role_shortname = "administrateur_entreprise";
		$role_description = "role du plugin moodlepe";
		$role_archetype = "manager";

		$check_role_id = $mysql->query("SELECT * FROM mdl_role WHERE name='$role_name' AND shortname='$role_shortname' AND description ='$role_description'", MYSQLI_USE_RESULT);

		while ($row = mysqli_fetch_assoc($check_role_id)) {
			$verify_role_id = $row['id'];
		}

		$role_assignment_contextid = 1;
		$role_assignments_modifierid = 2;

		$role_assignement = new stdClass();
		$role_assignement->roleid = $verify_role_id;
		$role_assignement->contextid = $role_assignment_contextid;
		$role_assignement->userid = $verify_user_id;
		$role_assignement->timemodified = time();
		$role_assignement->modifierid = $role_assignments_modifierid;

		// INSCRIPTION DE L'UTILISATEUR dans le role créé 
		$DB->insert_record('role_assignments', $role_assignement);


		// REDIRIGER VERS LA PAGE D'ACCUEIL 
		$success = "succes";
		header("Location: /moodle/index.php");
	} else {
		// RETOURNE SUR LA PAGE AVEC UN MESSAGE D'ERREUR A AFFICHER
		$echec = "echec";
		header("Location: /moodle/local/moodlepe/register/index.php?erreur='$echec'&offre='$offer_id'");
	}
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
