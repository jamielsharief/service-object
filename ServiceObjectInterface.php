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

interface ServiceObjectInterface
{
    /**
     * Sets the params on this instance
     *
     * @param Params $params
     * @return self
     */
    public function setParams(Params $params): self;

    /**
     * Returns an instance with the params set
     *
     * @param Params $params
     * @return self
     */
    public function withParams(Params $params): self;

    /**
     * Executes the Service Object
     *
     * @return Result
     */
    public function execute(): Result;
}
