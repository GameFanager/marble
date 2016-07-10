;(function(global){
    
    function Images(containerId, attributeId, languageId){

        this.$container = $("#" + containerId);
        this.$view = this.$container.find(".attribute-images-view");
        this.$input = this.$container.find(".attribute-images-input");
        this.images = [];
        this.deleteQueue = [];
        this.attributeId = attributeId;
        this.languageId = languageId;

        this.registerEventHandlers();
        this.renderView();

    };

    Images.prototype.addImage = function(image){

        this.images.push(image);
        this.renderView();

    };

    Images.prototype.renderView = function(){

        this.$view.html("");

        for(var i in this.images){
            this.$view.append(
                '<div class="pull-left image-card">'+
                    '<img data-index="' + i  + '" src="' + this.images[i].thumbnail_filename + '" />' +
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

    Images.prototype.registerEventHandlers = function(){

        this.$container.on("click", ".delete", function(ev){

            this.removeImage($(ev.currentTarget).data("index"));

        }.bind(this));

        this.$container.on("click", "img", function(ev){

            this.editImage($(ev.currentTarget).data("index"));

        }.bind(this));

    };

    Images.prototype.editImage = function(index){

        ImageEditor.done(function(transformations){

            this.images[index].transformations = transformations;

            $.post("/admin/node/ajaxattribute/" + this.attributeId + "/" + this.languageId, {
                method: "saveTransformations",
                data: this.images[index].transformations,
                index: index
            });

        }.bind(this));
        
        ImageEditor.open(this.images[index]);

    };

    Images.prototype.removeImage = function(index){

        this.deleteQueue.push(this.images[index].id);
        this.images.splice(index, 1);

        this.renderView();
        this.updateDeleteQueue();

    };

    Images.prototype.updateDeleteQueue = function(){
        
        this.$input.val(this.deleteQueue.join(","));

    };

    global.Attributes.Images = Images;

})(window);