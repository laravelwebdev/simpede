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

    private static function hasAccess($roles): bool
    {
        return !empty(array_intersect($roles, session('role')));
    }

    public function get(): bool
    {
        return $this->allowed;
    }

    public function allowedFor(string $roles = 'all'): self
    {
        $this->allowed = $roles === 'all' || self::hasAccess(explode(',', $roles), session('role'));

        return $this;
    }

    public function notAllowedFor(string $roles = 'all'): self
    {
        $this->allowed = ! $this->allowedFor($roles)->allowed;

        return $this;
    }

    public function withYear($year): self
    {
        $this->allowed = $this->allowed && (session('year') == $year);

        return $this;
    }

    public function andEqual($expr1, $expr2, $strict = true): self
    {
        $this->allowed = $this->allowed && ($strict ? $expr1 === $expr2 : $expr1 == $expr2);

        return $this;
    }

    public function andNotEqual($expr1, $expr2, $strict = true): self
    {
        $this->allowed = $this->allowed && ($strict ? $expr1 !== $expr2 : $expr1 != $expr2);

        return $this;
    }

    public function orEqual($expr1, $expr2, $strict = true): self
    {
        $this->allowed = $this->allowed || ($strict ? $expr1 === $expr2 : $expr1 == $expr2);

        return $this;
    }

    public function orNotEqual($expr1, $expr2, $strict = true): self
    {
        $this->allowed = $this->allowed || ($strict ? $expr1 !== $expr2 : $expr1 != $expr2);

        return $this;
    }
}
