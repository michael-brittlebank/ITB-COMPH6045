(function(){

    var that = app.helpers,
        $ = jQuery;
    
    this.activeClass = 'active';
    this.disabledClass = 'disabled';
    this.errorClass = 'error';

    this.parseIntFromString = function(string){
        //http://stackoverflow.com/questions/395163/get-css-top-value-as-number-not-as-string
        return parseInt(string, 10);
    };

    this.sizeOfObject = function(data){
        if (data){
            return Object.keys(data).length;
        } else {
            return 0;
        }
    };
    
    this.isEmpty = function(string){
        return string.length < 1;
    };
    
    this.resetForm = function(formElement){
      formElement.find('.'+that.errorClass).each(function(){
          $(this).removeClass(that.errorClass);
      });
    };

    this.isFormValid = function(formElement){
        return formElement.find('.'+that.errorClass).length < 1;
    };
    
}).apply(app.helpers);