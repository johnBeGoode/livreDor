<?php
require_once 'class/Message.php';
class GuestBook {

    protected $file;

    public function __construct(string $file) {

        // renvoie le chemin du dossier parent
        $directory = dirname($file);
        // indique si le fichier est un dossier
        if (!is_dir($directory)) {
            // crée un dossier
            mkdir($directory, 0777, true);
        }
        if (!file_exists($file)) {
            // crée un fichier
            touch($file);
        }
        $this->file = $file;
    }

    public function addMessage(Message $message) {
        file_put_contents($this->file, $message->toJSON() . PHP_EOL, FILE_APPEND);
    }

}