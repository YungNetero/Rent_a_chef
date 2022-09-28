<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
class Menu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $menu_name;

    #[ORM\Column(type: 'string', length: 100)]
    private $price_menu;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[ORM\ManyToOne(targetEntity: MenuCategory::class, inversedBy: 'menus')]
    #[ORM\JoinColumn(nullable: false)]
    private $category;

    #[ORM\Column(type: 'string', length: 255)]
    private $starter;

    #[ORM\Column(type: 'string', length: 255)]
    private $main;

    #[ORM\Column(type: 'string', length: 255)]
    private $dessert;

    #[ORM\Column(type: 'string', length: 50)]
    private $img1;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $img2;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $img3;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMenuName(): ?string
    {
        return $this->menu_name;
    }

    public function setMenuName(string $menu_name): self
    {
        $this->menu_name = $menu_name;

        return $this;
    }

    public function getPriceMenu(): ?string
    {
        return $this->price_menu;
    }

    public function setPriceMenu(string $price_menu): self
    {
        $this->price_menu = $price_menu;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCategory(): ?MenuCategory
    {
        return $this->category;
    }

    public function setCategory(?MenuCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getStarter(): ?string
    {
        return $this->starter;
    }

    public function setStarter(string $starter): self
    {
        $this->starter = $starter;

        return $this;
    }

    public function getMain(): ?string
    {
        return $this->main;
    }

    public function setMain(string $main): self
    {
        $this->main = $main;

        return $this;
    }

    public function getDessert(): ?string
    {
        return $this->dessert;
    }

    public function setDessert(string $dessert): self
    {
        $this->dessert = $dessert;

        return $this;
    }

    public function getImg1(): ?string
    {
        return $this->img1;
    }

    public function setImg1(string $img1): self
    {
        $this->img1 = $img1;

        return $this;
    }

    public function getImg2(): ?string
    {
        return $this->img2;
    }

    public function setImg2(?string $img2): self
    {
        $this->img2 = $img2;

        return $this;
    }

    public function getImg3(): ?string
    {
        return $this->img3;
    }

    public function setImg3(?string $img3): self
    {
        $this->img3 = $img3;

        return $this;
    }

}
