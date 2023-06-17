<?php

namespace Kooriv\Queue\Illuminate\Bus\Trait;

trait IdentifierCode
{
    /**
     * The name of the identifier code the job should be sent to.
     *
     * @var string|null
     */
    private ?string $identifier = null;

    /**
     * Set the desired identifier for the job.
     *
     * @param  string  $identifier
     * @return $this
     */
    public function setIdentifier(string $identifier): static
    {
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * Get the desired identifier for the job.
     *
     * @return string|null
     */
    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }
}
