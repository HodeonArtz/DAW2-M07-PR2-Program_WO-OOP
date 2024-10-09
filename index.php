<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bank account</title>
</head>

<body>
  <?php 
    $bank_account1 = [
      "balance"=> 400,
      "overdraft_limit"=> 0,
      "opened" => true
    ];
    $bank_account2 = [
      "balance"=> 200,
      "overdraft_limit"=> 100,
      "opened" => true
    ];
    function deposit_funds(array &$bank_account, int|float $amount) : void {
      echo "Doing transaction deposit (+" . abs($amount) . ") with current balance " . number_format($bank_account["balance"], 1); 
      echo "<br>";
      $bank_account["balance"] += abs($amount);
      echo "My new balance after deposit (+" . abs($amount) . ") : " . number_format($bank_account["balance"], 1);
      echo "<br>";
    }

    function withdraw_funds(array &$bank_account, int|float $amount) : void {
      echo "Doing transaction withdrawal (-" . abs($amount) . ") with current balance " . number_format($bank_account["balance"], 1); 
      echo "<br>";
      if ($bank_account["overdraft_limit"] == 0 && ($bank_account["balance"] - abs($amount)) < 0){
        echo "Error transaction: Insufficient balance to complete withdrawal.";
        echo "<br>";
        echo "My new balance after failed last transaction (-" . abs($amount) . ") : " . number_format($bank_account["balance"], 1);
        echo "<br>";
        return;
      }
      if($bank_account["overdraft_limit"] > 0 && ($bank_account["balance"] - abs($amount)) < 0){
        if(abs($amount)>$bank_account["overdraft_limit"]){
          echo "Error transaction: Withdrawal esceeds overdraft limit.";
          echo "<br>";
          echo "My new balance after failed last transaction (-" . abs($amount) . ") : " . number_format($bank_account["balance"], 1);
          echo "<br>";
          return;
        }
        $bank_account["balance"] -= abs($amount);
        echo "My new balance after withdrawal (-" . abs($amount) . ") with funds : " . number_format($bank_account["balance"], 1);
        echo "<br>";
        return;
      }

      $bank_account["balance"] -= abs($amount);
      echo "My new balance after withdrawal (-" . abs($amount) . ") : " . number_format($bank_account["balance"], 1);
      echo "<br>";
    }
    function open_account(array &$bank_account): void{

      if($bank_account["opened"]){
        echo "Error: Account is already opened";
        echo "<br>";
        return;
      }
      $bank_account["opened"] |= true;
      echo "My account is now reopened.";
      echo "<br>";
    }
    function close_account(array &$bank_account): void{


      if(!$bank_account["opened"]){
        echo "Error: Account is already closed";
        echo "<br>";
        return;
      }
      $bank_account["opened"] &= false;
      echo "My account is now closed.";
      echo "<br>";
    }
    function display_balance($bank_account) : void {
      echo "My balance : ". number_format($bank_account["balance"], 1);
      echo "<br>";
    }

    display_balance($bank_account1);
    close_account($bank_account1);
    open_account($bank_account1);
    deposit_funds($bank_account1,150);
    withdraw_funds($bank_account1, 25);
    withdraw_funds($bank_account1, 600);
    close_account($bank_account1);
    echo "--------------------------- <br>";

    display_balance($bank_account2);
    deposit_funds($bank_account2,100);
    withdraw_funds($bank_account2, 300);
    withdraw_funds($bank_account2, 50);
    withdraw_funds($bank_account2, 120);
    withdraw_funds($bank_account2, 20);
    close_account($bank_account2);
    close_account($bank_account2)
  ?>
</body>

</html>