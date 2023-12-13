<?php

namespace App\Entity;

use App\Repository\AnswerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnswerRepository::class)]
class Answer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Text = null;

    #[ORM\Column]
    private ?bool $IsCorrect = null;

    #[ORM\ManyToOne(inversedBy: 'answers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Question $QuestionID = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->Text;
    }

    public function setText(string $Text): static
    {
        $this->Text = $Text;

        return $this;
    }

    public function isIsCorrect(): ?bool
    {
        return $this->IsCorrect;
    }

    public function setIsCorrect(bool $IsCorrect): static
    {
        $this->IsCorrect = $IsCorrect;

        return $this;
    }

    public function getQuestionID(): ?Question
    {
        return $this->QuestionID;
    }

    public function setQuestionID(?Question $QuestionID): static
    {
        $this->QuestionID = $QuestionID;

        return $this;
    }
}
