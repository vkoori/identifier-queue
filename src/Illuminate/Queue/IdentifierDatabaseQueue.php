<?php

namespace Kooriv\Queue\Illuminate\Queue;

use Illuminate\Queue\DatabaseQueue;

class IdentifierDatabaseQueue extends DatabaseQueue
{
    /**
     * The name of the identifier code the job.
     *
     * @var string|null
     */
    protected ?string $identifier = null;

    /**
     * Set the desired identifier for the job.
     *
     * @param  mixed  $job
     * @return void
     */
    public function setIdentifier($job): void
    {
        if (is_object($job) && method_exists($job, 'getIdentifier')) {
            $this->identifier = $job->getIdentifier();
        }
    }

    /**
     * Push a new job onto the queue.
     *
     * @param  string  $job
     * @param  mixed  $data
     * @param  string|null  $queue
     * @return mixed
     */
    public function push($job, $data = '', $queue = null)
    {
        $this->setIdentifier(job: $job);
        return parent::push(job: $job, data: $data, queue: $queue);
    }

    /**
     * Push a new job onto the queue after (n) seconds.
     *
     * @param  \DateTimeInterface|\DateInterval|int  $delay
     * @param  string  $job
     * @param  mixed  $data
     * @param  string|null  $queue
     * @return void
     */
    public function later($delay, $job, $data = '', $queue = null)
    {
        $this->setIdentifier(job: $job);
        return parent::later(delay: $delay, job: $job, data: $data, queue: $queue);
    }

    /**
     * Push an array of jobs onto the queue.
     *
     * @param  array  $jobs
     * @param  mixed  $data
     * @param  string|null  $queue
     * @return mixed
     */
    public function bulk($jobs, $data = '', $queue = null)
    {
        $queue = $this->getQueue($queue);

        $now = $this->availableAt();

        return $this->database->table($this->table)->insert(collect((array) $jobs)->map(
            function ($job) use ($queue, $data, $now) {
                $this->setIdentifier(job: $job);

                return $this->buildDatabaseRecord(
                    $queue,
                    $this->createPayload($job, $this->getQueue($queue), $data),
                    isset($job->delay) ? $this->availableAt($job->delay) : $now,
                );
            }
        )->all());
    }

    /**
     * Release a reserved job back onto the queue after (n) seconds.
     *
     * @param  string  $queue
     * @param  \Illuminate\Queue\Jobs\DatabaseJobRecord  $job
     * @param  int  $delay
     * @return mixed
     */
    public function release($queue, $job, $delay)
    {
        $this->setIdentifier(job: $job);
        return parent::release(queue: $queue, job: $job, delay: $delay);
    }

    /**
     * Create an array to insert for the given job.
     *
     * @param  string|null  $queue
     * @param  string  $payload
     * @param  int  $availableAt
     * @param  int  $attempts
     * @return array
     */
    protected function buildDatabaseRecord($queue, $payload, $availableAt, $attempts = 0)
    {
        return [
            'queue' => $queue,
            'identifier' => $this->identifier,
            'attempts' => $attempts,
            'reserved_at' => null,
            'available_at' => $availableAt,
            'created_at' => $this->currentTime(),
            'payload' => $payload,
        ];
    }
}
