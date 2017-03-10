(function(){

    var that = app.helpers,
        $ = jQuery;
    
    this.activeClass = 'active';
    this.disabledClass = 'disabled';
    
    this.parseIntFromString = function(string){
        //http://stackoverflow.com/questions/395163/get-css-top-value-as-number-not-as-string
        return parseInt(string, 10);
    };
    
}).apply(app.helpers);