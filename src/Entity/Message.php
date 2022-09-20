<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $content_message;

    #[ORM\Column(type: 'datetime_immutable')]
    private $sent_at;

    #[ORM\Column(type: 'datetime_immutable')]
    private $read_at;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'user_message')]
    private $user;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'received_messages')]
    #[ORM\JoinColumn(nullable: false)]
    private $receiver;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContentMessage(): ?string
    {
        return $this->content_message;
    }

    public function setContentMessage(string $content_message): self
    {
        $this->content_message = $content_message;

        return $this;
    }

    public function getSentAt(): ?\DateTimeImmutable
    {
        return $this->sent_at;
    }

    public function setSentAt(\DateTimeImmutable $sent_at): self
    {
        $this->sent_at = $sent_at;

        return $this;
    }

    public function getReadAt(): ?\DateTimeImmutable
    {
        return $this->read_at;
    }

    public function setReadAt(\DateTimeImmutable $read_at): self
    {
        $this->read_at = $read_at;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getReceiver(): ?User
    {
        return $this->receiver;
    }

    public function setReceiver(?User $receiver): self
    {
        $this->receiver = $receiver;

        return $this;
    }
}
