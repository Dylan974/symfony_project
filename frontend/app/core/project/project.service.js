'use strict';

angular.
  module('core.project').
  service('projectService', function($http) {
    this.getProjects = function(callbackFunc) {
        $http({
            method: 'GET',
            url: 'http://localhost:8000/api/projects',
            headers: { 'Content-Type': undefined }
            }).success(function(data){
            // With the data succesfully returned, call our callback
            callbackFunc(data);
        }).error(function(){
            alert("error");
        });
    };

    this.createProject = function(name, src, callbackFunc) {
        console.log(name, src);
        $http({
            method: 'POST',
            url: 'http://localhost:8000/api/project',
            data: { name: name, src: src },
            headers: { 'Content-Type': undefined }
            }).success(function(data){
            // With the data succesfully returned, call our callback
            callbackFunc(data);
        }).error(function(){
            alert("error");
        });
    }
    
});
