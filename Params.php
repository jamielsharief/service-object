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

use Lightning\ServiceObject\Exception\UnknownParameterException;

class Params
{
    /**
     * Container data
     *
     * @var array
     */
    protected array $data = [];

    /**
     * Constructor
     *
     * @param array $data data to set
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * Checks if a parameter exists
     *
     * @param string $name
     * @return boolean
     */
    public function has(string $name): bool
    {
        return array_key_exists($name, $this->data);
    }

    /**
     * Gets the state
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->data;
    }

    /**
     * Gets a param
     *
     * @param string $name
     * @throws UnkownParameterException
     * @return mixed
     */
    public function get(string $name)
    {
        if (! isset($this->data[$name])) {
            throw new UnknownParameterException(sprintf('Unkown parameter `%s`', $name));
        }

        return $this->data[$name];
    }

    /**
     * Set a value of a param
     *
     * @param array $data
     *
     * @return self
     */
    public function set(string $name, $value): self
    {
        $this->data[$name] = $value;

        return $this;
    }

    /**
     * Unset a param
     *
     * @param string $name
     * @return self
     */
    public function unset(string $name): self
    {
        unset($this->data[$name]);

        return $this;
    }
}
