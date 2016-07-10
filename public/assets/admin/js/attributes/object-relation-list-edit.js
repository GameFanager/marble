;(function(global){
    
    function ObjectRelationList(containerId, inputName){

        this.$container = $("#" + containerId);
        this.$view = this.$container.find(".attribute-object-relation-list-view");
        this.$inputs = this.$container.find(".attribute-object-relation-list-inputs");
        this.$add = this.$container.find(".attribute-object-relation-list-add");
        this.inputName = inputName;

        this.nodes = [];

        this.registerEventHandlers();
        this.renderView();

    };

    ObjectRelationList.prototype.addNode = function(node){

        this.nodes.push(node);
        this.renderView();

    };

    ObjectRelationList.prototype.renderView = function(){

        this.$view.html("");
        this.$inputs.html("");

        for(var i in this.nodes){
            this.$view.append(
                '<div class="pull-left object-relation-card">'+
                    '<b class="nodename">' + this.nodes[i].name + '</b>' +
                    '<b class="delete" data-index="' + i + '">&times;</b>' +
                '</div>'
            );

            this.$inputs.append(
                '<input type="hidden" name="' + this.inputName + '" value="' + this.nodes[i].id + '" />'
            );
        }

        if(this.nodes.length === 0){
            this.$view.append(
                '<p>' +
                    'Keine Objekte Ausgewählt...' +
                '</p>'
            );
        }

    };

    ObjectRelationList.prototype.registerEventHandlers = function(){

        this.$container.on("click", ".delete", function(ev){

            this.removeNode($(ev.currentTarget).data("index"));

        }.bind(this));

        this.$add.click(function(){

            ObjectBrowser.open(function(node){

                this.addNode(node);

            }.bind(this));

        }.bind(this));

    };

    ObjectRelationList.prototype.removeNode = function(index){
        
        this.nodes.splice(index, 1);
        this.renderView();

    };
    
    global.Attributes.ObjectRelationList = ObjectRelationList;

})(window);