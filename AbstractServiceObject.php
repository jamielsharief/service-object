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

use BadMethodCallException;

abstract class AbstractServiceObject implements ServiceObjectDispatcherInterface
{
    /**
     * Dispatches this Service Object with an array of arguments
     *
     * @param array $arguments
     * @return Result
     */
    public function dispatch(array $arguments = []): Result
    {
        if (! method_exists($this, 'execute')) {
            throw new BadMethodCallException(sprintf('Service Object `%s` does not have execute method', get_class($this)));
        }

        return call_user_func_array([$this, 'execute'], $arguments);
    }
}
