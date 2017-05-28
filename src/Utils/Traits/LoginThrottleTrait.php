<?php

namespace AoTools\Utils\Traits;

use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;

trait LoginThrottleTrait
{

    protected $ip;
    protected $email;
    protected $lockoutTime = 60;
    protected $maxLoginAttempts = 5;

    public function prepareLoginThrottle(Request $request)
    {
        $this->ip = $request->ip();
        $this->email = $request->input('email');
    }

    /**
     * Determine if the user has too many failed login attempts.
     *
     * @return bool
     */
    protected function hasTooManyLoginAttempts()
    {
        return app(RateLimiter::class)->tooManyAttempts($this->email . $this->ip, $this->maxLoginAttempts, $this->lockoutTime / 60);
    }

    /**
     * Increment the login attempts for the user.
     *
     * @return int
     */
    protected function incrementLoginAttempts()
    {
        app(RateLimiter::class)->hit($this->email . $this->ip);
    }

    /**
     * Determine how many retries are left for the user.
     *
     * @return int
     */
    protected function retriesLeft()
    {
        $attempts = app(RateLimiter::class)->attempts($this->email . $this->ip);
        return $this->maxLoginAttempts - $attempts + 1;
    }

    /**
     * Determine how many seconds the user are locked out.
     *
     * @return int $seconds
     */
    protected function sendLockoutResponse()
    {
        return app(RateLimiter::class)->availableIn($this->email . $this->ip);
    }

    /**
     * Clear the login locks for the given user credentials.
     */
    protected function clearLoginAttempts()
    {
        app(RateLimiter::class)->clear($this->email . $this->ip);
    }

}