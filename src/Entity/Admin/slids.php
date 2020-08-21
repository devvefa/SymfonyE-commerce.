<?php

namespace App\Entity\Admin;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Admin\slidsRepository")
 */
class slids
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $links;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imgs;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $header;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $paragraf;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLinks(): ?string
    {
        return $this->links;
    }

    public function setLinks(?string $links): self
    {
        $this->links = $links;

        return $this;
    }

    public function getImgs(): ?string
    {
        return $this->imgs;
    }

    public function setImgs(?string $imgs): self
    {
        $this->imgs = $imgs;

        return $this;
    }

    public function getHeader(): ?string
    {
        return $this->header;
    }

    public function setHeader(?string $header): self
    {
        $this->header = $header;

        return $this;
    }

    public function getParagraf(): ?string
    {
        return $this->paragraf;
    }

    public function setParagraf(?string $paragraf): self
    {
        $this->paragraf = $paragraf;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
