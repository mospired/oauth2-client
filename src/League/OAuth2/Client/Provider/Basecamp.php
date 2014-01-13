<?php

namespace League\OAuth2\Client\Provider;

class Basecamp extends IdentityProvider
{
    // public $responseType = 'string';

    public function urlAuthorize()
    {
        return 'https://launchpad.37signals.com/authorization/new';
    }

    public function urlAccessToken()
    {
        return 'https://launchpad.37signals.com/authorization/token';
    }

    public function urlUserDetails(\League\OAuth2\Client\Token\AccessToken $token)
    {
        return 'https://launchpad.37signals.com/authorization.json';
    }

    public function userDetails($response, \League\OAuth2\Client\Token\AccessToken $token)
    {
        $user = new User;
        $user->uid = $response->id;
        $user->nickname = $response->login;
        $user->name = isset($response->name) ? $response->name : null;
        $user->email = isset($response->email) ? $response->email : null;
        $user->urls = array(
            'GitHub' => 'http://github.com/'.$user->login,
            'Blog' => $user->blog,
        );

        return $user;
    }
}
