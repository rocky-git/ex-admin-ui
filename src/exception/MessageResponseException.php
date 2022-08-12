<?php
namespace ExAdmin\ui\exception;
use ExAdmin\ui\response\Message;
use RuntimeException;
class MessageResponseException extends RuntimeException
{
    /**
     * The underlying response instance.
     *
     * @var Message
     */
    protected $response;

    /**
     * Create a new HTTP response exception instance.
     *
     * @param Message $response
     * @return void
     */
    public function __construct(Message $response)
    {
        $this->response = $response;
    }

    /**
     * Get the underlying response instance.
     *
     * @return Message
     */
    public function getResponse()
    {
        return $this->response;
    }
}