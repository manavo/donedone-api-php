<?php

namespace Manavo\DoneDone;

class Issue
{
    private $title = null;
    private $priorityLevel = null;
    private $fixer = null;
    private $tester = null;
    private $description = null;

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param int $fixer
     */
    public function setFixer($fixer)
    {
        $this->fixer = $fixer;
    }

    /**
     * @param int $priorityLevel
     */
    public function setPriorityLevel($priorityLevel)
    {
        $this->priorityLevel = $priorityLevel;
    }

    /**
     * @param int $tester
     */
    public function setTester($tester)
    {
        $this->tester = $tester;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $data = [
            'title' => $this->title,
            'priority_level_id' => $this->priorityLevel,
            'fixer_id' => $this->fixer,
            'tester_id' => $this->tester,
        ];

        if ($this->description) {
            $data['description'] = $this->description;
        }

        return $data;
    }

} 