'use strict';

// Register `tags` component, along with its associated controller and template
angular.
  module('tags').
  component('tags', {
    templateUrl: 'tags/tags.template.html',
    controller: ['tagService',
      function TagsController(tagService) {
        self = this;
        tagService.getTags(function(dataResponse) {
            self.tags = dataResponse;
        });

        this.create = function(tag) {
            console.log('submit', tag);
            tagService.createTag(tag.name, function(dataResponse) {
                console.log(dataResponse);
            });
            tag.name = '';
        };

        this.showProjects = function(tag) {
          console.log(tag);
          
        }

      }
    ]
  });
