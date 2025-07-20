<?php
namespace App\Src\Entity;

use App\Core\Abstract\AbstractEntity;

class UserEntity extends AbstractEntity {
    private int $id;
    private string $nom;
    private string $prenom;
    // private string $login;
    private string $password;
    private array $comptes;
    private string $photo_recto_cni;
    private string $photo_verso_cni;
    private string $numero_cni;
    private ProfilEntity $profil_id;

    public function __construct(
        int $id = 0,
        string $nom = "",
        string $prenom = "",
        // string $login = "",
        string $password = "",
        string $photo_recto_cni = "",
        string $photo_verso_cni = "",
        string $numero_cni = ""
    ) {
        $this->id = $id;
        $this->nom = $nom;
        $this->numero_cni = $numero_cni;
        // $this->login = $login;
        $this->comptes = [];
        $this->photo_recto_cni = $photo_recto_cni;
        $this->photo_verso_cni = $photo_verso_cni;
        $this->profil_id = new ProfilEntity();
        $this->password = $password;
        $this->prenom = $prenom;
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }

    // public function getLogin(): string
    // {
    //     return $this->login;
    // }

    // public function setLogin(string $login): void
    // {
    //     $this->login = $login;
    // }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getComptes(): array
    {
        return $this->comptes;
    }

    public function addCompte(CompteEntity $compte): void
    {
        $this->comptes[] = $compte;
    }

    public function getPhotoRecto(): string
    {
        return $this->photo_recto_cni;
    }

    public function setPhotoRecto(string $photo_recto_cni): void
    {
        $this->photo_recto_cni = $photo_recto_cni;
    }

    public function getPhotoVerso(): string
    {
        return $this->photo_verso_cni;
    }

    public function setPhotoVerso(string $photo_verso_cni): void
    {
        $this->photo_verso_cni = $photo_verso_cni;
    }

    public function getNumeroIdentite(): string
    {
        return $this->numero_cni;
    }

    public function setNumeroIdentite(string $numero_cni): void
    {
        $this->numero_cni = $numero_cni;
    }

    public function getProfil(): ProfilEntity
    {
        return $this->profil_id;
    }

    public function setProfil(ProfilEntity $profil_id): void
    {
        $this->profil_id = $profil_id;
    }

    public static function toObject(array $array): static
    {
        return new static(
            $array['id'],
            $array['nom'],
            // $array['login'],
            $array['password'],
            $array['prenom'],
            $array['photo_recto_cni'],
            $array['photo_verso_cni'],
            $array['numero_cni'],


        );


    }

    public  function toArray(object $data): array
    {
        return [
            'id' => $this->getId(),
            'nom' => $this->getNom(),
            'prenom' => $this->getPrenom(),
            // 'login' => $this->getLogin(),
            'password' => $this->getPassword(),
            'comptes' => array_map(fn($compte) => $compte->toArray(), $this->getComptes()),
            'photo_recto_cni' => $this->getPhotoRecto(),
            'photo_verso_cni' => $this->getPhotoVerso(),
            'numero_cni' => $this->getNumeroIdentite(),
        ];
    }
}