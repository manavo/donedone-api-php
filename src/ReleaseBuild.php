<?php

namespace Manavo\DoneDone;

class ReleaseBuild
{

    private $orderNumbers = null;
    private $title = null;
    private $description = null;
    private $emailBody = null;
    private $userIdsToCc = null;

    /**
     * Set issue IDs to include in this release build.
     *
     * Can be an array of IDs, a comma separated list of IDs,
     * or just a single ID.
     *
     * @param array|string|int $ids
     */
    public function setIssueIds($ids)
    {
        if (is_array($ids)) {
            $ids = implode(',', $ids);
        }

        $this->orderNumbers = $ids;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param string $emailBody
     */
    public function setEmailBody($emailBody)
    {
        $this->emailBody = $emailBody;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Set user IDs to CC. Can be an array of IDs, a comma separated list of
     * IDs, or just a single ID.
     *
     * @param array|string|int $ids
     */
//    public function setUserIdsToCc($ids)
//    {
//        if (is_array($ids)) {
//            $ids = implode(',', $ids);
//        }
//
//        $this->userIdsToCc = $ids;
//    }

    /**
     * @return array
     */
    public function toArray()
    {
        $data = [
            'order_numbers' => $this->orderNumbers,
            'title'         => $this->title
        ];

        if ($this->description) {
            $data['description'] = $this->description;
        }

        if ($this->emailBody) {
            $data['email_body'] = $this->emailBody;
        }

        /**
         * Get a 500 error from DoneDone when this is specified, remove for now
         */
//        if ($this->userIdsToCc) {
//            $data['user_ids_to_cc'] = $this->userIdsToCc;
//        }

        return $data;
    }

}
