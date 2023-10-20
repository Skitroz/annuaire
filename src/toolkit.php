<!-- Fonction de vérification si l'utilisateur est connecté ou non -->
<?php
function verifConnexion()
{
    if (!isset($_SESSION['username'])) {
        header('Location: ./connexion.inc.php');
        exit;
    }
}
?>

<!-- Fonction d'ajout d'étudiant -->
<?php
function ajoutEtudiant()
{
    if (isset($_POST['enregistrer'])) {
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $mail = $_POST['mail'];
        $annee = $_POST['annee'];
        $specialite = $_POST['specialite'];

        require_once(__DIR__ . '/../configs/bootstrap.php');

        $requete = "INSERT INTO etudiants (prenom, nom, mail, annee, spe) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($requete);
        $stmt->execute([$prenom, $nom, $mail, $annee, $specialite]);
        header("Location: /annuaire/templates/includes/annuaire.inc.php");
        exit;
    }
}
?>

<!-- Fonction pour supprimer un étudiant -->
<?php
function supprimerEtudiant()
{
    if (isset($_GET['id'])) {
        $etudiantId = $_GET['id'];
        require_once(__DIR__ . '/../configs/bootstrap.php');

        $requete = "DELETE FROM etudiants WHERE id = ?";
        $stmt = $pdo->prepare($requete);

        if ($stmt->execute([$etudiantId])) {
            header("Location: ./annuaire.inc.php");
            exit();
        } else {
            echo "Une erreur s'est produite lors de la suppression de l'étudiant.";
        }
    } else {
        header("Location: ./annuaire.inc.php");
        exit();
    }
}
?>

<!-- Fonction pour se connecter -->
<?php
function connexion()
{
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");

    if (isset($_POST["connexion"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        require_once(__DIR__ . '/../configs/bootstrap.php');
        $stmt = $pdo->prepare("SELECT * FROM login WHERE username = ? AND password = ?");
        $stmt->execute([$username, $password]);

        if ($stmt->rowCount() > 0) {
            $_SESSION['username'] = $username;
            header("Location: ./annuaire.inc.php");
            exit();
        } else {
            echo "<p class='text-red-500 font-bold text-lg mt-8 text-center mb-12 sm:mb-0'>Le nom d'utilisateur ou le mot de passe est incorrect.</p>";
        }
    }
}
?>

<!-- Fonction pour se déconnecter -->
<?php
function deconnexion()
{
    session_start();
    session_destroy();
    header('Location: /annuaire/index.php');
    exit();
}
?>

<!-- Fonction pour lister toutes les personnes enregistrées -->

<?php
function annuaire()
{
    require(__DIR__ . '/../configs/bootstrap.php');

    $requete = "SELECT * FROM etudiants";

    $stmt = $pdo->prepare($requete);
    $stmt->execute();

    $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($resultat as $resultats) {
        echo '<tr>';
        echo '<td class="px-6 py-4 whitespace-nowrap">' . htmlspecialchars($resultats["nom"]) . '</td>';
        echo '<td class="px-6 py-4 whitespace-nowrap">' . htmlspecialchars($resultats["prenom"]) . '</td>';
        echo '<td class="px-6 py-4 whitespace-nowrap">' . htmlspecialchars($resultats["mail"]) . '</td>';
        echo '<td class="px-6 py-4 whitespace-nowrap">' . htmlspecialchars($resultats["annee"]) . '</td>';
        echo '<td class="px-6 py-4 whitespace-nowrap">' . htmlspecialchars($resultats["spe"]) . '</td>';
        echo '<td class="px-6 py-4 whitespace-nowrap transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300"><a href="./modifierEtudiant.inc.php?id=' . $resultats["id"] . '"><i class="fas fa-edit"></i></a></td>';
        echo '<td class="px-6 py-4 whitespace-nowrap transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300"><a href="./supprimerEtudiant.inc.php?id=' . $resultats["id"] . '"><i class="fas fa-trash"></i></a></td>';
        echo '</tr>';
    }
}
?>

<!-- Fonction qui permet de modifier un étudiant -->
<<?php
function modifierEtudiant()
{
    require_once(__DIR__ . '/../configs/bootstrap.php');

    // Obtenez l'étudiant en utilisant la fonction getEtudiant
    $etudiant = getEtudiant();

    if (isset($_POST['modifier'])) {
        $nouveauPrenom = $_POST['prenom'];
        $nouveauNom = $_POST['nom'];
        $nouveauMail = $_POST['mail'];
        $nouvelleAnnee = $_POST['annee'];
        $nouvelleSpecialite = $_POST['specialite'];

        // Vérifiez si $etudiant est initialisée
        if ($etudiant !== null) {
            $etudiantId = $etudiant['id']; // Obtenez l'ID de l'étudiant
            $requete = "UPDATE etudiants SET prenom = ?, nom = ?, mail = ?, annee = ?, spe = ? WHERE id = ?";
            $stmt = $pdo->prepare($requete);
            $stmt->execute([$nouveauPrenom, $nouveauNom, $nouveauMail, $nouvelleAnnee, $nouvelleSpecialite, $etudiantId]);
        }

        header('Location: ./annuaire.inc.php');
        exit;
    }
}
function getEtudiant()
{
    require_once(__DIR__ . '/../configs/bootstrap.php');

    $etudiant = [];

    if (isset($_GET['id'])) {
        $etudiantId = $_GET['id'];

        $stmt = $pdo->prepare("SELECT * FROM etudiants WHERE id = ?");
        $stmt->execute([$etudiantId]);

        if ($stmt->rowCount() == 1) {
            $etudiant = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            echo "Étudiant non trouvé.";
            exit;
        }
    } else {
        echo "ID d'étudiant non spécifié.";
        exit;
    }

    return $etudiant;
}
?>