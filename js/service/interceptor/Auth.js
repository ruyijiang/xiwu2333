/**
 * Created by mazih on 2016/6/22.
 */
app.factory('Auth', function ($cookieStore,ACCESS_LEVELS){
    var _user = $cookieStore.get("user");

    var setUser = function(user){
        if (!user.role || user.role < 0){
            user.role = ACCESS_LEVELS.pub;
        }
        _user = user;
        $cookieStore.put("user",_user);
    };

    return {
        isAuthorized : function (lvl){
            return _user.role >= lvl;
        },
        setUser : serUser,
        isLoggedIn : function (){
            return _user ? true : false;
        },
        getUser : function (){
            return _user;
        },
        getId : function (){
            return _user?_user.token : '';
        },
        getToken : function (){
            return _user ? _user.token : '';
        },
        logout : function (){
            $cookieStore.remove('user');
            _user = null;
        }
    }

});