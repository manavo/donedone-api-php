<?php

namespace Manavo\DoneDone;

class Comment
{

    /**
     * @var string
     */
    private $message = null;

    /**
     * @var array
     */
    private $attachments = [];

    /**
     * @param string $attachment
     */
    public function addAttachment($attachment)
    {
        $this->attachments[] = $attachment;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $data = [
            'comment' => $this->message,
        ];

        foreach ($this->attachments as $index => $attachment) {
            $data['attachment-' . $index] = fopen($attachment, 'r');
        }

        return $data;
    }

}
