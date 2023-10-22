<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Video
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */


namespace Twilio\Rest\Video\V1\Room\Participant;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Values;
use Twilio\Version;
use Twilio\Deserialize;


/**
 * @property string|null $sid
 * @property string|null $roomSid
 * @property string|null $accountSid
 * @property string $status
 * @property string|null $identity
 * @property \DateTime|null $dateCreated
 * @property \DateTime|null $dateUpdated
 * @property \DateTime|null $startTime
 * @property \DateTime|null $endTime
 * @property int|null $duration
 * @property string|null $url
 */
class AnonymizeInstance extends InstanceResource
{
    /**
     * Initialize the AnonymizeInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $roomSid The SID of the room with the participant to update.
     * @param string $sid The SID of the RoomParticipant resource to update.
     */
    public function __construct(Version $version, array $payload, string $roomSid, string $sid)
    {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = [
            'sid' => Values::array_get($payload, 'sid'),
            'roomSid' => Values::array_get($payload, 'room_sid'),
            'accountSid' => Values::array_get($payload, 'account_sid'),
            'status' => Values::array_get($payload, 'status'),
            'identity' => Values::array_get($payload, 'identity'),
            'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')),
            'dateUpdated' => Deserialize::dateTime(Values::array_get($payload, 'date_updated')),
            'startTime' => Deserialize::dateTime(Values::array_get($payload, 'start_time')),
            'endTime' => Deserialize::dateTime(Values::array_get($payload, 'end_time')),
            'duration' => Values::array_get($payload, 'duration'),
            'url' => Values::array_get($payload, 'url'),
        ];

        $this->solution = ['roomSid' => $roomSid, 'sid' => $sid, ];
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return AnonymizeContext Context for this AnonymizeInstance
     */
    protected function proxy(): AnonymizeContext
    {
        if (!$this->context) {
            $this->context = new AnonymizeContext(
                $this->version,
                $this->solution['roomSid'],
                $this->solution['sid']
            );
        }

        return $this->context;
    }

    /**
     * Update the AnonymizeInstance
     *
     * @return AnonymizeInstance Updated AnonymizeInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(): AnonymizeInstance
    {

        return $this->proxy()->update();
    }

    /**
     * Magic getter to access properties
     *
     * @param string $name Property to access
     * @return mixed The requested property
     * @throws TwilioException For unknown properties
     */
    public function __get(string $name)
    {
        if (\array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }

        if (\property_exists($this, '_' . $name)) {
            $method = 'get' . \ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown property: ' . $name);
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        $context = [];
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Video.V1.AnonymizeInstance ' . \implode(' ', $context) . ']';
    }
}
