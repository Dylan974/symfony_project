'use strict';

angular.
  module('core.tag').
  service('tagService', function($http) {
    this.getTags = function(callbackFunc) {
        $http({
            method: 'GET',
            url: 'http://localhost:8000/api/tags',
            headers: { 'Content-Type': undefined }
            }).success(function(data){
            // With the data succesfully returned, call our callback
            callbackFunc(data);
        }).error(function(){
            alert("error");
        });
    };

    this.createTag = function(name, callbackFunc) {
        console.log(name);
        $http({
            method: 'POST',
            url: 'http://localhost:8000/api/tag',
            headers: { 'Content-Type': undefined },
            data: { name },
            }).success(function(data){
            // With the data succesfully returned, call our callback
            callbackFunc(data);
        }).error(function(){
            alert("error");
        });
    }

    this.getTagProjects = function(tag, callbackFunc) {
        console.log(tag);
        $http({
            method: 'GET',
            url: 'http://localhost:8000/api/tag',
            headers: { 'Content-Type': undefined }
            }).success(function(data){
            // With the data succesfully returned, call our callback
            callbackFunc(data);
        }).error(function(){
            alert("error");
        });
    }
    
});
