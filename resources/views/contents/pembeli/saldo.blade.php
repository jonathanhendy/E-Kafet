@extends('layouts.pembeli')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
<title></title>
<style>

body {
  margin: 0;
  background-color: #363958;
}

.submit-area {
	padding: 25px;
	border-radius: 10px;
	box-shadow: 5px 5px gray;
    color: white;
    background-color: #0c4e68;
    position: relative;
    top: 20%;
    left: 50%;
   

}

#account-area {
	margin-top: 5%;

}

.deposit {
	background-color: #0c4e68;
    box-shadow: 5px 5px gray;
    position: relative;
    left: 50%;
    right: 50%
    top : 0%;
    
    
}

.withdraw {
	background-color: lightsalmon;
}

.balance {
	background-color: tomato;
}

.status {
	margin: 0 20px;
	color: white;
	padding: 20px;
	border-radius: 10px;
}

</style>


<body>
    <div id="account-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="deposit status">
                        <h5>Saldo Anda</h5>
                        @foreach($saldo as $item)
                        @if($item->saldo == null)
                        <h2>Rp. <span id="current-deposit">00</span></h2>
                        @elseif($item->saldo != null)
                        <h2>Rp. <span id="current-deposit">{{$item->saldo}}</span></h2>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        
        
        <form method='POST' action='/addsaldo'>
         @csrf
         @method('patch')
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="submit-area">
                        <h4>Top Up Saldo</h4>
                        <input type="number" name="saldo" class="form-control"placeholder=""><br>
                        <button type="submit" class="btn btn-success">OK</button>
                    </div>
                </div>
            </div>
        </div>
        </form>  
    </div>

    <script>
         const deposit_btn = document.getElementById('deposit-btn');
        deposit_btn.addEventListener('click', function(){

            const depositStringToInt = getInputNumb("deposit-amount");

            updateSpanTest("current-deposit", depositStringToInt);
            updateSpanTest("current-balance", depositStringToInt);

            //setting up the input field blank when clicked
            document.getElementById('deposit-amount').value = "";

        })

         //withdraw button event handler
        //  const withdraw_btn = document.getElementById('withdraw-btn');
        //  withdraw_btn.addEventListener('click', function(){
        //     const withdrawNumb = getInputNumb("withdraw-amount");

        //     updateSpanTest("current-withdraw", withdrawNumb);
        //     updateSpanTest("current-balance", -1 * withdrawNumb);
        //     //setting up the input field blank when clicked
        //     document.getElementById('withdraw-amount').value = "";
        // })

        //function to parse string input to int
        function getInputNumb(idName){
            const amount = document.getElementById(idName).value;
            const amountNumber = parseFloat(amount);
            return amountNumber;
        }

        function updateSpanTest(idName, addedNumber){
            //x1.1 updating balance the same way
            const current = document.getElementById(idName).innerText;
            const currentStringToInt = parseFloat(current);

            const total = currentStringToInt + addedNumber;

            //x1.2 setting this value in balance
            document.getElementById(idName).innerText = total;
        }
    </script>
    
</body>
</html>
     
@endsection
