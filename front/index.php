<!DOCTYPE html>
<html>
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>The Bid Calculation Question</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
 </head>
 <body>
<div class="container">
    <h1 class="page-header text-center">The Bid Calculation Question</h1>
    <div id="vueregapp">
        <div class="col-md-4">
  
            <div class="panel panel-primary">
                <div class="panel-heading"><span class="glyphicon glyphicon-shopping-cart"></span> Budget Calculation</div>
                <div class="panel-body">
                    <label>Budget:</label>
                    <input type="tel" pattern="[0-9]+" class="form-control" ref="budget" v-model="formDetails.budget" v-on:keyup="keymonitor" v-on:keydown="keymonitorInput">
                    <div class="text-center" v-if="errorBudget">
                        <span style="font-size:13px;">{{ errorBudget }}</span>
                    </div>
                    
                </div>
                <div class="panel-footer">
                    <button class="btn btn-primary btn-block" @click="calcBudget();" :disabled="isLoading"><span class="glyphicon glyphicon-usd"></span> Calculate</button>
                </div>
            </div>
  
            <div class="alert alert-danger text-center" v-if="errorMessage">
                <button type="button" class="close" @click="clearMessage();"><span aria-hidden="true">×</span></button>
                <span class="glyphicon glyphicon-alert"></span> {{ errorMessage }}
            </div>
  
            <div class="alert alert-success text-center" v-if="successMessage">
                <button type="button" class="close" @click="clearMessage();"><span aria-hidden="true">×</span></button>
                <span class="glyphicon glyphicon-check"></span> {{ successMessage }}
            </div>
  
        </div>
  
        <div class="col-md-8">
            <h3>Historical calculation</h3>
            
            <table class="table table-bordered table-striped">
                <thead>
                   <tr>
                        <th rowspan="2" class="text-center">Budget</th>
                        <th rowspan="2" class="text-center">Total Amount</th>
                        <th colspan="4" class="text-center">Fees</th>
                    </tr>
                    <tr>
                        <th class="text-center">Basic</th>
                        <th class="text-center">Special</th>
                        <th class="text-center">Association</th>
                        <th class="text-center">Storage</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="calculate in calculates">
                        <td class="text-right">{{ calculate.budget | toCurrency}}</td>
                        <td class="text-right">{{ calculate.TotalAmount | toCurrency }}</td>
                        <td class="text-right">{{ calculate.BasicFee | toCurrency }}</td>
                        <td class="text-right">{{ calculate.SpecialFee | toCurrency }}</td>
                        <td class="text-right">{{ calculate.AssociationFee | toCurrency }}</td>
                        <td class="text-right">{{ calculate.Storage | toCurrency }}</td>
                        
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="scripts/budget.js"></script>
</body>
</html>