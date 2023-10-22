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
function nombrePage($itemsPerPage = 10)
{
    require(__DIR__ . '/../configs/bootstrap.php');
    $requeteCount = "SELECT COUNT(*) as total FROM etudiants";
    $stmtCount = $pdo->prepare($requeteCount);
    $stmtCount->execute();
    $totalItems = $stmtCount->fetch(PDO::FETCH_ASSOC)['total'];

    if ($totalItems > 0) {
        $totalPages = ceil($totalItems / $itemsPerPage);
    } else {
        $totalPages = 1;
    }

    return $totalPages;
}
function annuaire($page)
{
    require(__DIR__ . '/../configs/bootstrap.php');

    $itemsPerPage = 10;

    $offset = ($page - 1) * $itemsPerPage;

    $requete = "SELECT * FROM etudiants LIMIT $itemsPerPage OFFSET $offset";

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

<!-- Fonction de pour rechercher un étudiant -->
<?php
function recherche()
{
    require('./configs/bootstrap.php');
    $resultat = [];

    if (isset($_GET["etudiant"])) {
        $etudiant = '%' . $_GET["etudiant"] . '%';

        $requete = "SELECT * FROM etudiants WHERE nom LIKE :etudiant OR prenom LIKE :etudiant";

        $stmt = $pdo->prepare($requete);
        $stmt->bindParam(':etudiant', $etudiant, PDO::PARAM_STR);
        $stmt->execute();

        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return $resultat;
}
?>
