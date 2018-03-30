'use strict';

// Register `projects` component, along with its associated controller and template
angular.
  module('projects').
  component('projects', {
    templateUrl: 'projects/projects.template.html',
    controller: ['projectService',
      function ProjectsController(projectService) {
        self = this;
        projectService.getProjects(function(dataResponse) {
            self.projects = dataResponse;
        });

        this.create = function(project) {
            console.log('submit', project);
            projectService.createProject(project.name, project.url, function(dataResponse) {
                console.log(dataResponse);
            });
        };
      }
    ]
  });
