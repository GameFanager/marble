;(function(global){

    function ObjectBrowser(){

        this.$modal = $("#object-browser-modal");

    };

    ObjectBrowser.prototype.open = function(callback){

        this.$modal.modal("show");

        this.$modal.on("click", ".object-browser-node", function(ev){

            var $el = $(ev.currentTarget);

            callback({
                id: $el.data("node-id"),
                name: $el.data("node-name")
            });

            this.close();

        }.bind(this));

    };

    ObjectBrowser.prototype.close = function(){

        this.$modal.modal("hide");

    };

    window.ObjectBrowser = ObjectBrowser;

})(window);