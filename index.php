<?php
require_once 'class/Message.php';
require_once 'class/GuestBook.php';

$errors = null;
$success = false;
if (isset($_POST['username'], $_POST['message'])) {
    $message = new Message($_POST['username'], $_POST['message']);
    if ($message->isValid()) {
        // lien vers le fichier qui contiendra nos messages
        $guestBook = new GuestBook(__DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'messages');
        $guestBook->addMessage($message);
        $success = true;
        $_POST = []; 
    } else {
        $errors = $message->getErrors();
    }
}
$title = 'Livre d\'or';
require 'elements/header.php';
?>
<div class="container">
    <h1>Livre d'or</h1>

    <?php if (!empty($errors)) { ?>
            <div class="alert alert-danger">
                Formulaire invalide
            </div>
    <?php } ?>

    <?php if ($success) { ?>
            <div class="alert alert-success">
                Merci pour votre message !!
            </div>
    <?php } ?>

    <form action="" method="post">
        <div class="form-group">
            <input value="<?= htmlentities($_POST['username'] ?? '') ?>" type="text" name="username" placeholder="Votre pseudo" class="form-control <?= isset($errors['username']) ? 'is-invalid' : '' ?>">
            <?php if (isset($errors['username'])) { ?>
                        <div class="invalid-feedback">
                            <?= $errors['username'] ?>
                        </div>
            <?php } ?>
        </div>
        <div class="form-group">
            <textarea name="message" id="" cols="30" rows="10" placeholder="Votre message" class="form-control <?= isset($errors['message']) ? 'is-invalid' : '' ?>"><?= htmlentities($_POST['message'] ?? '') ?></textarea>
            <?php if (isset($errors['message'])) { ?>
                        <div class="invalid-feedback">
                            <?= $errors['message'] ?>
                        </div>
            <?php } ?> 
        </div>
        <button class="btn btn-primary">Envoyer</button>
    </form>
</div>

<?php require 'elements/footer.php' ?>
<?php unset($success) ?>