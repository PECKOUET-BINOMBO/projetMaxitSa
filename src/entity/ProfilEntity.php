<?php
namespace App\Src\Entity;

use App\Core\Abstract\AbstractEntity;

class ProfilEntity extends AbstractEntity{
   private int $id;
   private string $libelle;
   private array $users;


   public function __construct(int $id = 0, string $libelle = "") {
       $this->id = $id;
       $this->libelle = $libelle;
       $this->users = [];
   }

   public function getId(): int {
       return $this->id;
   }

   public function setId(int $id): void {
       $this->id = $id;
   }

    public function getLibelle(): string {
         return $this->libelle;
    }
    public function setLibelle(string $libelle): void {
        $this->libelle = $libelle;
    }

    public function getUsers(): array {
        return $this->users;
    }

    public function addUser(UserEntity $user): void {
        $this->users[] = $user;
    }

    public static function toObject(array $data): static 
    {
        return new static(
            $data['id'] ?? 0,
            $data['libelle'] ?? ""
        );
    }

    public  function toArray(object $data): array
    {
        return [
            'id' => $this->getId(),
            'libelle' => $this->getLibelle(),
        ];
    }

}