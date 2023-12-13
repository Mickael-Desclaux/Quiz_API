<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Text = null;

    #[ORM\ManyToOne(inversedBy: 'questions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $CategoryID = null;

    #[ORM\OneToMany(mappedBy: 'QuestionID', targetEntity: Answer::class)]
    private Collection $answers;

    #[ORM\ManyToOne(inversedBy: 'questions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Difficulty $DifficultyID = null;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
    }

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

    public function getCategoryID(): ?Category
    {
        return $this->CategoryID;
    }

    public function setCategoryID(?Category $CategoryID): static
    {
        $this->CategoryID = $CategoryID;

        return $this;
    }

    /**
     * @return Collection<int, Answer>
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answer $answer): static
    {
        if (!$this->answers->contains($answer)) {
            $this->answers->add($answer);
            $answer->setQuestionID($this);
        }

        return $this;
    }

    public function removeAnswer(Answer $answer): static
    {
        if ($this->answers->removeElement($answer)) {
            // set the owning side to null (unless already changed)
            if ($answer->getQuestionID() === $this) {
                $answer->setQuestionID(null);
            }
        }

        return $this;
    }

    public function getDifficultyID(): ?Difficulty
    {
        return $this->DifficultyID;
    }

    public function setDifficultyID(?Difficulty $DifficultyID): static
    {
        $this->DifficultyID = $DifficultyID;

        return $this;
    }
}
