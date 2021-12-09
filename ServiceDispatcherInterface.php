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

interface ServiceObjectDispatcherInterface
{
    /**
     * Dispatches the Service Object with the following arguments
     *
     * @param array $arguments
     * @throws BadMethodCall if method that needs to be invoked is not defined
     * @return Result
     */
    public function dispatch(array $arguments = []): Result;
}
