<?php

namespace Manavo\DoneDone;

class Issue
{
    private $title = null;
    private $priorityLevel = null;
    private $fixer = null;
    private $tester = null;
    private $description = null;
    private $dueDate = null;
    private $attachments = [];
    private $userIdsToCc = null;
    private $tags = null;

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
     * Due date. Accepts Unix timestamp, or a formatted date string.
     *
     * Examples: 2014-09-20 16:40:31, 1411231231
     *
     * @param string|int $dueDate
     */
    public function setDueDate($dueDate)
    {
        if (is_numeric($dueDate)) {
            $dueDate = date('Y-m-d H:i:s', $dueDate);
        }
        $this->dueDate = $dueDate;
    }

    /**
     * Add an attachment to the issue
     *
     * @param string $file
     */
    public function addAttachment($file)
    {
        $this->attachments[] = $file;
    }

    /**
     * Set user IDs to CC. Can be an array of IDs, a comma separated list of
     * IDs, or just a single ID.
     *
     * @param array|string|int $ids
     */
    public function setUserIdsToCc($ids)
    {
        if (is_array($ids)) {
            $ids = implode(',', $ids);
        }

        $this->userIdsToCc = $ids;
    }

    /**
     * Set tags. Can be an array of tags, a comma separated list of
     * tags, or just a single tag.
     *
     * @param array|string $tags
     */
    public function setTags($tags)
    {
        if (is_array($tags)) {
            $tags = implode(',', $tags);
        }

        $this->tags = $tags;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $data = [
            'title'             => $this->title,
            'priority_level_id' => $this->priorityLevel,
            'fixer_id'          => $this->fixer,
            'tester_id'         => $this->tester,
        ];

        if ($this->description) {
            $data['description'] = $this->description;
        }

        if ($this->userIdsToCc) {
            $data['user_ids_to_cc'] = $this->userIdsToCc;
        }

        if ($this->dueDate) {
            $data['due_date'] = $this->dueDate;
        }

        if ($this->tags) {
            $data['tags'] = $this->tags;
        }

        foreach ($this->attachments as $index => $attachment) {
            $data['attachment-' . $index] = fopen($attachment, 'r');
        }

        return $data;
    }

} 