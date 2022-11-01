<?php
namespace publishing\contentsubscriptions\models;

use craft\base\Model;

class SubscriptionModel extends Model
{
    public int $id;
    public int $groupId;
    public string $firstName;
    public string $lastName;
    public string $email;
    public bool $verificationStatus = false;
    public string $hashValue;
    public bool $enabled;
    public \DateTime $dateCreated;
    public \DateTime $dateUpdated;
    public string $uid;

    public function getDateCreated()
    {
        if (!isset($this->dateCreated))
            $this->dateCreated = new \DateTime('now');
        return $this->dateCreated;
    }

    public function getDateUpdated()
    {
        if (!isset($this->dateUpdated))
            $this->dateUpdated = new \DateTime('now');
        return $this->dateUpdated;
    }

    public function generateHash()
    {
        $this->hashValue = hash('sha256', $this->getDateCreated()->format('Y-m-d H:i:s') . $this->email);
    }

    public function getFormProperties($id)
    {
        return [
            'id' => $id,
            'fieldTypes' => [
                'firstName' => 'string',
                'lastName' => 'string',
                'email' => 'string',
            ]
        ];
    }

    public function getAvailableTags()
    {
        return [
            'firstName', 'lastName', 'email'
        ];
    }
}