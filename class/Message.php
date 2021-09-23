<?php
class Message
{

    const LIMIT_USERNAME = 3;
    const LIMIT_MESSAGE = 10;
    protected $username;
    protected $message;
    protected $date;

    public function __construct(string $username, string $message, ?DateTime $date = null)
    {
        $this->username = $username;
        $this->message = $message;
        $this->date = $date ?: new DateTime();
    }

    public function isValid(): bool
    {
        // Si le tab d'erreurs est vide alors le msg est valide
        return empty($this->getErrors());
    }

    public function getErrors(): array
    {
        $errors = [];
        if (strlen($this->username) < self::LIMIT_USERNAME) {
            $errors['username'] = 'Votre pseudo est trop court';
        }
        if (strlen($this->message) < Self::LIMIT_MESSAGE) {
            $errors['message'] = 'Votre message est trop court';
        }
        return $errors;
    }

    public function toJSON(): string
    {
        // convertit le message (objet) en chaine de caractère
        return json_encode([
            'username' => $this->username,
            'message' => $this->message,
            'date' => $this->date->getTimestamp()
        ]);
    }
}
