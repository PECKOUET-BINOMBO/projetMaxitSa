<?php

namespace App\Src\Entity;

use App\Core\Abstract\AbstractEntity;

class CompteEntity extends AbstractEntity{
    private int $id;
    private float $solde;
    private UserEntity $user;
    private string $telephone;
    private string $type;


    public function __construct(int $id = 0, float $solde = 0.0, string $telephone = "", string $type = "")
    {
        $this->id = $id;
        $this->solde = $solde;
        $this->user = new UserEntity();
        $this->telephone = $telephone;
        $this->type = $type;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getSolde(): float
    {
        return $this->solde;
    }
    public function setSolde(float $solde): void
    {
        $this->solde = $solde;
    }   

    public function getUser(): UserEntity
    {
        return $this->user;
    }

    public function setUser(UserEntity $user): void
    {
        $this->user = $user;
    }

    public function getTelephone(): string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): void
    {
        $this->telephone = $telephone;
    }

    public function getType(): string
    {
        return $this->type;
    }
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    


    public static function toObject(array $data): CompteEntity
    {
        return new static(
            $data['id'] ?? 0,
            $data['solde'] ?? 0.0,
            $data['telephone'] ?? "",
            $data['type'] ?? ""
        );
    }

    public function toArray(object $data): array
    {
        return [
            'id' => $this->getId(),
            'solde' => $this->getSolde(),
            'telephone' => $this->getTelephone(),
            'type' => $this->getType(),
        ];
    }

}

