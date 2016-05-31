/**
 * Created by mazih on 2016/5/31.
 */

angular.module('myApp',[])
    .directive("InvitationCode", function() {
        return {
            restrict : 'E',
            templateUrl: SERVER_BASE + 'InvitationCodeModal.html'
        };
    });