<?php

namespace App\Entity;

use App\Repository\DifficultyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DifficultyRepository::class)]
class Difficulty
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $DifficultyLevel = null;

    #[ORM\OneToMany(mappedBy: 'DifficultyID', targetEntity: Question::class)]
    private Collection $questions;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDifficultyLevel(): ?string
    {
        return $this->DifficultyLevel;
    }

    public function setDifficultyLevel(string $DifficultyLevel): static
    {
        $this->DifficultyLevel = $DifficultyLevel;

        return $this;
    }

    /**
     * @return Collection<int, Question>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): static
    {
        if (!$this->questions->contains($question)) {
            $this->questions->add($question);
            $question->setDifficultyID($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): static
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getDifficultyID() === $this) {
                $question->setDifficultyID(null);
            }
        }

        return $this;
    }
}
