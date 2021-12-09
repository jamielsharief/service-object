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
 * An interface for a Generic implemenation
 */
interface ServiceObjectInterface
{
    /**
     * Executes the service
     *
     * @param Params $params
     * @return Result
     */
    public function execute(Params $params): Result;
}
