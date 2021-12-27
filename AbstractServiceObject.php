<?php declare(strict_types=1);
/**
 * LightningPHP
 * Copyright 2021 Jamiel Sharief.
 *
 * Licensed under The MIT License
 * The above copyright notice and this permission notice shall be included in all copies or substantial
 * portions of the Software.
 *
 * @copyright   Copyright (c) Jamiel Sharief
 * @license     https://opensource.org/licenses/mit-license.php MIT License
 */

namespace Lightning\ServiceObject;

/**
 * Service Object
 *
 * Command Pattern: "an object is used to encapsulate all information needed to perform an action or trigger an event"
 *
 */
abstract class AbstractServiceObject implements ServiceObjectInterface
{
    /**
     * Params
     *
     * @var Params|null
     */
    protected ?Params $params = null;

    /**
     * Sets the params on this instance
     *
     * @param Params $params
     * @return self
     */
    public function setParams(Params $params): self
    {
        $this->params = $params;

        return $this;
    }

    /**
     * Returns an instance with the params set
     *
     * @param Params $params
     * @return self
     */
    public function withParams(Params $params): self
    {
        return (clone $this)->setParams($params);
    }

    /**
     * Executes the Service Object
     *
     * @return Result
     */
    abstract public function execute(): Result;

    /**
     * Make this a callable
     *
     * @return Result
     */
    public function __invoke(): Result
    {
        return $this->execute();
    }
}
