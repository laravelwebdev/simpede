<?php

namespace App\Helpers;

class Policy
{
    private bool $allowed;

    /**
     * Create a new element.
     *
     * @return static
     */
    public static function make()
    {
        return new static;
    }

    public function get()
    {
        return $this->allowed;
    }

    public function allowedFor(string $roles = 'all')
    {
        if ($roles === 'all') {
            $this->allowed = true;
        } else {
            $allowedroles = explode(',', $roles);
            $this->allowed = in_array(session('role'), $allowedroles);
        }

        return $this;
    }

    public function notAllowedFor(string $roles = 'all')
    {
        $this->allowed = ! $this->allowedFor($roles);

        return $this;
    }

    public function withYear($year)
    {
        $this->allowed = $this->allowed ?? true && (session('year') == $year);

        return $this;
    }

    public function andEqual($expr1, $expr2, $strict = true)
    {
        $this->allowed = $this->allowed ?? true && $strict ? $expr1 === $expr2 : $expr1 == $expr2;

        return $this;
    }

    public function andNotEqual($expr1, $expr2, $strict = true)
    {
        $this->allowed = $this->allowed ?? true && $strict ? $expr1 !== $expr2 : $expr1 != $expr2;

        return $this;
    }

    public function orEqual($expr1, $expr2, $strict = true)
    {
        $this->allowed = $this->allowed ?? false || $strict ? $expr1 === $expr2 : $expr1 == $expr2;

        return $this;
    }

    public function orNotEqual($expr1, $expr2, $strict = true)
    {
        $this->allowed = $this->allowed ?? false || $strict ? $expr1 !== $expr2 : $expr1 != $expr2;

        return $this;
    }
}
