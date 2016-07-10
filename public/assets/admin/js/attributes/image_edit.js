;(function(global){
    
    var Image = {};

    function ImageContainer(containerId){

        this.$container = $("#" + containerId);
        this.$view = this.$container.find(".attribute-image-view");
        this.$input = this.$container.find(".attribute-image-input");
        this.image = null;

        this.registerEventHandlers();
        this.renderView();

    };

    ImageContainer.prototype.setImage = function(image){

        this.image = image;
        this.renderView();

    };

    ImageContainer.prototype.renderView = function(){

        this.$view.html("");

        if( this.image ){
            this.$view.append(
                '<div class="pull-left image-card">'+
                    '<img src="' + this.image.filename + '" />' +
                    '<b class="filename">' + this.image.original_filename + '</b>' +
                    '<b class="delete">&times;</b>' +
                '</div>'
            );
        }else{
            this.$view.append(
                '<p>' +
                    'Kein Bild Ausgewählt...' +
                '</p>'
            );
        }

    };

    ImageContainer.prototype.registerEventHandlers = function(){

        this.$container.on("click", ".delete", function(ev){

            this.removeImage();

        }.bind(this));

    };

    ImageContainer.prototype.removeImage = function(){
        this.image = null;
        this.$input.val("");
        this.renderView();
    };

    Image.register = function(containerId){

        return new ImageContainer(containerId);

    };

    global.Attributes.Image = Image;

})(window);