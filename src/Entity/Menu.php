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

    #[ORM\OneToMany(mappedBy: 'menu', targetEntity: MenuImg::class)]
    private $menu;

    public function __construct()
    {
        $this->menu = new ArrayCollection();
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

    /**
     * @return Collection<int, MenuImg>
     */
    public function getMenu(): Collection
    {
        return $this->menu;
    }

    public function addMenu(MenuImg $menu): self
    {
        if (!$this->menu->contains($menu)) {
            $this->menu[] = $menu;
            $menu->setMenu($this);
        }

        return $this;
    }

    public function removeMenu(MenuImg $menu): self
    {
        if ($this->menu->removeElement($menu)) {
            // set the owning side to null (unless already changed)
            if ($menu->getMenu() === $this) {
                $menu->setMenu(null);
            }
        }

        return $this;
    }
}
