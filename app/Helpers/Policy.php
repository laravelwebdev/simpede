<?php

namespace App\Helpers;

class Policy
{
    private bool $allowed = false;

    /**
     * Create a new element.
     *
     * @return static
     */
    public static function make()
    {
        return new static;
    }

    /**
     * Check if the user has access based on roles.
     *
     * @param array $roles
     * @return bool
     */
    private static function hasAccess($roles): bool
    {
        return ! empty(array_intersect($roles, session('role')));
    }

    /**
     * Get the current access status.
     *
     * @return bool
     */
    public function get(): bool
    {
        return $this->allowed;
    }

    /**
     * Set access allowed for specific roles.
     *
     * @param string $roles
     * @return self
     */
    public function allowedFor(string $roles = 'all'): self
    {
        $this->allowed = $roles === 'all' || self::hasAccess(explode(',', $roles), session('role'));

        return $this;
    }

    /**
     * Set access not allowed for specific roles.
     *
     * @param string $roles
     * @return self
     */
    public function notAllowedFor(string $roles = 'all'): self
    {
        $this->allowed = $roles !== 'all' && self::hasAccess(array_diff(array_keys(Helper::ROLE), explode(',', $roles)), session('role'));

        return $this;
    }

    /**
     * Set access allowed for a specific year.
     *
     * @param mixed $year
     * @return self
     */
    public function withYear($year): self
    {
        $this->allowed = $this->allowed && (session('year') == $year);

        return $this;
    }

    /**
     * Set access allowed if two expressions are equal.
     *
     * @param mixed $expr1
     * @param mixed $expr2
     * @param bool $strict
     * @return self
     */
    public function andEqual($expr1, $expr2, $strict = true): self
    {
        $this->allowed = $this->allowed && ($strict ? $expr1 === $expr2 : $expr1 == $expr2);

        return $this;
    }

    /**
     * Set access allowed if two expressions are not equal.
     *
     * @param mixed $expr1
     * @param mixed $expr2
     * @param bool $strict
     * @return self
     */
    public function andNotEqual($expr1, $expr2, $strict = true): self
    {
        $this->allowed = $this->allowed && ($strict ? $expr1 !== $expr2 : $expr1 != $expr2);

        return $this;
    }

    /**
     * Set access allowed if either of two expressions are equal.
     *
     * @param mixed $expr1
     * @param mixed $expr2
     * @param bool $strict
     * @return self
     */
    public function orEqual($expr1, $expr2, $strict = true): self
    {
        $this->allowed = $this->allowed || ($strict ? $expr1 === $expr2 : $expr1 == $expr2);

        return $this;
    }

    /**
     * Set access allowed if either of two expressions are not equal.
     *
     * @param mixed $expr1
     * @param mixed $expr2
     * @param bool $strict
     * @return self
     */
    public function orNotEqual($expr1, $expr2, $strict = true): self
    {
        $this->allowed = $this->allowed || ($strict ? $expr1 !== $expr2 : $expr1 != $expr2);

        return $this;
    }
}
