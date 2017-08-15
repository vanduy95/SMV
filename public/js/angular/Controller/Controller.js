
app.controller('GroupUserController',function($scope, $http, DNS){
	$http({
		method: 'GET',
		url: DNS+'ajaxgroupuser'
	}).then(function success(response){
		$scope.groupuser = "nguyen van duy"
			// console.log(response);
		}, function errorCallback(response){
			console.log(response);
			alert('Xay ra loi vui long kiem tra lai');
		});
});
