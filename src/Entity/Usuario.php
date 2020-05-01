<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsuarioRepository")
 */
class Usuario
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creationDate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Articulo", mappedBy="usuario")
     */
    private $articulos;

    public function __construct()
    {
        $this->articulos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * @return Collection|Articulo[]
     */
    public function getArticulos(): Collection
    {
        return $this->articulos;
    }

    public function addArticulo(Articulo $articulo): self
    {
        if (!$this->articulos->contains($articulo)) {
            $this->articulos[] = $articulo;
            $articulo->setUsuario($this);
        }

        return $this;
    }

    public function removeArticulo(Articulo $articulo): self
    {
        if ($this->articulos->contains($articulo)) {
            $this->articulos->removeElement($articulo);
            // set the owning side to null (unless already changed)
            if ($articulo->getUsuario() === $this) {
                $articulo->setUsuario(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return (string) $this->getUsername();
    }
}
