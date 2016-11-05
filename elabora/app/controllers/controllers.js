var appEmpreende = angular.module('appEmpreende',["ngSanitize","ngRoute", "ui.bootstrap"]);


appEmpreende.config(['$routeProvider',
   function($routeProvider) {
      $routeProvider.
      //Menu Home
      when('/home', {
         templateUrl: 'app/views/home.html',
         controller: 'HomeCtrl' ,
      }).
      when('/posts/:argumento', {
         templateUrl: 'app/views/posts.html',
         controller: 'PostsCtrl' ,
      }).
      when('/detalhe/:id', {
         templateUrl: 'app/views/detalhe.html',
         controller: 'DetalheCtrl' ,
      }).
      otherwise({
         redirectTo: '/home'
      });
   }]);

appEmpreende.controller('parametrosCtrl', function($scope, services) {
   $scope.config = config;
});

appEmpreende.filter('removeHTMLTags', function() {
	return function(text) {
		return  text ? String(text).replace(/<[^>]+>/gm, '') : '';
	};
});

appEmpreende.controller('NavigationCtrl', ['$scope', '$location', function ($scope, $location) {
   $scope.isCurrentPath = function (path) {
      return $location.path() == path;
   };
}]);

appEmpreende.factory('services', ['$http', function($http) {
	var obj={};
	obj.getPosts = function(argumento) { console.log(argumento); return $http.get("http://54.83.234.141/v1/posts/"+argumento); }
	obj.getPostsAll = function() { return $http.get("http://54.83.234.141/v1/posts"); }
	obj.getCategorias = function() { return $http.get("http://54.83.234.141/v1/categorias"); }
	obj.getPostsDetalhe = function(id) { return $http.get("http://54.83.234.141/v1/post/"+id); }
	obj.getTags = function() { return $http.get("http://54.83.234.141/v1/tags"); }
	return obj;
}]);

appEmpreende.controller('HomeCtrl', function($scope, services) {
});

appEmpreende.controller('DetalheCtrl', function($scope, services, $routeParams) {
  services.getCategorias().then( function(data) {
    $scope.categorias = data.data;
  });
  services.getTags().then( function(data) {
    $scope.tags = data.data;
  });
  services.getPostsDetalhe($routeParams.id).then( function(data) {
    if (data.status == 200) {
      $scope.detalhe = data.data;
    } else {
        alert("Sua busca não retornou nada!");
    }
  });
});


appEmpreende.controller('PostsCtrl', function($scope, services, $routeParams) {

  services.getCategorias().then( function(data) {
    $scope.categorias = data.data;
  });
  services.getTags().then( function(data) {
    $scope.tags = data.data;
  });
  if ($routeParams.argumento == undefined) {
    services.getPostsAll().then( function(data) {
      if (data.status == 200) {
        $scope.retorno = data.data;
      } else {
          alert("Sua busca não retornou nada!");
      }
    });
  } else {
    services.getPosts($routeParams.argumento).then( function(data) {
      if (data.status == 200) {
        $scope.retorno = data.data;

        $scope.totalItems = data.data.total;
        $scope.currentPage = data.data.current_page;
        $scope.itensPerPage = data.data.per_page;
      } else {
          alert("Sua busca não retornou nada!");
      }
    });
  }

  $scope.pageChanged = function() {
    window.location="#/posts/"+$routeParams.argumento+"?page="+$scope.currentPage;
  };

});

function busca(){
  var argumento = $('#argumento').val();
  window.location="#/posts/"+argumento;
}
