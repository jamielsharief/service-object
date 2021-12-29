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
abstract class AbstractServiceObject
{
    private array $args = [];

    /**
     * Returns a new instance with the args set to be called when dispatched
     *
     * @param array $args
     * @return static
     */
    public function withArguments(array $args): self
    {
        $service = clone $this;
        $service->args = $args;

        return $service;
    }

    /**
     * Returns a new instance with the args set as Params and an empty result
     *
     * @param Params $params
     * @return static
     */
    public function withParams(Params $params): self
    {
        return $this->withArguments([$params,$this->createResult()]);
    }

    /**
     * Runs the Service by executing the service object with the arguments that were set withArguments or withParams
     *
     * @return Result
     */
    public function run(): Result
    {
        return call_user_func_array([$this,'execute'], $this->args);
    }

    /**
     * Make this a callable
     *
     * @return Result
     */
    public function __invoke(): Result
    {
        return $this->run();
    }

    /**
     * Factory method
     *
     * @internal in this case it should be available to user, so protected is used rather than private
     *
     * @param boolean $success
     * @param array $data
     * @return Result
     */
    protected function createResult(bool $success = true, array $data = []): Result
    {
        return new Result($success, $data);
    }
}
