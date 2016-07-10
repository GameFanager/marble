;(function(global){
    
    var Images = {};

    function ImagesContainer(containerId){

        this.$container = $("#" + containerId);
        this.$view = this.$container.find(".attribute-images-view");
        this.$input = this.$container.find(".attribute-images-input");
        this.images = [];
        this.deleteQueue = [];

        this.registerEventHandlers();
        this.renderView();

    };

    ImagesContainer.prototype.addImage = function(image){

        this.images.push(image);
        this.renderView();

    };

    ImagesContainer.prototype.renderView = function(){

        this.$view.html("");

        for(var i in this.images){
            this.$view.append(
                '<div class="pull-left image-card">'+
                    '<img src="' + this.images[i].filename + '" />' +
                    '<b class="filename">' + this.images[i].original_filename + '</b>' +
                    '<b class="delete" data-index="' + i + '">&times;</b>' +
                '</div>'
            );
        }

        if( this.images.length === 0 ){
            this.$view.append(
                '<p>' +
                    'Keine Bilder Ausgewählt...' +
                '</p>'
            );
        }

    };

    ImagesContainer.prototype.registerEventHandlers = function(){

        this.$container.on("click", ".delete", function(ev){

            this.removeImage($(ev.currentTarget).data("index"));

        }.bind(this));

    };

    ImagesContainer.prototype.removeImage = function(index){

        this.deleteQueue.push(this.images[index].id);
        this.images.splice(index, 1);

        this.renderView();
        this.updateDeleteQueue();

    };

    ImagesContainer.prototype.updateDeleteQueue = function(){
        
        this.$input.val(this.deleteQueue.join(","));

    };

    Images.register = function(containerId){

        return new ImagesContainer(containerId);

    };

    global.Attributes.Images = Images;

})(window);