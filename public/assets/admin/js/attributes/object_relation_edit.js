;(function(global){
    
    var ObjectRelation = {};

    function ObjectRelationContainer(containerId){

        this.$container = $("#" + containerId);
        this.$view = this.$container.find(".attribute-object-relation-view");
        this.$input = this.$container.find(".attribute-object-relation-input");
        this.$add = this.$container.find(".attribute-object-relation-add");

        this.node = null;

        this.registerEventHandlers();
        this.renderView();

    };

    ObjectRelationContainer.prototype.setNode = function(node){

        this.node = node;
        this.renderView();
        this.$input.val(this.node.id);

    };

    ObjectRelationContainer.prototype.renderView = function(){

        this.$view.html("");

        if( this.node ){
            this.$view.append(
                '<div class="pull-left object-relation-card">'+
                    '<b class="nodename">' + this.node.name + '</b>' +
                    '<b class="delete">&times;</b>' +
                '</div>'
            );
        }else{
            this.$view.append(
                '<p>' +
                    'Kein Objekt Ausgewählt...' +
                '</p>'
            );
        }

    };

    ObjectRelationContainer.prototype.registerEventHandlers = function(){

        this.$container.on("click", ".delete", function(ev){

            this.removeNode();

        }.bind(this));

        this.$add.click(function(){
            
            ObjectBrowser.open(function(node){

                this.setNode(node);

            }.bind(this));

        }.bind(this));

    };
    
    ObjectRelationContainer.prototype.removeNode = function(){

        this.node = null;
        this.$input.val("");
        this.renderView();

    };

    ObjectRelation.register = function(containerId){

        return new ObjectRelationContainer(containerId);

    };

    global.Attributes.ObjectRelation = ObjectRelation;

})(window);