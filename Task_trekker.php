<?php

class Task1
{
    private string $file = 'task.json';
    protected array $tasks = [];
    const STATUS_IN_PROGRESS = 'не виконано';
    const STATUS_COMPLETED = 'виконано';

    public function __construct()
    {

        $this->tasks = json_decode(file_get_contents($this->file), true);
    }
    public function addTask($taskName, $priority): void
    {
        $this->tasks[] = [
            'name' => $taskName,
            'priority' => $priority,
            'status' => self::STATUS_IN_PROGRESS
        ];

    }
    public function __destruct()
    {
        file_put_contents($this->file, json_encode($this->tasks, JSON_PRETTY_PRINT));
    }

    public function deleteTask($taskId): void
    {
        unset($this->tasks[$taskId]);
    }

    public function getTasks(): array
    {
        return $this->tasks;
    }

    public function completeTask($taskId)
    {
        if (isset($this->tasks[$taskId])) {
            $this->tasks[$taskId]['status'] = self::STATUS_COMPLETED;
            echo "Завдання {$taskId} не виконане" . PHP_EOL;
        } else {
            echo "Завдання {$taskId} виконане" . PHP_EOL;
        }
    }
}

$taskManager = new Task1();
$taskManager->addTask('Відправити ДЗ', 0);
$taskManager->addTask('Послухати урок', 1);
$taskManager->addTask('Занотувати завдання', 2);

echo "Завдання: " . PHP_EOL;
print_r($taskManager->getTasks());

$taskDelete = 1;
$taskManager->deleteTask($taskDelete);

$taskComplete = 1;
$taskManager->completeTask($taskComplete);

echo "Невиконані завдання:" . PHP_EOL;
print_r($taskManager->getTasks());