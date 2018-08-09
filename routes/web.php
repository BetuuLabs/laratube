<?php 


/**
 * Route URI's
 */
Route::group(['prefix' => config('laratube.routes.prefix')], function() {

    /**
     * Authentication
     */
    Route::get(config('laratube.routes.authentication_uri'), function()
    {
        return redirect()->to(Laratube::createAuthUrl());
    });

    /**
     * Redirect
     */
    Route::get(config('laratube.routes.redirect_uri'), function(Illuminate\Http\Request $request)
    {
        if(!$request->has('code')) {
            throw new Exception('$_GET[\'code\'] is not set. Please re-authenticate.');
        }

        $token = Laratube::authenticate($request->get('code'));

        Laratube::saveAccessTokenToDB($token);

        return redirect(config('laratube.routes.redirect_back_uri', '/'));
    });

});