'use strict';

angular.
  module('apiRestApp').
  config(['$locationProvider' ,'$routeProvider',
    function config($locationProvider, $routeProvider) {
      $locationProvider.hashPrefix('!');

      $routeProvider.
        when('/projects', {
          template: '<projects></projects>'
        }).
        when('/tags', {
          template: '<tags></tags>'
        }).
        otherwise('/tags');
    }
  ]);
