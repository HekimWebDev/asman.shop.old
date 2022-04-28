<?php

namespace App\Services\LogoTiger;

class Response
{
    protected $response;
    protected $body;
    protected $data;
    protected $dto;

    public function __construct($response, string $dto = null)
    {
        $this->response = $response;
        $this->body = $this->response->getBody();
        $this->data = $this->parseBody();
        $this->dto = $dto;
    }

    private function parseBody()
    {
        return json_decode(
            $this->response->getBody(), true, 512, JSON_BIGINT_AS_STRING
        );
    }

    public function parsed()
    {
        return $this->data;
    }

    public function raw()
    {
        return $this->response->getBody();
    }

    public function self()
    {
        return $this->response;
    }

    public function asCollection()
    {
        return collect($this->data);
    }

    public function toDto() : self
    {
        if ($this->dto) {
            $this->data = array_map(
                fn (array $data) => new $this->dto(...$data),
                $this->data
            );
        }

        return $this;
    }
}
