;(function(global){

    function ObjectBrowser(){

        this.$modal = null;
        this.callback = $.noop;

    }

    ObjectBrowser.prototype.init = function(){

        this.$modal = $("#object-browser-modal");

        this.$modal.on("click", ".object-browser-node", function(ev){

            var $el = $(ev.currentTarget),
                node = {
                    id: $el.data("node-id"),
                    name: $el.data("node-name")
                };
            
            this.nodeSelected(node);

            this.close();

        }.bind(this));

    };

    ObjectBrowser.prototype.open = function(callback){

        this.callback = callback;
        this.$modal.modal("show");

    };

    ObjectBrowser.prototype.nodeSelected = function(node){

        this.callback(node);
        this.callback = $.noop;

    };

    ObjectBrowser.prototype.close = function(){

        this.$modal.modal("hide");

    };


    window.ObjectBrowser = new ObjectBrowser;

})(window);