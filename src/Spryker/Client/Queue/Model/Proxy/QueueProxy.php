<?php

/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\Queue\Model\Proxy;

use Generated\Shared\Transfer\QueueOptionTransfer;
use Generated\Shared\Transfer\QueueMessageTransfer;
use Spryker\Client\Queue\Model\Adapter\AdapterInterface;
use Spryker\Client\Queue\Exception\QueueAdapterMissingException;

class QueueProxy implements QueueProxyInterface
{

    /**
     * @var AdapterInterface
     */
    protected $queueAdapter;

    /**
     * @param AdapterInterface $queueAdapter
     */
    public function __construct(AdapterInterface $queueAdapter)
    {
        $this->queueAdapter = $queueAdapter;
    }

    /**
     * @throws QueueAdapterMissingException
     *
     * @return mixed
     */
    public function open()
    {
        if (!$this->queueAdapter) {
            throw new QueueAdapterMissingException(sprintf('Queue adapter was not found'));
        }

        return $this->queueAdapter->open();
    }

    /**
     * @param QueueOptionTransfer $queueOptionTransfer
     *
     * @return void
     */
    public function createQueue(QueueOptionTransfer $queueOptionTransfer)
    {
        $this->queueAdapter->createQueue($queueOptionTransfer);
    }

    /**
     * @param string $queueName
     * @param callable|null $callback
     * @param QueueOptionTransfer $queueOptionTransfer
     *
     * @return mixed
     */
    public function consume($queueName, callable $callback = null, QueueOptionTransfer $queueOptionTransfer)
    {
        $this->queueAdapter->consume($queueName, $callback, $queueOptionTransfer);
    }

    /**
     * @param QueueMessageTransfer $queueMessageTransfer
     *
     * @return QueueMessageTransfer
     */
    public function encodeMessage(QueueMessageTransfer $queueMessageTransfer)
    {
        $this->queueAdapter->encodeMessage($queueMessageTransfer);
    }

    /**
     * @param QueueMessageTransfer $queueMessageTransfer
     *
     * @return QueueMessageTransfer
     */
    public function decodeMessage(QueueMessageTransfer $queueMessageTransfer)
    {
        $this->queueAdapter->decodeMessage($queueMessageTransfer);
    }

    /**
     * @param QueueMessageTransfer $queueMessageTransfer
     *
     * @return void
     */
    public function acknowledge(QueueMessageTransfer $queueMessageTransfer)
    {
        $this->queueAdapter->acknowledge($queueMessageTransfer);
    }

    /**
     * @param QueueMessageTransfer $queueMessageTransfer
     *
     * @return void
     */
    public function publish(QueueMessageTransfer $queueMessageTransfer)
    {
        $this->queueAdapter->publish($queueMessageTransfer);
    }

    /**
     * @return bool
     */
    public function close()
    {
        return $this->queueAdapter->close();
    }
}
