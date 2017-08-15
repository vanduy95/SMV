(function(){

    var pusher = new Pusher('8b7e5da2d7018d1c3616', {
      cluster: 'ap1',
      encrypted: true,
      authEndpoint: '/admin/pusher/auth',
      auth: {
        headers: {
            'X-CSRF-Token':  $('meta[name="csrf-token"]').attr('content')
        }
    }
});	


    var app = angular.module('notification', []);
    app.run(function () {
       console.log('test');
   })



    app.controller('notificationController', function($scope,$http) {
       $scope.user_id;
       $scope.unreadnotify=[];
       $scope.unreadnotify_user=[];
       $scope.notificationInit=function (user_id) {
           $scope.user_id=user_id;
           $http.get('/admin/notification?user_id='+user_id).then(function (res) {
              $scope.unreadnotify=res.data.unreadnotify;
          }, function (error) {
              console.log(error);
          })
       }
       $scope.usernotificationInit=function (user_id) {
        $scope.user_id=user_id;
        $http.get('/admin/notificationUser?user_id='+user_id).then(function (res) {
            $scope.unreadnotify_user=res.data.unreadnotify;
        }, function (error) {
            console.log(error);
        })
    }

    $scope.readNotify=function ($id) {
    	if($scope.unreadnotify!=0)
    	{
    		$http.get('/admin/readNotification?user_id='+$scope.user_id+'&id='+$id).then(function (res) {
              $scope.unreadnotify=[];
          }, function (error) {
              console.log(error);
          })
    	}
    }

    $scope.readNotify_user=function ($id) {
      if($scope.unreadnotify_user!=0)
      {
        $http.get('/admin/readNotification?user_id='+$scope.user_id+'&id='+$id).then(function (res) {
          $scope.unreadnotify=[];
        }, function (error) {
          console.log(error);
        })
      }
    }

    var channel = pusher.subscribe('private-App.User.'+user_id);
    channel.bind('Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', function(data){
        if (data.type.indexOf('UserNotification')!=-1) {
            $.notify({
                message:data.notify,
                url: '/admin/checkuser/show/'+data.fullname.id,
                target: '_self'
            },{
                mouse_over: 'pause',
                placement: {
                    from: "bottom",
                    align: "left"
                },
                timer:8000
            });
            $http.get('/admin/notificationUser?user_id='+user_id).then(function (res) {
                $scope.unreadnotify_user=res.data.unreadnotify;
            }, function (error) {
                console.log(error);
            })
        }
        else{
            $.notify({

                message:data.name,
                url: '/admin/order_info/'+data.orders.id,
                target: '_self'
            },{
                mouse_over: 'pause',
                placement: {
                    from: "bottom",
                    align: "left"
                },
                timer:8000
            });
            $http.get('/admin/notification?user_id='+$scope.user_id).then(function (res) {
                console.log(res);
                $scope.unreadnotify=res.data.unreadnotify;
            }, function (err) {
                console.log(err);
            }) 

        }
    });


});
})();