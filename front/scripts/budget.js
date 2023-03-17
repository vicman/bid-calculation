var app = new Vue({
    el: '#vueregapp',
    data:{
        isLoading:false,
        successMessage: "",
        errorMessage: "",
        errorBudget: "",
        calculates: [],
        formDetails: {budget: ''},
    },
  
    mounted: function(){
       
    },
  
    methods:{       
  
        calcBudget: function(){
            var regForm = app.toFormData(app.formDetails);
            app.isLoading = true;
            axios.post('../api/index.php?totalAmount='+ app.formDetails.budget, regForm)
                .then(function(response){
                    app.isLoading = false;
                    console.log('error',response.data);
                    if(response.data.error){
                        app.errorMessage = response.data.message;                       
                    }
                    else if(response.data.budget){  
                        app.formDetails.budget = '';                        
                        app.calculates.unshift(response.data);
                        app.focusBudget();
                        app.clearMessage();
                    }                    
                    else{
                        app.successMessage = response.data.message;
                        app.formDetails = {budget: ''};                      
                       
                    }
                })
                .catch(function (error) {
                    app.isLoading = false;
                    app.errorMessage = error.toJSON();
                    console.log(error.toJSON());
                 });
        },
  
        focusBudget: function(){
            this.$refs.budget.focus();
        }, 
        keymonitor: function(event) {
            if(event.key == "Enter"){
                console.log('enter')
                app.calcBudget();
            }
        },

        keymonitorInput: function(event) {  
            
       
            if (!/\d/.test(event.key) && event.key !== '.' && event.key !== 'Backspace') return event.preventDefault();
        },
  
        toFormData: function(obj){
            var form_data = new FormData();
            for(var key in obj){
                form_data.append(key, obj[key]);
            }
            return form_data;
        },
  
        clearMessage: function(){
            app.errorMessage = '';
            app.successMessage = '';
            app.isLoading = false;
        }
  
    }
});

Vue.filter('toCurrency', function (value) {
    if (typeof value !== "number") {
        return value;
    }
    var formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD'
    });
    return formatter.format(value);
});