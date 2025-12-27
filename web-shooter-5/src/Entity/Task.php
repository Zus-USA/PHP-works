<?php

namespace App\Entity;

class Task
{
    private ?int $id = null;
    private string $title = '';
    private bool $completed = false;
    private ?\DateTimeInterface $createdAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = trim($title);
        return $this;
    }

    public function isCompleted(): bool
    {
        return $this->completed;
    }

    public function setCompleted(bool $completed): self
    {
        $this->completed = $completed;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * Получить отформатированную дату создания
     */
    public function getFormattedCreatedAt(): string
    {
        if ($this->createdAt === null) {
            return '';
        }
        
        return $this->createdAt->format('d.m.Y H:i');
    }

    /**
     * Преобразовать в массив для сериализации
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'completed' => $this->completed,
            'created_at' => $this->createdAt?->format('Y-m-d H:i:s'),
        ];
    }

    /**
     * Создать из массива
     */
    public static function fromArray(array $data): self
    {
        $task = new self();
        
        if (isset($data['id'])) {
            $task->setId((int)$data['id']);
        }
        
        if (isset($data['title'])) {
            $task->setTitle($data['title']);
        }
        
        if (isset($data['completed'])) {
            $task->setCompleted((bool)$data['completed']);
        }
        
        if (isset($data['created_at'])) {
            $task->setCreatedAt(
                $data['created_at'] instanceof \DateTimeInterface 
                    ? $data['created_at'] 
                    : new \DateTime($data['created_at'])
            );
        }
        
        return $task;
    }
}

